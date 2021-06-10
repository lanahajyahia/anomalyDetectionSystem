<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from thse latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

define("API_KEY", "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");
define("SENDER_EMAIL", "hajyahial@gmail.com");
function sendmail($sendto, $subject, $content)
{
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom(SENDER_EMAIL, "AnomalyDetection");
    $email->setSubject($subject);
    $email->addTo($sendto, "Yes");
    $email->addContent("text/plain", $content);
    $sendgrid = new \SendGrid(API_KEY);
    try {
        $response = $sendgrid->send($email);
    } catch (Exception $e) {
    }
}
