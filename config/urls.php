<?php
use app\models\settings\AntragsgruenApp;

/**
 * @var AntragsgruenApp $params
 */


$domPlain  = $params->domainPlain;
$dom       = $params->domainSubdomain;
$domv      = $dom . '<consultationPath:[\w_-]+>/';
$domadmin  = $domv . 'admin/';
$dommotion = $domv . 'motion/<motionId:\d+>';
$domamend  = $domv . 'motion/<motionId:\d+>/amendment/<amendmentId:\d+>';

$url_rules = [
    $domadmin . ''                                    => 'admin/index',
    $domadmin . 'consultation/'                       => 'admin/index/consultation',
    $domadmin . 'consultationExtended/'               => 'admin/index/consultationextended',
    $domadmin . 'translation/'                        => 'admin/index/translation',
    $domadmin . 'motion/update/<motionId:\d+>'        => 'admin/motion/update',
    $domadmin . 'motion/<_a:(index|update|type)>'     => 'admin/motion/<_a>',
    $domadmin . 'motion/<_a:(listall)>'               => 'admin/motion/<_a>',
    $domadmin . 'amendments'                          => 'admin/amendments',
    $domadmin . 'amendments/<_a:(index|update)>'      => 'admin/amendments/<_a>',
    $domadmin . 'motionComments'                      => 'admin/motionComments',
    $domadmin . 'motionComments/<_a:(index)>'         => 'admin/motionComments/<_a>',
    $domadmin . 'amendmentComments'                   => 'admin/amendmentComments',
    $domadmin . 'amendmentComments/<_a:(index)>'      => 'admin/amendmentComments/<_a>',
    $domadmin . 'texts'                               => 'admin/texts',
    $domadmin . 'texts/<_a:(index|update|delete)>'    => 'admin/texts/<_a>',
    $domadmin . 'kommentare_excel'                    => 'admin/index/kommentareexcel',
    $domadmin . 'namespacedAccounts'                  => 'admin/index/namespacedAccounts',
    $domadmin . 'ae_pdf_list'                         => 'admin/index/aePDFList',
    $domadmin . 'admins'                              => 'admin/index/admins',
    $domadmin . 'consultations'                       => 'admin/index/consultations',

    $dom . 'login'                                    => 'user/login',
    $dom . 'logout'                                   => 'user/logout',
    $dom . 'confirmregistration'                      => 'user/confirmregistration',
    $dom . 'loginbyredirecttoken'                     => 'user/loginbyredirecttoken',
    $dom . 'checkemail'                               => 'user/ajaxIsEmailRegistered',
    $dom . 'loginwurzelwerk'                          => 'user/loginwurzelwerk',
    $domv . 'unsubscribe'                             => 'user/unsubscribe',

    $domv . '<_a:(legal|help|search|savetextajax)>'   => 'consultation/<_a>',
    $domv . '<_a:(pdfs|maintainance)>'                => 'consultation/<_a>',
    $domv . 'aenderungsantrags_pdfs'                  => 'consultation/aenderungsantragsPdfs',
    $domv . 'feedAlles'                               => 'consultation/feedAlles',
    $domv . 'feedAntraege'                            => 'consultation/feedAntraege',
    $domv . 'feedAenderungsantraege'                  => 'consultation/feedAenderungsantraege',
    $domv . 'feedKommentare'                          => 'consultation/feedKommentare',
    $domv . 'motion/create'                           => 'motion/create',
    $dommotion                                        => 'motion/view',
    $dommotion . '/image'                             => 'motion/viewimage',
    $dommotion . '/<_a:(pdf|odt|createconfirm|edit)>' => 'motion/<_a>',
    $dommotion . '/plain_html'                        => 'motion/plainHtml',
    $dommotion . '/aes_einpflegen'                    => 'motion/aes_einpflegen',
    $domamend                                         => 'amendment/view',
    $domamend . '/<_a:(pdf|createconfirm|edit)>'      => 'amendment/<_a>',
    $domamend . 'pdf'                                 => 'amendment/pdf',
    $domamend . 'pdfdiff'                             => 'amendment/pdfDiff',
    $dommotion . '/amendment/create'                  => 'amendment/create',
    $domv                                             => 'consultation/index',
    $dom                                              => 'consultation/index',
];


if ($params->multisiteMode) {
    $url_rules = array_merge(
        [
            $domPlain                => 'manager/index',
            $domPlain . 'createsite' => 'manager/createsite',
            $domPlain . 'legal'      => 'manager/legal',
            $domPlain . 'password'   => 'manager/password',
            $domPlain . 'billing'    => 'manager/billing',
            $domPlain . 'login'      => 'manager/login',
            $domPlain . 'logout'     => 'manager/logout',
        ],
        $url_rules
    );

    if ($params->prependWWWToSubdomain) {
        foreach ($url_rules as $key => $val) {
            $url_rules[str_replace("http://", "http://www.", $key)] = $val;
        }
    }
}


return $url_rules;
