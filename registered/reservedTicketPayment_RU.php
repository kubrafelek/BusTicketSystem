<?php
session_start();
include("../dbconnect.php");

if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>RESERVED TICKET PAYMENT RU</title>

    <style>
        input[type=tel] {
            width: 20%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: 2.5px solid #b7d7e8;
            background: #f1f1f1;
        }

        input[type=tel]:focus {
            background-color: #ddd;
            outline: none;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<div class="navbar">
    <!-- Left-aligned links (default) -->
    <a href="../base/homepage_RU.php">Homepage</a>
    <a href="../base/aboutUs_RU.php">About Us</a>
    <a href="../base/contactUs_RU.php">Contact Us</a>
    <a href="../base/support_RU.php">Support</a>

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="registerUserProfile.php"><?php include "registeredUserName.php"; ?></a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h1>Reserved Ticket Payment</h1>
    <hr class="hr_main">
    <label>Credit Card Number :</label>
    <form method="POST">
        <input type="tel" placeholder="..." name="CCNumber" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}" required>
        <button style="width: 10%" type="submit" name="paymentButton" class="CCNumbers">Apply</button>
    </form>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php

if (isset($_POST['reservationId'])) {
    $reservationId = $_POST['reservationId'];
    #echo $reservationId. " ";
    if (isset($conn)) {
        $queryJourneyId = mysqli_query($conn, "SELECT * FROM reservation WHERE reservationId='$reservationId'");
        while ($row = mysqli_fetch_array($queryJourneyId)) {

            $journeyId = $row['journeyId'];
            #echo $journeyId;

            $ticketStatus = "UPDATE reservation SET ticketType='Paid' WHERE reservationId='$reservationId'";
            $ticketType = mysqli_query($conn, $ticketStatus);
            if(!$ticketType){
                #echo "Error";
            }else{
                #echo "Works";
            }

            $queryPrice = mysqli_query($conn, "SELECT * FROM journey WHERE journeyId='$journeyId'");
            while ($row2 = mysqli_fetch_array($queryPrice)) {
                $_SESSION['price'] = $row2['price'];
                #echo " ".$_SESSION['price'];
            }
        }
    }
}

if (isset($_POST['paymentButton'])) {
    $CCNumber = $_POST['CCNumber'];
    $price = $_SESSION['price'];;
    if (isset($conn)) {
        $res = mysqli_query($conn, "SELECT * FROM payment WHERE CCNumber='$CCNumber'");

        while ($row = mysqli_fetch_array($res)) {
            $balance = $row['balance'];
            if ($row['balance'] < $price) {
                echo '<script> 
                                        if(confirm("Your balance have not enough money !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_RU.php"
                                      }</script>';
                exit();

            } else {
                $balance -= $price;
                $balanceUpdate = "UPDATE payment SET balance='$balance' WHERE CCNumber='$CCNumber'";
                $output3 = mysqli_query($conn, $balanceUpdate);

                if (!$output3) {
                    echo '<script> 
                                        if(confirm("Your ticket purchase is not complete !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_RU.php"
                                      }</script>';
                    exit();

                } else {

                    /*echo '<script>
                                        if(confirm("Your ticket purchased, successfully.\nDo you want to continue?")) {
                                            window.location.href = "viewAllMyTickets_RU.php"
                                      }</script>';*/
                    header("Location: finishReservePaySuccess.php");
                    exit();
                }
            }
        }
    }
}
?>






