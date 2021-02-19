<?php
session_start();
include("../dbconnect.php");
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    include("loginOfficer.php");
    exit();
}

$all_feedbacks = "SELECT * FROM comments ORDER BY DateOfSend DESC ";
if (isset($conn)) {
$result = mysqli_query($conn, $all_feedbacks);

if (!$result) {
    echo "Error, check your code !!!";
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>ALL FEEDBACKS FROM USERS</title>
    <style>

        p {
            color: #f44336;
        }

        h4 {
            color: cornflowerblue;
        }

    </style>
</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="officerProfile.php">Officer Profile</a>
        <a href="../logout.php">Logout</a>
    </div>

</div>

<div class="container">
    <h1>All Feedbacks From Users</h1>
    <hr class="hr_main">

    <div class="box_infobox">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <h4>Registered User: <?php echo $row['email']; ?> - <?php echo $row['DateOfSend']; ?> </h4>
            <h3><?php echo $row['subject']; ?></h3>
            <p>" <?php echo $row['message']; ?> "
                <?php echo "<form action='feedbacksToRU_O.php' method='POST'><button type=\"submit\" class=\"answer_officer_btn\" value=". $row['email'] . " name=\"email\">Answer</button></form>";?>
            </p>
            <br><br>
            <hr>
            <?php
        }
        }
        }
        ?>
    </div>
</div>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

