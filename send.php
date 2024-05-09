<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gamil.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dharmikambaliya153@gmail.com';
    $mail->Password = 'cber vgbo wzzs avqf';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setForm('dharmikambaliya153@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isPHP(true);

    $mail->Subject = $_POST("subject");
    $mail->Body = $_POST("message");

    $mail->send();

    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = 'ticket_show.php';
    "

}
?>