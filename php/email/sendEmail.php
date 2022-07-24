<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once 'class-db.php';

class sendEmail
{

    public function actionEmail($data)
    {
        extract($data);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;

            //Set the encryption mechanism to use:
            // - SMTPS (implicit TLS on port 465) or
            // - STARTTLS (explicit TLS on port 587)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';

            $email = 'lnu.ovpsdas@gmail.com'; // the email used to register google app
            $clientId = '192524252300-d8ho72gmu7jnipjef90mmbpgtm50t5jk.apps.googleusercontent.com';
            $clientSecret = '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';

            $db = new DB();
            $refreshToken = $db->get_refersh_token();

            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );

            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );

            $mail->addAttachment($fileLocation);

            //Recipients
            $mail->isHTML(true);
            $mail->setFrom($email, 'LNU Student Development and Auxiliary Services');
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
