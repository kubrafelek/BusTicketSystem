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
    <title>VIEW ALL MY TICKETS RU</title>
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
    <h1>View All Tickets</h1>
    <hr class="hr_main">
    <table id="seats" style="width: 90%">
        <h4 style="color: darkolivegreen">Buy Tickets Table</h4>
        <tr style="color: darkred">
            <th>Bus</th>
            <th>PNR</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>SeatNo</th>

            <?php
            $query = "SELECT * FROM journey J, ticket T WHERE J.journeyId=T.journeyId AND T.emailaddress='$email' AND T.seatId!='0' ORDER BY J.journeyDate";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                echo '<style>p{color:red;}</style><p>Warning: Any ticket find !</p>';
            }
            while ($row = mysqli_fetch_array($result)) {

            $seatId1 = $row['seatId'];
            //if reserve ticket date passed ticket cannot be cancelled
            $today = strtotime("today");
            $journeyDate = $row['journeyDate'];
            $journeyDate = strtotime($journeyDate);

            if ($today > $journeyDate) {
                $ticketType = $row['ticketType'];
                $PNR = $row['PNR'];

                $pastTicket = "UPDATE ticket SET ticketType='PAST',  seatId='0' WHERE PNR=$PNR";
                $connection = mysqli_query($conn, $pastTicket);
            }
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
            <td><?php echo $seatId1 ?></td>

            <td>
                <?php
                if (($row['ticketType'] == 'Campaign')) {
                    echo "<button type='submit' style=\"background-color: darkgray; width: 70%; color: black; font-weight: bolder; border-radius: 20px; font-size: 14px;\" disabled>Campaign Ticket</button>";
                } else {
                    echo "<button type='submit' style=\"background-color: crimson; width: 70%; border-radius: 20px; font-weight: bolder; font-size: 14px;\"><a href='buyTicketCancel.php'>Cancel Ticket</a></button>";
                } ?>

            </td>
            <?php
            }
            ?>
        </tr>

    </table>
    <br>
    <!-- Reserve Tickets -->
    <table id="seats" style="width: 95%">
        <tr style="color: darkred">
            <h4 style="color: darkolivegreen">Reserved Tickets Table</h4>
            <th>Bus</th>
            <th>PNR</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>SeatNo</th>
            <?php
            $query2 = "SELECT * FROM journey J, reservation R WHERE J.journeyId=R.journeyId AND R.seatId!='0' AND R.emailLUser='$email' ORDER BY J.journeyDate";
            $result2 = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result2) == 0) {
                echo '<style>p{color:red;}</style><p>Warning: Any ticket find !</p>';
            }
            while ($row2 = mysqli_fetch_array($result2)) {
            $seatId2 = $row2['seatId'];
            //if reserve ticket date passed ticket cannot be cancelled
            $today = strtotime("today");
            $journeyDate = $row2['journeyDate'];
            $journeyDate = strtotime($journeyDate);

            if ($today > $journeyDate) {

                $ticketType = $row2['ticketType'];
                $reservationId = $row2['reservationId'];

                $pastTicket = "UPDATE reservation SET ticketType='PAST', seatId='0' WHERE reservationId=$reservationId";
                $connection = mysqli_query($conn, $pastTicket);
            }
            ?>
        </tr>
        <tr>
            <td><img src="../img/bus.png" width="50px" height="50px"></td>
            <td><?php
                $pnr = $row2['reservationId'];
                echo $row2['reservationId']; ?></td>
            <td><?php echo $row2['DeparturePlace']; ?></td>
            <td><?php echo $row2['DestinationPlace']; ?></td>
            <td><?php
                $originalDate = $row2['journeyDate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                echo $newDate ?></td>
            <td><?php echo $row2['journeyTime']; ?></td>
            <td><?php echo $row2['price']; ?></td>
            <td><?php echo $seatId2 ?></td>
            <td>
                <?php

                date_default_timezone_set("Europe/Istanbul");
                $journeyDate = $row2['journeyDate'];

                $start_date = strtotime("today");
                $end_date = strtotime("$journeyDate");
                $diff = ($end_date - $start_date);
                $day = ($diff) / 60 / 60 / 24;

                if ($day > 1) {
                    echo "<form action='reservedTicketPayment_RU.php' method='POST'><button type='submit' value=" . $row2['reservationId'] . " name=\"reservationId\"  style=\"background-color: deepskyblue; width: 70%; border-radius: 20px; font-weight: bolder; font-size: 14px;\">Buy Ticket</button></form>";

                } else {
                    $deletePastTicket = "UPDATE reservation SET isCancelled='1',ticketType='Cancelled',seatId='0' WHERE  reservationId='$pnr'";
                    $deleted = mysqli_query($conn, $deletePastTicket);
                    echo "<button type='submit' disabled style=\"background-color:darkgray; width: 70%; border-radius: 20px; font-weight: bolder; font-size: 14px;\">Buy Ticket</button>";
                }


                ?>
            </td>
            <td>
                <?php
                if ($row2['ticketType'] == 'Paid') {

                    $queryInsert = "INSERT INTO ticket(journeyId,name,surname,emailaddress,ticketType,isCancelled,PNR,seatId,gender) 
                                        SELECT journeyId,name,surname,emaillUser,ticketType,isCancelled,reservationId,seatId,gender FROM reservation WHERE ticketType='Paid'";
                    $queryInsertConn = mysqli_query($conn, $queryInsert);

                    if (!$queryInsertConn) {
                        echo "Error";
                    } else {
                        #echo "Insert";
                        $deleteSellingTicket = "DELETE FROM reservation WHERE ticketType='Paid'";
                        $deleteSellingTicketConn = mysqli_query($conn, $deleteSellingTicket);
                        if (!$deleteSellingTicketConn) {
                            #echo "Error";
                        } else {
                            #echo "Deleted";
                        }
                    }
                }
                echo "<button type='submit' style=\"background-color: crimson; width: 70%; border-radius: 20px; font-weight: bolder; font-size: 14px;\"><a href='reserveTicketCancel.php'>Cancel Ticket</a></button>";

                ?>
            </td>
            <?php
            }
            }
            }
            ?>
        </tr>

    </table>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>