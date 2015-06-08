<?php

namespace app\views\pdfLayouts;

use app\models\db\Motion;
use yii\helpers\Html;

class BDK extends IPDFLayout
{
    /** @var BDKPDF $pdf */
    protected $pdf;

    /**
     * @return \TCPDF
     */
    public function createPDFClass()
    {
        $pdf = new BDKPDF($this);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins(25, 27, 25);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 5);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('dejavusans', '', 10);

        $this->pdf = $pdf;

        return $pdf;
    }

    /**
     * @param Motion $motion
     */
    public function printMotionHeader(Motion $motion)
    {
        $pdf = $this->pdf;

        $pdf->setMotionTitle($motion->titlePrefix, $motion->title);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);


        $title = '26. Ordentliche Bundesdelegiertenkonferenz von BÜNDNIS 90/DIE GRÜNEN,<br>
            01.-03. Dezember 2006. Kölnmesse, Köln-Deutz';
        $pdf->SetY(40);
        $pdf->SetFont("helvetica", "B", 13);
        $pdf->writeHTMLCell(185, 0, 10, 10, $title, 0, 1, 0, true, 'R');


        $pdf->SetFont("helvetica", "", 12);
        $motionData = '<span style="font-size: 20px; font-weight: bold">';
        $motionData .= Html::encode($motion->titlePrefix) . ' </span>';
        $motionData .= '<span style="font-size: 16px; font-weight: bold;">';
        $motionData .= Html::encode($motion->title) . '</span>';
        $motionData .= '<br><br>';

        $motionData .= '<table>';
        $motionData .= '<tr><th style="width: 28%;">Antragsteller/innen:</th>';
        $motionData .= '<td>' . Html::encode($motion->getInitiatorsStr()) . '</td></tr>';

        $motionData .= '</table>';

        $pdf->writeHTMLCell(170, 0, 25, 35, $motionData, 1, 1, 0, true, 'L');

        $pdf->Ln(11);
    }
}
