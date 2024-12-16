<?php
use PHPMailer\PHPMailer\PHPMailer; // On importe la classe tout en haut
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // On charge l'autoloader de composer
$mail = new PHPMailer(true); // Instantiation
// Paramètres du serveur
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
// Informations envoyeur/réceptionneur
$mail->Username = 'hulk97946@gmail.com';
$mail->Password = 'zjkq bqay xklk cyhv';
$mail->From = 'sarah.test@gmail.com';
$mail->FromName = 'Sarah I';
$mail->addAddress('sapoub.2b@gmail.com');
// Contenu
$mail->isHTML(true); // Permet l'interprétation de l'HTML dans le mail
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->Subject = 'Reunion URGENTE louloute';
$body = '<p>This is a test message HI HI </p>';
$mail->Body = $body;
try {
    $mail->send();
} catch(Exception $e) {
    echo "Erreur: ". $e->getMessage();
}
exit;
