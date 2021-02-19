<?php
session_start();
include("../dbconnect.php");
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in !";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    include("loginAdmin.php");
    exit();
}

if (isset($_SESSION)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>VIEW JOURNEY</title>
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


<div class="container">
    <h1>View Journey</h1>
    <hr class="hr_main">

    <table id="seats" style="width: 90%">
        <tr style="color: green">
            <th>Journey Id</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>Capacity</th>
            <th>Edit Journey </th>
            <th>Cancel Journey </th>
            <th>Details Journey</th>

            <!-- Burası Biletlerin listelenmeye basladıgı yer -->
            <?php
            date_default_timezone_set("Europe/Istanbul");

            $query = "SELECT * FROM journey ORDER BY journeyDate";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)){
            $today = strtotime("today");
            $journeyDate = $row['journeyDate'];
            $journeyDate = strtotime($journeyDate);
            #Today and future journeys list
            if ($today <= $journeyDate && ($row['isCancelled'] == '0')){
            ?>
        </tr>
        <tr>
            <td><?php
                $journeyId = $row['journeyId'];
                echo $row['journeyId']; ?></td>
            <td><?php echo $row['DeparturePlace']; ?></td>
            <td><?php echo $row['DestinationPlace']; ?></td>
            <td>

                <?php
                $originalDate = $row['journeyDate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                echo $newDate ?></td>
            <td><?php echo $row['journeyTime']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php

                $countTicket = "SELECT COUNT(*) AS totalTicket FROM ticket WHERE journeyId='$journeyId' AND !isCancelled='1'";
                $countConnTicket = mysqli_query($conn, $countTicket);

                $countReserve = "SELECT COUNT(*) AS totalReserve FROM reservation WHERE journeyId='$journeyId' AND !isCancelled='1'";
                $countConnReserve = mysqli_query($conn, $countReserve);

                if (!$countConnTicket && !$countConnReserve) {
                    echo "Error";
                } else {
                    $countTicket = mysqli_fetch_array($countConnTicket);
                    $countReserve = mysqli_fetch_array($countConnReserve);
                    echo $countTicket['totalTicket'] + $countReserve['totalReserve'];
                }
                echo " / 24"; ?></td>


            <td>
                <?php echo "<form action='editJourney_A.php' method='POST'><button style='font-size: 16px; background-color: deepskyblue; width: 70%; border-radius: 20px'
                                value=" . $row["journeyId"] . "  name='journeyId'>Edit</button></form>"
                ?>
            </td>

            <td>
                <button onclick="window.location.href='cancelJourney_A.php'" style="font-size: 16px; background-color: crimson; width: 70%; border-radius: 20px"
                        name="cancel">Cancel</button>
            </td>

            <td>
               <?php echo "<form action='detailsJourney_A.php' method='POST'><button  value=" . $row["journeyId"] . "  name='journeyId' style='font-size: 16px; background-color: forestgreen; width: 70%; border-radius: 20px '>Details</button></form>"
            ?>
            </td>
        </tr>
        <?php
        }
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