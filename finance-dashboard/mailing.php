<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

// Server configuration (using Gmail SMTP)
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; // Use 465 for SSL
$mail->SMTPSecure = 'tls'; // or 'ssl'
$mail->SMTPAuth = true;

// Use a secure alternative instead of "Less secure app access" if possible
// e.g., App passwords: https://support.google.com/accounts/answer/186832
// If you must use "Less secure app access", be aware of the risks:
// https://support.google.com/accounts/answer/6020300

// Replace with your Gmail address and a secure password
$mail->Username = 'incredibleinfo333@gmail.com';
$mail->Password = 'dego ajcg xmrc cvwc';

// Recipient details
$mail->addAddress('ma5814294@gmail.com', 'anas'); // Replace with your desired recipient

// Sender details
$mail->setFrom('incredibleinfo333@gmail.com', 'Anas qureshi'); // Replace with your preferred sender details

// Email content
$mail->Subject = 'Email using pdf';
$mail->Body = 'check the challan.';
$mail->isHTML(false); // Set to true for HTML content
$filename = 'C:/xampp/htdocs/pixxel_house_lms/iph_challan.pdf'; // Replace with the actual path to your file
$attachmentName = 'myfile.pdf'; // You can customize the displayed name of the attachment

// Add the attachment using addAttachment($filePath, $fileName, $encoding, $mimeType)
$mail->addAttachment($filename, $attachmentName);
try {
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
