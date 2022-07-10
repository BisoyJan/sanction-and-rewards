<?php

namespace Classes;

use mikehaertl\pdftk\Pdf;

class generatePDF
{
    public function generateReferral($data)
    {
        extract($data);

        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';
        $pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY REFERRAL SLIP FORM.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/referrals/' . $filename);

        return $filename;
    }
}
