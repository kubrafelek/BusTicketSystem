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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>CAMPAIGNS LIST RU</title>
    <style>

        h3, p {
            font-family: 'Dubai Medium';
        }
    </style>
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
    <h1>All Campaigns</h1>
    <hr class="hr_main">
    <form action="listOfCampaignsTickets.php" method="POST">

        <?php
        /*Listed all campaigns system*/
        $allCampaigns = "SELECT * FROM campaign";
        if (isset($conn)) {
            $sqlRun = mysqli_query($conn, $allCampaigns);

            if (!$sqlRun) {
                #echo "error";
                echo '<script language="javascript">';
                echo "alert('Something connection problem occurs.')";
                echo '</script>';
                exit();
            } else {
                while ($row = mysqli_fetch_array($sqlRun)) {
                    $id = $row['campaignId'];
                    $content = $row['campaignContent'];
                    ?>
                    <h3 style="color: #f44336">Campaign: <?php echo " " . $id ?></h3>
                    <p style="color: forestgreen">Description: <?php echo " ' " . $content . " ' " ?></p>
                   <?php echo '<form action="listOfCampaignsTickets.php" method="POST">
                        <button class="adminSignbtn" style="width: 10%; margin-left: 25%; margin-top: -50px" value='.$row["campaignId"].'  name="campaignId">Select</button>
                    </form>'
                    ?>
                    <hr>
                    <?php
                }
            }
        }
        ?>

    </form>
</div>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>
