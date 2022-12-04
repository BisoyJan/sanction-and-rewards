<?php

namespace Classes;

use mikehaertl\pdftk\Pdf;

class generatePDF
{
    public function generateReferral($data)
    {
        extract($data);

        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $result = $pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY REFERRAL SLIP FORM.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY REFERRAL SLIP FORM.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/referrals/' . $filename);



        return $filename;
    }

    public function generateAction($data)
    {
        extract($data);

        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY ACTION SLIP FORM.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY ACTION SLIP FORM.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/action/' . $filename);



        return $filename;
    }

    public function generateCounselling($data)
    {
        extract($data);

        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY CASE SLIP FORM.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/DISCIPLINARY CASE SLIP FORM.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/counselling/' . $filename);



        return $filename;
    }

    public function generateLeadership($data)
    {
        extract($data);

        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/LEADERSHIP.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/LEADERSHIP.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/leadership/' . $filename);

        // if ($result === false) {
        //     $filename = $pdf->getError();
        // }

        return $filename;
    }

    public function generateGoodDeeds($data)
    {

        extract($data);
        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/GOOD-DEEDS-CERTIFICATE.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/GOOD-DEEDS-CERTIFICATE.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/good-deeds/' . $filename);



        return $filename;
    }

    public function generateOutstandingAthlete($data)
    {

        extract($data);
        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/OUTSTANDING-ATHLETE-CERTIFICATE.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/OUTSTANDING-ATHLETE-CERTIFICATE.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/outstanding-athlete/' . $filename);



        return $filename;
    }

    public function generateMVPAthlete($data)
    {

        extract($data);
        $filename =  $student_no . '_' . $last_inserted_id . '.pdf';

        $pdf = new Pdf('../../assets/docs/themeplates/REWARDS-ATHLETE-MVP-CERTIFICATE.pdf');

        //$pdf = new Pdf('../../assets/docs/themeplates/REWARDS-ATHLETE-MVP-CERTIFICATE.pdf');
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs('../../assets/docs/processed/mvp-athlete/' . $filename);



        return $filename;
    }
}
