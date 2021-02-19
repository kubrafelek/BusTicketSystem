<?php
session_start();
include("../dbconnect.php");
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in !";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    include("../admin/loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>ADMIN PROFILE</title>

    <style>

        .skills {
            text-align: right;
            padding-top: 10px;
            padding-bottom: 3px;
            color: white;
        }

        .html {width: 90%; background-color: #4CAF50;}
        .css {width: 80%; background-color: #2196F3;}
        .js {width: 65%; background-color: #f44336;}

    </style>
</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="../admin/adminProfile.php">Admin Profile</a>
        <a href="../logout.php">Logout</a>
    </div>

</div>

<div class="container" style="width: 50%">
    <h1>System Transactions <img src="../img/employee.png"></h1>
    <hr class="hr_main">
    <br>
    <button onclick="window.location.href='addJourney_A.php'" type="submit" class="transactions_admin_btn">Add Journey</button>
    <button onclick="window.location.href='viewJourney_A.php'" type="submit" class="transactions_admin_btn">View Journeys</button>
    <button onclick="window.location.href='infoBox_A.php'" type="submit" class="transactions_admin_btn">View Feedbacks</button>
    <button onclick="window.location.href='addCampaign_A.php'" type="submit" class="transactions_admin_btn">Add Campaign</button>
    <button onclick="window.location.href='cancelTicket_A.php'" type="submit" class="transactions_admin_btn">Cancel Ticket</button>
</div>

<div class="container" style="width: 50%;  margin-top:-16.4%; float:right;">
    <h1>System Survey <img src="../img/customer.png"></h1>
    <hr class="hr_main">
    <p>Happy Customer</p>
    <div class="contai">
        <div class="skills html">90%</div>
    </div>

    <p>Success Journey</p>
    <div class="contai">
        <div class="skills css">80%</div>
    </div>

    <p>Customer Comments</p>
    <div class="contai">
        <div class="skills js">65%</div>
    </div>

</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>
