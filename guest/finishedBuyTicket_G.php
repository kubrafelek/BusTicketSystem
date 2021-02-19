<?php
session_start();
include("../dbconnect.php");

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
    <title>FINISHED BUY TICKET G</title>
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
    <h1>Buy Ticket Detail</h1>
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