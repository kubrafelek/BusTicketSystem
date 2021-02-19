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

if (isset($_SESSION['email'])){
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>VIEW ALL PAST TICKETS RU</title>
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
    <h1>View All Past Tickets</h1>
    <hr class="hr_main">
    <table id="seats" style="width: 75%">
        <tr style="color: darkred">
            <th>Bus</th>
            <th>PNR</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <?php
            $query = "SELECT * FROM journey J, ticket T WHERE J.journeyId=T.journeyId AND T.emailaddress='$email' AND T.seatId ='0' ORDER BY J.journeyDate";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                echo '<style>p{color:red;}</style><p>Warning: Any ticket find !</p>';
            }

            while ($row = mysqli_fetch_array($result)) {

            if (($row['isCancelled'] == '0') && ($row['ticketType'] == 'PAST')) {
            ?>
        </tr>
        <tr>
            <td><img src="../img/bus.png" width="50px" height="50px"></td>
            <td><?php echo $row['PNR']; ?></td>
            <td><?php echo $row['DeparturePlace']; ?></td>
            <td><?php echo $row['DestinationPlace']; ?></td>
            <td><?php
                $originalDate = $row['journeyDate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                echo $newDate ?></td>
            <td><?php echo $row['journeyTime']; ?></td>
            <td><?php
                if ($row['ticketType'] == 'Campaign') {
                    $price = $row['price'];
                    if ($row['campaignId'] == 1) {
                        $price = $price - ($price * 0.1);
                        echo $price;
                    } elseif ($row['campaignId'] == 2) {
                        $price = $price - ($price * 0.15);
                        echo $price;
                    } elseif ($row['campaignId'] == 3) {
                        $price = $price - ($price * 0.2);
                        echo $price;
                    } elseif ($row['campaignId'] == 4) {
                        $price = $price - ($price * 0.25);
                        echo $price;
                    }
                } else {
                    $price = $row['price'];
                    echo $price;
                }
                ?></td>
            <?php
            }
            }
            }
            }
            ?>
        </tr>

    </table>
    <br>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>
