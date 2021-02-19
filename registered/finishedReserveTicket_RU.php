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

if (isset($_SESSION)) {

$journeyId = $_SESSION['journeyId'];
$number = $_SESSION['number'];
$seats = $_SESSION['seats'];
$arrayPNR = $_SESSION['arrayPNR'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>FINISHED BUY TICKET RU</title>
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
    <h1>Reserve Ticket Detail</h1>
    <hr class="hr_main">

    <table id="seats" style="width: 85%">
        <tr style="color: darkred">

            <th>PNR</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>
            <th>SeatNo</th>
            <th>Ticket Action</th>

            <?php
            for ($k = 0; $k < $number; $k++){

            $query = "SELECT * FROM journey WHERE journeyId='$journeyId'";

            if (isset($conn)) {
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
        </tr>
        <tr>
            <td><?php echo $arrayPNR[$k]; ?></td>
            <td><?php echo $row['DeparturePlace']; ?></td>
            <td><?php echo $row['DestinationPlace']; ?></td>
            <td><?php
                $originalDate = $row['journeyDate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                echo $newDate  ?></td>
            <td><?php echo $row['journeyTime']; ?></td>
            <td><?php echo $row['price']; ?> TL</td>
            <td><?php echo $seats[$k]; ?></td>
            <td>
                <?php echo "<button type='submit'  style=\"background-color: crimson; width: 80%; border-radius: 20px\" onclick=\"window.location.href='../guest/ticketCanceledBy_G.php'\">Cancel Ticket</button>"; ?>
            </td>
        </tr>

        <?php
        }
        }
        }
        ?>
        </tr>
    </table><?php } ?>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<script>
    var modal = document.getElementById('id01');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>