<?php
session_start();
#$conn = mysqli_connect("localhost", "root", "", "busdb");
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

    <title>SUPPORT G</title>
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
    <h2 style="text-align:center">FREQUENTLY ASKED QUESTIONS</h2>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I reserve ticket?</h8>
        <p> If you want to make a ticket reservation, you must first be a registered user in our system.
            Then you can list the journeys by logging into the system. In this way, you can complete your
            transaction by creating a journey reservation at the appropriate position.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I buy the ticket with the special price?</h8>
        <p>If you want to take advantage of the promotional ticket prices, you must be a registered user in our system.
            If you are registered in the system, you can view the tickets with campaign and make the purchase.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">Can I cancel the ticket I have bought?</h8>
        <p>Yes, you can cancel your purchased ticket.
            If you are a registered user in the system, you can cancel a tickets by viewing the view all my ticket details on your profile page.
            If you are an unregistered user, you can cancel the ticket and also view ticket details by entering  in the "Enter pnr number" section on the homepage.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I contact with Officer?</h8>
        <p>If you are a registered user in the system, you can consult Officera by clicking the contact us page.
            However, if you are a guest user, you cannot contact with Officer.
            For this reason, we expect you to be registered in the system.</p>
    </div>
</div>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>