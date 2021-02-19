<?php
session_start();
include("../dbconnect.php");
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>FINISHED BUY TICKET RU</title>

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

<?php
if (isset($_POST['pnr'])) {
$pnr = $_POST['pnr'];

$query1 = "SELECT * FROM ticket WHERE PNR='$pnr'";

if (isset($conn)) {
$result = mysqli_query($conn, $query1);

if (!$result) {
    echo '<script>
            if(confirm("Some connection troubles !")) {
            window.location.href = "viewTicketDetail_G.php"
            }</script>';
    exit();
} else {
while ($row = mysqli_fetch_array($result)) {
$journeyId = $row['journeyId'];
$seatId = $row['seatId'];

if (($row['isCancelled'] == '1') && ($row['seatId'] == '0')) {
    echo '<script>
                    if(confirm("Ticket is cancelled before !")) {
                    window.location.href = "../base/homepage_G.php"
                    }</script>';
    exit();
}


$query2 = "SELECT * FROM journey WHERE journeyId='$journeyId'";
$result2 = mysqli_query($conn, $query2);

if (!$result2) {
    echo '<script>
            if(confirm("Some connection troubles !")) {
            window.location.href = "viewTicketDetail_G.php"
            }</script>';
    exit();
} else {
while ($row = mysqli_fetch_array($result2)) {

$from = $row['DeparturePlace'];
$to = $row['DestinationPlace'];
$date = $row['journeyDate'];
$time = $row['journeyTime'];
$price = $row['price'];
?>
<div class="container">
    <h1>View Ticket Detail</h1>
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
            <th>Cancel Ticket Action</th>
        <tr>
            <td> <?php echo $pnr; ?></td>
            <td> <?php echo $from; ?></td>
            <td> <?php echo $to; ?></td>
            <td> <?php echo $date; ?></td>
            <td> <?php echo $time; ?></td>
            <td> <?php echo $price; ?></td>
            <td> <?php echo $seatId; ?></td>
            <td>
                <?php echo "<button type='submit' style=\"background-color: crimson; width: 80%; font-size: 18px; border-radius: 20px\"><a href='ticketCanceledBy_G.php'>Cancel Ticket</a></button>"; ?>
            </td>
        </tr>
        <?php
        }
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
<br>
<br>

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