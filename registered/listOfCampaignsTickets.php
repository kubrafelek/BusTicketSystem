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

if (isset($_POST['campaignId'])) {
$campaignId = $_POST['campaignId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>LIST OF CAMPAIGN TICKETS RU</title>
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
        <a href="registerUserProfile.php"><?php include "registeredUserName.php"?></a>
        <a href="../logout.php">Logout</a>
    </div>
</div>
<div class="container">
    <h1>All Campaign Journeys</h1>
    <hr class="hr_main">
    <table id="seats" style="width: 85%">
        <tr style="color: darkred">
            <th>Bus</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>Buy Ticket Action</th>

            <?php
            $query = "SELECT * FROM journey WHERE campaignId='$campaignId'";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                echo '<style>p{color:red;}</style><p>Warning: Any ticket find !</p>';
            }

            while ($row = mysqli_fetch_array($result)) {

            $journeyDate = $row['journeyDate'];
            date_default_timezone_set("Europe/Istanbul");
            $today = strtotime("today");
            $journeyDate = strtotime($journeyDate);

            $price = $row['price'];
            if ($today < $journeyDate) {
            ?>
        <tr>
            <td><img src="../img/bus.png" width="50px" height="50px"></td>
            <td><?php echo $row['DeparturePlace']; ?></td>
            <td><?php echo $row['DestinationPlace']; ?></td>
            <td><?php
                $originalDate = $row['journeyDate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                echo $newDate  ?></td>
            <td><?php echo $row['journeyTime']; ?></td>
            <td><?php echo $price ?></td>
            <td>
                <?php
                if ($row['isCancelled'] == '1') {
                    echo "<button type='submit' style=\"background-color: darkgray; width: 70%; color: black; font-weight: bolder; border-radius: 20px; font-size: 14px;\" disabled>Past Journey</button>";
                }else{
                    echo "<form action='chooseSeatCampaignTicket.php' method='POST'><button type='submit' value =" . $row['journeyId'] . " name=\"journeyId\" style='background-color: darkgreen; width: 70%; border-radius: 20px'>Buy Ticket</button></form>"; ?>
            </td>
        </tr>
        <?php
        }
        }
        }
        }
        }
        ?>
        </tr>
    </table>
</div>

<br>
<br>
<button type="button" onClick="window.location.href = 'campaigns_RU.php'" class="answer_officer_btn" style="width:10%; float:left; margin-left:5%; background-color:royalblue">Return</button>

<br>
<br>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>