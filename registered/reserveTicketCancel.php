<?php
session_start();
include("../dbconnect.php");

if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>RESERVE TICKET CANCELED RU</title>
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
    <h1>Reserved Ticket Cancel</h1>
    <hr class="hr_main">
    <form action="#" method="POST">
        <label>Enter PNR for canceling:</label>
        <input style="width: 30%" type="text" placeholder="Enter PNR number" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}" name="pnr">

        <br>
        <label>Enter CCN for canceling:</label>
        <input style="width: 30%" type="text" placeholder="Enter CCNumber" name="ccn">
        <button style="width: 10%" type="submit" class="canceljourney_tiketbtn" name="cancel_ticket">Cancel</button>
    </form>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php
if (isset($_POST['cancel_ticket'])) {

    date_default_timezone_set("Europe/Istanbul");
    #geçersiz pnr diye alert vermeli
    $PNR = $_POST['pnr'];
    $ticketDate = "SELECT * FROM reservation WHERE reservationId='$PNR'";
    if (isset($conn)) {
        $result = mysqli_query($conn, $ticketDate);

        if (!$result) {
            #echo "SQL error";
            echo '<script> 
                        if(confirm("You cannot cancel ticket ! \n  Reservation Id is invalid...")) {
                            window.location.href = "../base/homepage_RU.php"
                         }</script>';
            exit();
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $journeyId = $row['journeyId'];

                $query = "SELECT * FROM journey WHERE journeyId='$journeyId'";
                $result2 = mysqli_query($conn, $query);
                while ($row2 = mysqli_fetch_array($result2)) {
                    $journeyDate = $row2['journeyDate'];

                    $today = strtotime("today");
                    if (($journeyDate < $today) && ($row['isCancelled'] == '1')) {
                        echo '<script> 
                        if(confirm("You cannot cancel ticket ! \n Ticket already cancelled or Past date for ticket cancelling. ")) {
                            window.location.href = "../base/homepage_RU.php"
                         }</script>';
                        exit();

                    } else {
                        $cancelTicket = "UPDATE reservation SET isCancelled='1',ticketType='Cancelled',seatID='0' WHERE reservationId='$PNR'";
                        $result3 = mysqli_query($conn, $cancelTicket);

                        #return money back to user
                        $ccn = $_POST['ccn'];
                        $priceOfTicket = $row2['price'];
                        $getCCN = "SELECT * FROM payment WHERE CCNumber='$ccn'";
                        $resultCCN = mysqli_query($conn, $getCCN);

                        if (!$resultCCN) {
                            #echo "Error";
                            echo '<script>
                                if(confirm("Invalid CCNumber or PNR !\nDo you want to continue?")) {
                                    window.location.href = "../base/homepage_RU.php"
                                 }</script>';
                            exit();
                        } else {
                            while ($row3 = mysqli_fetch_array($resultCCN)) {
                                $balance = $row3['balance'];
                                $balance += $priceOfTicket;

                                $cancelTicket = "UPDATE payment SET balance='$balance' WHERE CCNumber='$ccn'";
                                $result4 = mysqli_query($conn, $cancelTicket);

                                #echo " Your ticket canceled.";
                                echo '<script>
                                if(confirm("Your ticket canceled, successfully.\nDo you want to continue?")) {
                                    window.location.href = "../base/homepage_RU.php"
                                 }</script>';
                                exit();
                            }
                        }
                    }
                }
            }

        }
    }
}
?>
