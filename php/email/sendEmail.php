<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class sendEmail
{

    public function actionEmail($data)
    {

        extract($data);
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'lnu.ovpsdas@gmail.com';                     //SMTP username
            $mail->Password   = 'amzsaldyrqxusjwj';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->addAttachment($fileLocation);

            //Recipients
            $mail->isHTML(true);
            $mail->setFrom('lnu.ovpsdas@gmail.com', 'LNU Student Development and Auxiliary Services');
            $mail->addAddress($student_email, $student_name);
            $mail->addAddress($student_email_2, $student_name);
            $mail->Subject = 'Schedule for Counselling';
            $mail->Body = 'Good Day ' . $student_name . '<br> <p>This is auto Generated Email From OVPSDAS, your schedule for Counselling this "' . $counselling_date . '  ' . $counselling_time . '" Please come to this day. </p>';
            $mail->AltBody = 'Good Day ' . $student_name . 'This is auto Generated Email From OVPSDAS, your schedule for Counselling this "' . $counselling_date . '  ' . $counselling_time . '" Please come to this day.';

            //send the message, check for errors

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
