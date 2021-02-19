<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>TICKET CANCELED BY G</title>
    <style>
        /* Add padding and center-align text to the container */
        .container-contactUs {
            padding: 60px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal_background_contactUs {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            padding-top: 50px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content/Box */
        .modal-content-contactUs {
            background-color: #87bdd8;
            margin: 5% auto 15% auto;
            border: 1px solid #888;
            width: 50%;
        }

        /* The Modal Close Button (x) */
        .close-contactUs {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
        }

    </style>
</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Left-aligned links (default) -->
    <a href="../base/homepage_G.php">Homepage</a>
    <a href="../base/aboutUs_G.php">About Us</a>

    <a onclick="document.getElementById('id01').style.display='block'">Contact Us</a>
    <div id="id01" class="modal_background_contactUs">
        <span onclick="document.getElementById('id01').style.display='none'" class="close-contactUs"
              title="Close Modal">×</span>
        <form class="modal-content-contactUs">
            <div class="container-contactUs">
                <h1 style="color: blanchedalmond">You cannot use contact us</h1>
                <p> You must be registered into website</p>
            </div>
        </form>
    </div>

    <a href="../base/support_G.php">Support</a>

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="../login.php">Login</a>
        <a href="../registration.php">Registration</a>
    </div>

</div>

<div class="container">
    <h1>Ticket Cancel</h1>
    <hr class="hr_main">
    <form action="#" method="POST">
        <label>Enter PNR for canceling:</label>
        <input style="width: 30%" type="text" placeholder="Enter PNR number" name="pnr">

        <br>
        <label>Enter CCN for canceling:</label>
        <input style="width: 30%" type="text" placeholder="Enter CCNumber" name="ccn">
        <br>
        <button style="width: 10%; margin-left: 32%" type="submit" class="canceljourney_tiketbtn" name="cancel_ticket">
            Cancel
        </button>
    </form>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php
session_start();
include("../dbconnect.php");

if (isset($_POST['cancel_ticket'])) {
    date_default_timezone_set("Europe/Istanbul");

    $PNR = $_POST['pnr'];
    $ticketDate = "SELECT * FROM ticket WHERE PNR='$PNR'";
    if (isset($conn)) {
        $result = mysqli_query($conn, $ticketDate);

        if (!$result) {
            echo "SQL error";
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
                                 if(confirm("Your ticket cannot cancel !\nDo you want to continue?")) {
                                     window.location.href = "../base/homepage_G.php"
                           }</script>';
                        exit();
                    } else {
                        $cancelTicket = "UPDATE ticket SET isCancelled='1',seatId='0' WHERE PNR='$PNR'";
                        $result3 = mysqli_query($conn, $cancelTicket);

                        #return money back to user
                        $ccn = $_POST['ccn'];
                        $priceOfTicket = $row2['price'];
                        $getCCN = "SELECT * FROM payment WHERE CCNumber='$ccn'";
                        $resultCCN = mysqli_query($conn, $getCCN);

                        if (!$resultCCN) {

                            echo '<script>
                                if(confirm("Invalid CCNumber or PNR !\nDo you want to continue?")) {
                                    window.location.href = "../base/homepage_G.php"
                                 }</script>';
                            exit();
                        } else {
                            while ($row3 = mysqli_fetch_array($resultCCN)) {
                                $balance = $row3['balance'];
                                $balance += $priceOfTicket;

                                $cancelTicket = "UPDATE payment SET balance='$balance' WHERE CCNumber='$ccn'";
                                $result4 = mysqli_query($conn, $cancelTicket);

                                echo '<script>
                                if(confirm("Your ticket canceled, successfully.\nDo you want to continue?")) {
                                    window.location.href = "../base/homepage_G.php"
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


<script>
    var modal = document.getElementById('id01');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
