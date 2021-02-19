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

if (isset($_POST['journeyId'])) {
$journeyId = $_POST['journeyId'];

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
    <h1>List Passengers</h1>
    <hr class="hr_main">

    <table id="seats" style="width: 60%">
        <tr style="color: mediumvioletred">
            <th>PNR</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email Address</th>
            <th>Gender</th>
            <th>SeatNo</th>
            <th>Ticket Type</th>

            <?php
            $query = "SELECT * FROM ticket WHERE journeyId='$journeyId'";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)){
            if ($row['isCancelled'] == '0'){
            ?>
        </tr>
        <tr>
            <td><?php echo $row['PNR']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['emailaddress']; ?></td>
            <td><?php
                if($row['gender'] == 'F'){
                    echo "Female";
                }else{
                    echo "Male";
                }
                ?></td>
            <td><?php echo $row['seatId']; ?></td>
            <td><?php echo $row['ticketType']; ?></td>
        </tr>
        <?php
        }
        }
        }
        ?>
        </tr>
    </table>
    <br>
    <table id="seats" style="width: 60%">
        <tr style="color: mediumvioletred">
            <th>PNR</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email Address</th>
            <th>Gender</th>
            <th>SeatNo</th>
            <th>Ticket Type</th>

            <?php
            $query = "SELECT * FROM reservation WHERE journeyId='$journeyId'";
            if (isset($conn)) {
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)){

            if ($row['isCancelled'] == '0'){
            ?>
        </tr>
        <tr>
            <td><?php echo $row['reservationId']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['emaillUser']; ?></td>
            <td><?php
                if($row['gender'] == 'F'){
                    echo "Female";
                }else{
                    echo "Male";
                }
                ?></td>
            <td><?php echo $row['seatId']; ?></td>
            <td><?php echo $row['ticketType']; ?></td>
        </tr>
        <?php
        }
        }
        }
        }
        ?>
        </tr>
    </table>

    <button type="button" onClick="window.location.href = 'viewJourney_A.php'" class="answer_officer_btn" style="width:10%; background-color:darkolivegreen">Return</button>
</div>


<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>