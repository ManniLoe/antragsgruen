<?php

namespace app\views\pdfLayouts;

use Yii;
use yii\helpers\Html;

class BDKPDF extends \TCPDF
{
    private $headerTitle;
    private $headerPrefix;

    /**
     */
    public function __construct()
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * @param string $prefix
     * @param string $title
     */
    public function setMotionTitle($prefix, $title)
    {
        $this->headerPrefix = $prefix;
        $this->headerTitle  = $title;
    }

    // @codingStandardsIgnoreStart
    /**
     */
    public function Header()
    {
        $this->SetFont('helvetica', '', 10);
        $title = '<span style="font-size: 16px;">' . Html::encode($this->headerPrefix) . ' </span>';
        $title .= '<span style="font-size: 14px;">' . Html::encode($this->headerTitle) . '</span>';
        $this->writeHTMLCell(
            170,
            10,
            25,
            5,
            $title,
            ['B' => ['width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => [0, 0, 0]]],
            1,
            false,
            true,
            'C'
        );
    }

    /**
     */
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 10);
        $this->Cell(
            185,
            10,
            Yii::t('pdf', 'Page') . ' ' . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages(),
            0,
            false,
            'R',
            0,
            '',
            0,
            false,
            'T',
            'M'
        );
    }
    // @codingStandardsIgnoreEnd
}
