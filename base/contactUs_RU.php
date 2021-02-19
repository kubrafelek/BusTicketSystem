<?php
session_start();
include("../dbconnect.php");

if (!isset($_SESSION['email'])) {
    echo '<script> 
        if(confirm("You are not logged in ! \n Do you want to continue?")) {
            window.location.href = "../login.php";
         }</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>CONTACT US RU</title>
</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Left-aligned links (default) -->
    <a href="homepage_RU.php">Homepage</a>
    <a href="aboutUs_RU.php">About Us</a>
    <a href="contactUs_RU.php">Contact Us</a>
    <a href="support_RU.php">Support</a>

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <img src="../img/bus_icon.png" style="float: left; margin-top: 8px">
        <a href="../registered/registerUserProfile.php"><?php
            $email = $_SESSION['email'];
            $query = "SELECT * FROM users WHERE emailaddress='$email'";
            if (isset($conn)) {
                $queryConn = mysqli_query($conn, $query);

                if (!$queryConn){
                    echo "Error";
                }else{
                    while($row = mysqli_fetch_array($queryConn)){
                        $name = $row['userName'];
                        echo "Hi! ".$name;
                    }
                }
            } ?></a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div style="text-align:center">
        <h2>CONTACT WITH US</h2>
        <p>Filled the form contact us with officer</p>
    </div>
    <div class="row">
        <form action="#" method="POST">

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="What you want mentione ?" required>

            <label for="message">Message</label>
            <textarea class="msg_content" name="message" placeholder="Write message..." style="width: 100%;
    height: 165px;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: 3px solid #b7d7e8;
    background: #f1f1f1;" required></textarea>

            <button type="submit" class="addjourneybtn" name="send_contact">Send</a></button>
        </form>
    </div>
</div>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php
if (isset($_POST['send_contact'])) {

    $mailForm = $_SESSION['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    #int random number generator
    $feedbackId = rand(1000000, 9999999);
    $feedbacks = "INSERT INTO comments(feedbackId,subject,message,email) VALUES ('$feedbackId','$subject','$message','$mailForm')";
    if (isset($conn)) {
        $result = mysqli_query($conn, $feedbacks);
        if (!$result) {
            #echo "Error, check your code !!!";
            echo '<script> 
            if(confirm("Message can not send to Officer.\n Do you want to continue?")) {
                window.location.href = "../registered/registerUserProfile.php"
            }</script>';
            exit();
        } else {
            #echo "Message send to Officer";
            echo '<script> 
            if(confirm("Message send to Officer.\n Do you want to continue?")) {
                window.location.href = "../registered/registerUserProfile.php"
            }</script>';
            exit();
        }
    }
}
?>