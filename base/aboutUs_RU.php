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

    <title>ABOUT US RU</title>
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
    <h1>Bus Ticketly</h1>
    <hr class="hr_main">
    <h2 style="text-align:center; color:dodgerblue">About Us</h2>
    <p id="text_classic">
        Being the biggest land transportation company in terms of revenue size and number of passengers transported, the
        leading company of Turkey’s transportation sector BusTicketly has 1463 buses in total, 673 which being its own
        property within its fleet.

        It owns a young bus fleet and the age average of it is 3. In addition to the strong capital and organization
        structure of BusTicketly, to which it is registered, Metro Tourism has a significant advantage against its
        competitors through its domestic and overseas ticket sales network via a total of 1.000 active agencies in 77
        cities across Turkey. In a day, an average of 1400 trips take place with approximately 19.000.000 passengers
        transported annually. It provides inner-city transportation for the passengers via its 307 inner-city shuttles.

        In the year 2013, total number of passengers of the Company what was around 21 million reached above 23 million
        in the year 2014. In a period, where attractive options are created for airline, maritime and railroad passenger
        transportation, BusTicketly’s continuation on increasing the number of passengers and destinations shows
        Company’s strong status in the sector. Adopting the principle of not making any compromises in service quality,
        BusTicketly's passenger transportation target to reach in the year 2015 is 26 million.
    </p>
    <br>
    <br>
    <br>
    <h2 style="text-align:center; color:dodgerblue">Our Team</h2>
    <div class="row">
        <div class="column_aboutUs">
            <h2>Furkan Yorulmaz</h2>
            <p class="title">CEO & Founder</p>
            <p>furkan@busmail.com</p>
        </div>

        <div class="column_aboutUs">
            <h2>Göksu Pekacar</h2>
            <p class="title">Director</p>
            <p>goksu@busmail.com</p>
        </div>

        <div class="column_aboutUs">
            <h2>Ümmügülsüm Çamoğlu</h2>
            <p class="title">Officer</p>
            <p>gulsum@busmail.com</p>
        </div>
    </div>

</div>

<br>
<br>
<br>
<br>
<br>
<br>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>