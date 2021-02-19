<?php
session_start();
include("dbconnect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['send_email'])){

    $code = "aKPj7845";
    $email = $_POST['email'];

    $codeSql = "UPDATE users SET code='$code' WHERE emailaddress='$email'";

    if (isset($conn)) {
        $codeConnect = mysqli_query($conn, $codeSql);
    }

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    /*$mail->SMTPOptions = array(
        'tls' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );*/

    try {
        //Server settings
        $mail->SMTPDebug = 3;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->Username = 'kbr.flk8@gmail.com';                     // SMTP username
        $mail->Password = '1k2b3r4f5l6k.';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('kbr.flk8@gmail.com', 'Recovery Password');
        $mail->addAddress($_POST['email']);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'BusTicketly Officer Management';
        $mail->Body = 'You can use this code to making change password <bold>aKPj7845</bold>';

        if($mail->send()){
            echo 'Message has been sent';
            echo '<script>
                    if(confirm("Message has been sent, successfully !")) {
                    window.location.href = "../BusTicketly/changePassword.php"
                    }</script>';
            exit();
        }else{
            echo 'Message can not send';
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
session_destroy();
?>