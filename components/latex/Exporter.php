<?php

namespace app\components\latex;

use app\components\{HashedStaticCache, HTMLTools};
use app\models\exceptions\Internal;
use app\models\sectionTypes\Image;
use app\models\settings\AntragsgruenApp;

class Exporter
{
    /** @var Layout */
    private $layout;

    /** @var  AntragsgruenApp */
    private $app;

    public function __construct(Layout $layout, AntragsgruenApp $app)
    {
        $this->layout = $layout;
        $this->app    = $app;
    }

    public static function encodePlainString(string $str): string
    {
        $replaces = [
            '\\'                     => '\textbackslash{}',
            '&'                      => '\&',
            '%'                      => '\%',
            '$'                      => '\$',
            '#'                      => '\#',
            '_'                      => '\_',
            '{'                      => '\{',
            '}'                      => '\}',
            '\textbackslash\{\}'     => '\textbackslash{}',
            '~'                      => '\texttt{\~{}}',
            '^'                      => '\^{}',
            '\#\#\#LINENUMBER\#\#\#' => '###LINENUMBER###',
            '\#\#\#LINEBREAK\#\#\#'  => '###LINEBREAK###',
            "\n"                     => '\\linebreak{}' . "\n", // Adding a {} at the end prevents broken LaTeX-Files if the next line begins with a "[",
            "ä"                      => "\\\"a",
            "ö"                      => "\\\"o",
            "ü"                      => "\\\"u",
            "Ä"                      => "\\\"A",
            "Ö"                      => "\\\"O",
            "Ü"                      => "\\\"U",
            "ß"                      => "\\ss{}",
        ];
        return str_replace(array_keys($replaces), array_values($replaces), $str);
    }

    /**
     * @param string[] $lines
     * @return string
     */
    public static function getMotionLinesToTeX($lines)
    {
        $str = implode('###LINEBREAK###', $lines);
        $str = str_replace('<br>###LINEBREAK###', '###LINEBREAK###', $str);
        $str = str_replace('<br>' . "\n" . '###LINEBREAK###', '###LINEBREAK###', $str);

        // Enforce a workaround to enable empty lines by using <p><br></p>
        $str = preg_replace('/(<p[^>]*>)\s*<br>\s*(<\/p>)/siu', '$1 $2', $str);

        $str = static::encodeHTMLString($str);
        $str = str_replace('###LINENUMBER###', '', $str);
        $str = str_replace('###LINEBREAK###', "\\linebreak{}\n", $str);

        // Some edge cases that occur in nested enumerated lists
        $str = str_replace('\linebreak{}' . "\n\n" . '\item', "\n" . '\item', $str);
        $str = str_replace('\newline' . "\n" . '\end{enumerate}', "\n" . '\end{enumerate}', $str);
        $str = str_replace('\linebreak{}' . "\n" . '\begin{enumerate}', "\n" . '\begin{enumerate}', $str);
        $str = str_replace('\end{enumerate}' . "\n\n", '\end{enumerate}' . "\n", $str);
        $str = preg_replace('/(\\\\linebreak{}\\n?)+\\\\begin{enumerate}/siu', "\n\begin{enumerate}", $str);

        return $str;
    }

    public static function encodePREString(string $str): string
    {
        $out   = "\n" . '\nolinenumbers' . "\n\n" . '\texttt{';
        $lines = explode("\n", $str);
        foreach ($lines as $line) {
            if (strlen($line) > 0 && $line[0] == ' ') {
                $out  .= '\phantom{.}';
                $line = substr($line, 1);
            }
            $out .= str_replace(' ', '\ ', static::encodePlainString($line));
            $out .= '\linebreak{}' . "\n";
        }
        $out .= '}' . "\n\n" . '\linenumbers';
        return $out;
    }

    /**
     * @param \DOMNode $node
     * @param array $extraStyles
     * @param null $liCounter
     *
     * @return string
     */
    private static function encodeHTMLNode(\DOMNode $node, $extraStyles = [], $liCounter = null): string
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            /** @var \DOMText $node */
            $str = static::encodePlainString($node->data);
            if (in_array('underlined', $extraStyles) || in_array('strike', $extraStyles)) {
                $words = explode(' ', $str);
                if (in_array('underlined', $extraStyles)) {
                    $words[0] = '\uline{' . $words[0] . '}';
                    for ($i = 1; $i < count($words); $i++) {
                        $words[$i] = '\uline{ ' . $words[$i] . '}';
                    }
                }
                if (in_array('strike', $extraStyles)) {
                    $words[0] = '\sout{' . $words[0] . '}';
                    for ($i = 1; $i < count($words); $i++) {
                        $words[$i] = '\sout{ ' . $words[$i] . '}';
                    }
                }
                $str = implode('', $words);
            }
            if (in_array('ins', $extraStyles)) {
                $str = '\textcolor{Insert}{' . $str . '}';
            }
            if (in_array('del', $extraStyles)) {
                $str = '\textcolor{Delete}{' . $str . '}';
            }
            return $str;
        } else {
            $content = '';
            /** @var \DOMElement $node */
            if ($node->hasAttribute('class')) {
                $classes = explode(' ', $node->getAttribute('class'));
            } else {
                $classes = [];
            }

            $childStyles = $extraStyles;
            if (in_array($node->nodeName, HTMLTools::$KNOWN_BLOCK_ELEMENTS)) {
                if (in_array('ins', $classes) || in_array('inserted', $classes)) {
                    $childStyles[] = 'ins';
                    $childStyles[] = 'underlined';
                }
                if (in_array('del', $classes) || in_array('deleted', $classes)) {
                    $childStyles[] = 'del';
                    $childStyles[] = 'strike';
                }
            } else { // Inline elements
                if ($node->nodeName === 'u') {
                    $childStyles[] = 'underlined';
                } elseif ($node->nodeName === 'ins') {
                    $childStyles[] = 'underlined';
                } elseif ($node->nodeName === 's') {
                    $childStyles[] = 'strike';
                } elseif ($node->nodeName === 'del') {
                    $childStyles[] = 'strike';
                } elseif ($node->nodeName === 'span') {
                    if (in_array('underline', $classes)) {
                        $childStyles[] = 'underlined';
                    }
                    if (in_array('strike', $classes)) {
                        $childStyles[] = 'strike';
                    }
                    if (in_array('ins', $classes) || in_array('inserted', $classes)) {
                        $childStyles[] = 'underlined';
                    }
                }
            }

            if ($node->nodeName !== 'ol') {
                foreach ($node->childNodes as $child) {
                    /** @var \DOMNode $child */
                    $content .= static::encodeHTMLNode($child, $childStyles);
                }
            }

            switch ($node->nodeName) {
                case 'h4':
                    return '\textbf{' . $content . '}\\newline' . "\n";
                case 'h3':
                    return '\textbf{\large ' . $content . '}\\newline' . "\n";
                case 'h2':
                    return '\textbf{\Large ' . $content . '}\\newline' . "\n";
                case 'h1':
                    return '\textbf{\LARGE ' . $content . '}\\newline' . "\n";
                case 'br':
                    return '\newline' . "\n";
                case 'p':
                    return $content . "\n";
                case 'div':
                    return $content . "\n";
                case 'strong':
                case 'b':
                    $content = preg_replace("/\\n{2,}/siu", "\n", $content);
                    return '\textbf{' . $content . '}';
                case 'em':
                case 'i':
                    $content = preg_replace("/\\n{2,}/siu", "\n", $content);
                    return '\emph{' . $content . '}';
                case 'u':
                    // return '\uline{' . $content . '}';
                    return $content;
                case 's':
                    //return '\sout{' . $content . '}';
                    return $content;
                case 'sub':
                    return '\textsubscript{' . $content . '}';
                case 'sup':
                    return '\textsuperscript{' . $content . '}';
                case 'blockquote':
                    $block = '\begin{quotation}\noindent' . "\n" . $content . '\end{quotation}' . "\n";
                    // noindent enforces a new line number -> strip it if it's a block element wrapped
                    $block = str_replace('\noindent' . "\n" . '\begin{itemize}', "\n" . '\begin{itemize}', $block);
                    $block = str_replace('\noindent' . "\n" . '\begin{enumerate}', "\n" . '\begin{enumerate}', $block);

                    return $block;
                case 'ul':
                    return '\begin{itemize}' . "\n" . $content . '\end{itemize}' . "\n";
                case 'ol':
                    return static::encodeOLNode($node, $extraStyles, $childStyles);
                case 'li':
                    if ($liCounter) {
                        return '\item[' . $liCounter . '] ' . $content . "\n";
                    } else {
                        return '\item ' . $content . "\n";
                    }
                case 'a':
                    if ($node->hasAttribute('href')) {
                        $link    = $node->getAttribute('href');
                        $link    = explode('#', $link); // Hash-parts of URLs break LaTeX
                        $content = '\href{' . $link[0] . '}{' . $content . '}';
                    }
                    return $content;
                case 'span':
                    if (count($classes) == 0) {
                        return $content;
                    }
                    /*
                    if (in_array('underline', $classes)) {
                        // $content = '\uline{' . $content . '}';
                    }
                    if (in_array('strike', $classes)) {
                        // $content = '\sout{' . $content . '}';
                    }
                    */
                    if (in_array('ins', $classes)) {
                        //$content = '\textcolor{Insert}{\uline{' . $content . '}}';
                        $content = '\textcolor{Insert}{' . $content . '}';
                    }
                    if (in_array('inserted', $classes)) {
                        $content = '\textcolor{Insert}{' . $content . '}';
                    }
                    if (in_array('del', $classes)) {
                        $content = '\textcolor{Delete}{' . $content . '}';
                    }
                    if (in_array('deleted', $classes)) {
                        $content = '\textcolor{Delete}{' . $content . '}';
                    }
                    if (in_array('subscript', $classes)) {
                        $content = '\textsubscript{' . $content . '}';
                    }
                    if (in_array('superscript', $classes)) {
                        $content = '\textsuperscript{' . $content . '}';
                    }
                    return $content;
                case 'del':
                    return '\textcolor{Delete}{' . $content . '}';
                case 'ins':
                    //return '\textcolor{Insert}{\uline{' . $content . '}}';
                    return '\textcolor{Insert}{' . $content . '}';
                case 'pre':
                    return static::encodePREString($content);
                default:
                    //return $content;
                    throw new Internal('Unknown Tag: ' . $node->nodeName);
            }
        }
    }

    /*
     * Hints about the numbering algorithm are in HTMLTools
     */
    private static function encodeOLNode(\DOMElement $node, array $currentStyles, array $childStyles): string
    {
        $counter = 1;
        if ($node->hasAttribute('start')) {
            $counter = intval($node->getAttribute('start'));
        }

        $classes = ($node->hasAttribute('class') ? explode(" ", $node->getAttribute('class')) : []);
        if (in_array(HTMLTools::OL_DECIMAL_CIRCLE, $classes)) {
            $itemStyle = HTMLTools::OL_DECIMAL_CIRCLE;
        } elseif (in_array(HTMLTools::OL_LOWER_ALPHA, $classes)) {
            $itemStyle = HTMLTools::OL_LOWER_ALPHA;
        } elseif (in_array(HTMLTools::OL_UPPER_ALPHA, $classes)) {
            $itemStyle = HTMLTools::OL_UPPER_ALPHA;
        } else {
            $itemStyle = HTMLTools::OL_DECIMAL_DOT;
        }

        if (in_array('ins', $currentStyles)) {
            $childStyles[] = 'ins';
        }
        if (in_array('del', $currentStyles)) {
            $childStyles[] = 'del';
        }

        $content = '';
        foreach ($node->childNodes as $child) {
            if ($child->nodeName !== 'li') {
                continue;
            }

            /** @var \DOMElement $child */
            if ($child->hasAttribute('value')) {
                $value = $child->getAttribute('value');
                if (preg_match('/^\d+$/', $value)) {
                    $counter = intval($value);
                } elseif (preg_match('/^[a-z]$/', $value)) {
                    $counter = ord($value) - ord("a") + 1;
                } elseif (preg_match('/^[A-Z]$/', $value)) {
                    $counter = ord($value) - ord("A") + 1;
                }
            } else {
                if ($itemStyle === HTMLTools::OL_LOWER_ALPHA) {
                    $value = chr(ord('a') + $counter - 1);
                } elseif ($itemStyle === HTMLTools::OL_UPPER_ALPHA) {
                    $value = chr(ord('A') + $counter - 1);
                } else {
                    $value = $counter;
                }
            }

            switch ($itemStyle) {
                case HTMLTools::OL_DECIMAL_CIRCLE:
                    $formattedCounter = '(' . $value . ')';
                    break;
                default:
                    $formattedCounter = $value . '.';
                    break;
            }

            $content .= static::encodeHTMLNode($child, $childStyles, $formattedCounter);

            $counter++;
        }

        return '\begin{enumerate}' . "\n" .
               $content .
               '\end{enumerate}' . "\n";
    }

    public static function encodeHTMLString(string $str): string
    {
        $str     = HTMLTools::correctHtmlErrors($str);
        $str     = preg_replace('/(<p[^>]*>)(<\/p>)/siu', '$1 $2', $str);
        $src_doc = new \DOMDocument();

        $src_doc->loadHTML('<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head><body>' . $str . "</body></html>");
        $bodies = $src_doc->getElementsByTagName('body');
        $body   = $bodies->item(0);

        $out = '';
        for ($i = 0; $i < $body->childNodes->length; $i++) {
            /** @var \DOMNode $child */
            $child = $body->childNodes->item($i);
            $out   .= static::encodeHTMLNode($child);
        }

        if (trim(str_replace('###LINENUMBER###', '', $out), "\n") == ' ') {
            $out = str_replace(' ', '{\color{white}.}', $out);
        }

        return $out;
    }

    public static function createLayoutString(Layout $layout): string
    {
        $template                 = $layout->template;
        $template                 = str_replace("\r", "", $template);
        $replaces                 = [];
        $replaces['%LANGUAGE%']   = $layout->language;
        $replaces['%ASSETROOT%']  = $layout->assetRoot;
        $replaces['%PLUGINROOT%'] = $layout->pluginRoot;
        $replaces['%TITLE%']      = static::encodePlainString($layout->title);
        $replaces['%AUTHOR%']     = $layout->author;
        $template                 = str_replace(array_keys($replaces), array_values($replaces), $template);
        return $template;
    }

    public static function createTextWithRightString(string $textMain, string $textRight): string
    {
        if ($textRight === '') {
            return "\\vspace{1cm}\\raggedright\n" . $textMain;
        }

        $textMain = str_replace(
            ['\begin{itemize}', '\end{itemize}'],
            ['\parbox{11cm}{\raggedright\begin{itemize}', '\end{itemize}}'],
            $textMain
        );
        return '\setlength{\columnsep}{15mm}' . "\n" . '\begin{wrapfigure}{r}{0.28\textwidth}\small
\vspace{-0.5cm}
\raggedright
' . $textRight . '
\vspace{1cm}
\end{wrapfigure}
' . $textMain;
    }

    public static function createContentString(Content $content): string
    {
        /** @var AntragsgruenApp $params */
        $params = \Yii::$app->params;

        $template                         = $content->template;
        $template                         = str_replace("\r", "", $template);
        $replaces                         = [];
        $replaces['%TITLE%']              = static::encodePlainString($content->title);
        $replaces['%TITLEPREFIX%']        = static::encodePlainString($content->titlePrefix);
        $replaces['%TITLE_LONG%']         = static::encodePlainString($content->titleLong);
        $replaces['%TITLE_RAW%']          = static::encodePlainString($content->titleRaw);
        $replaces['%AUTHOR%']             = $content->author;
        $replaces['%MOTION_DATA_TABLE%']  = $content->motionDataTable;
        $replaces['%TEXT%']               = static::createTextWithRightString($content->textMain, $content->textRight);
        $replaces['%INTRODUCTION_BIG%']   = $content->introductionBig;
        $replaces['%INTRODUCTION_SMALL%'] = $content->introductionSmall;
        $replaces['%PAGE_LABEL%']         = static::encodePlainString(\Yii::t('export', 'pdf_page_label'));
        $replaces['%INITIATOR_LABEL%']    = static::encodePlainString(\Yii::t('export', 'Initiators'));
        $replaces['%PUBLICATION_DATE%']   = static::encodePlainString($content->publicationDate);
        $replaces['%MOTION_TYPE%']        = static::encodePlainString($content->typeName);
        $replaces['%TITLE_LABEL%']        = static::encodePlainString(\Yii::t('export', 'title'));

        $replaces['%APP_TITLE%'] = static::encodePlainString(\Yii::t('export', 'pdf_app_title'));
        if ($content->agendaItemName) {
            $replaces['%APP_TOP_LABEL%'] = static::encodePlainString(\Yii::t('export', 'pdf_app_top_label'));
            $replaces['%APP_TOP%']       = static::encodePlainString($content->agendaItemName);
        } else {
            $replaces['%APP_TOP_LABEL%'] = '';
            $replaces['%APP_TOP%']       = '';
        }
        if ($content->logoData) {
            $fileExt                           = Image::getFileExtensionFromMimeType($content->logoData[0]);
            $filenameBase                      = uniqid('motion-pdf-image') . '.' . $fileExt;
            $tmpPath                           = $params->getTmpDir() . $filenameBase;
            $replaces['%LOGO%']                = '\includegraphics[width=4.9cm]{' . $tmpPath . '}';
            $content->imageData[$filenameBase] = $content->logoData[1];
        } else {
            $replaces['%LOGO%'] = '';
        }
        $template = str_replace(array_keys($replaces), array_values($replaces), $template);
        return $template;
    }

    /**
     * @param Content[] $contents
     * @return string
     * @throws Internal
     */
    public function createPDF($contents)
    {
        if (!$this->app->xelatexPath && !$this->app->lualatexPath) {
            throw new Internal('LaTeX/XeTeX-Export is not enabled');
        }
        $layoutStr   = static::createLayoutString($this->layout);
        $contentStr  = '';
        $cacheDepend = '';
        $count       = 0;
        $imageFiles  = [];
        $imageHashes = [];
        $pdfFiles    = [];
        $pdfHashes   = [];
        foreach ($contents as $content) {
            if ($count > 0) {
                $contentStr .= "\n\\newpage\n";
            }

            if ($content->replacingPdf) {
                $fileName = uniqid('motion-pdf-alternative') . '.pdf';
                $absoluteFilename = $this->app->getTmpDir() . $fileName;
                file_put_contents($absoluteFilename, $content->replacingPdf);
                $pdfHashes[$absoluteFilename] = md5($content->replacingPdf);
                $pdfFiles[] = $absoluteFilename;

                $contentStr .= "\n" . '\includepdf[pages=-]{' . $absoluteFilename . '}' . "\n";
                $count++;
                continue;
            }

            $contentStr .= static::createContentString($content);
            foreach ($content->imageData as $fileName => $fileData) {
                if (!preg_match('/^[a-z0-9_-]+(\.[a-z0-9_-]+)?$/siu', $fileName)) {
                    throw new Internal('Invalid image filename');
                }
                file_put_contents($this->app->getTmpDir() . $fileName, $fileData);
                $imageHashes[$this->app->getTmpDir() . $fileName] = md5($fileData);

                $imageFiles[] = $this->app->getTmpDir() . $fileName;
            }
            foreach ($content->attachedPdfs as $fileName => $attachedPdf) {
                if (!preg_match('/^[a-z0-9_-]+\.pdf$/siu', $fileName)) {
                    throw new Internal('Invalid pdf filename');
                }
                $absoluteFilename = $this->app->getTmpDir() . $fileName;
                file_put_contents($absoluteFilename, $attachedPdf);
                $pdfHashes[$absoluteFilename] = md5($attachedPdf);

                $pdfFiles[] = $absoluteFilename;

                $contentStr .= "\n" . '\includepdf[pages=-]{' . $absoluteFilename . '}' . "\n";
            }
            $cacheDepend .= $content->lineLength . '.';
            $count++;
        }
        $str = str_replace('%CONTENT%', $contentStr, $layoutStr);

        // Sometimes there is just no other way than to add some specific per-PDF-patches
        if (file_exists(__DIR__ . '/../../config/latex-replaces.php')) {
            $replacer = require(__DIR__ . '/../../config/latex-replaces.php');
            $str = $replacer($str);
        }

        $filenameBase = $this->app->getTmpDir() . uniqid('motion-pdf');

        if ($this->app->lualatexPath) {
            $cmd = 'PATH=/usr/ TEXMFCACHE=' . escapeshellarg($this->app->getTmpDir()) . ' ';
            $cmd .= $this->app->lualatexPath;
            $cmd .= ' -output-directory=' . escapeshellarg($this->app->getTmpDir());
            $cmd .= ' ' . escapeshellarg($filenameBase . '.tex');
        } else {
            $cmd = $this->app->xelatexPath;
            $cmd .= ' -interaction=batchmode';
            $cmd .= ' -output-directory=' . escapeshellarg($this->app->getTmpDir());
            if ($this->app->xdvipdfmx) {
                $cmd .= ' -output-driver=' . escapeshellarg($this->app->xdvipdfmx);
            }
            $cmd .= ' ' . escapeshellarg($filenameBase . '.tex');
        }

        $cacheDepend .= $str;
        foreach ($imageHashes as $file => $hash) {
            $cacheDepend = str_replace($file, $hash, $cacheDepend);
        }
        foreach ($pdfHashes as $file => $hash) {
            $cacheDepend = str_replace($file, $hash, $cacheDepend);
        }
        $cached = HashedStaticCache::getCache('latexCreatePDF', $cacheDepend);

        if (YII_ENV_DEV && isset($_REQUEST['latex_src'])) {
            Header('Content-Type: text/plain');
            echo $str;
            echo "\n\nIs in cache: " . ($cached ? "Yes" : "No") . "\n%" . $cmd;
            die();
        }

        if ($cached) {
            foreach ($imageFiles as $file) {
                unlink($file);
            }
            foreach ($pdfFiles as $file) {
                unlink($file);
            }
            return $cached;
        }

        file_put_contents($filenameBase . '.tex', $str);
        shell_exec($cmd);
        shell_exec($cmd); // Do it twice, to get the LastPage-reference right

        if (!file_exists($filenameBase . '.pdf')) {
            throw new Internal('An error occurred while creating the PDF: ' . $cmd);
        }
        $pdf = file_get_contents($filenameBase . '.pdf');

        unlink($filenameBase . '.aux');
        unlink($filenameBase . '.log');
        unlink($filenameBase . '.tex');
        unlink($filenameBase . '.pdf');
        unlink($filenameBase . '.out');

        foreach ($imageFiles as $file) {
            unlink($file);
        }
        foreach ($pdfFiles as $file) {
            unlink($file);
        }

        HashedStaticCache::setCache('latexCreatePDF', $cacheDepend, $pdf);

        return $pdf;
    }
}
