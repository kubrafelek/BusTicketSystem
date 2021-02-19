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

$query = "SELECT * FROM users WHERE emailaddress='$email'";
if (isset($conn)) {
$result = mysqli_query($conn, $query);


if (!$result){
    #echo "Error query";
    echo '<script language="javascript">';
    echo "alert('Something connection problem occurs.')";
    echo '</script>';
    exit();
}else{

while ($row = mysqli_fetch_array($result)) {
$uName = $row['userName'];
$uSurname = $row['userSurname'];
$gender = $row['gender'];
$phone = $row['mobilePhone'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>REGISTER USER PROFILE</title>
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
        <a href="../registered/registerUserProfile.php"><?php echo $uName . "'s Profile"; ?></a>
        <a href="../logout.php">Logout</a>
    </div>

</div>

<div class="container" style="width:50%;">
    <h1>Personal Profile Information</h1>
    <hr class="hr_main">
    <form action="editProfileRegisterUser.php" method="POST">


        <label><b>Name: <?php echo " " . $uName ?> </b></label>
        <br>
        <br>
        <label><b>Surname: <?php echo " " . $uSurname ?></b></label>
        <br>
        <br>
        <label><b>Email: <?php echo " " . $email ?></b></label>
        <br>
        <br>
        <label><b>Gender: <?php
                if ($gender == 'F') {
                    echo " Female";
                } else {
                    echo " Male";
                }
                ?></b></label>
        <br>
        <br>
        <label><b>Phone Number: <?php echo " " . $phone ?></b></label>

        <?php
        /*Send sessions*/
        $_SESSION['uName'] = $row['userName'];
        $_SESSION['uSurname'] = $row['userSurname'];
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $row['mobilePhone'];
        }
        }
        }
        } ?><hr>
        <button type="submit" class="answer_officer_btn" style="width:20%; float:left; background-color:mediumslateblue" name="editProfile">Edit Profile</button>
    </form>
</div>
<div class="container" style="width:50%; margin-top:-27%; float:right">
    <h1>All Transactions</h1>
    <hr class="hr_main">
    <button style="font-weight:bold; background-color:firebrick" onclick="window.location.href='viewAllMyTickets_RU.php'" type="submit" class="ticket_transactions_btn">All My Tickets</button>
    <button style="font-weight:bold; background-color:firebrick" onclick="window.location.href='pastTickets_RU.php'" type="submit" class="ticket_transactions_btn">Date Past Tickets</button>
    <button style="font-weight:bold; background-color:firebrick" onclick="window.location.href='infoBox_RU.php'" type="submit" class="ticket_transactions_btn">Info Box</button>
    <button style="font-weight:bold; background-color:firebrick" onclick="window.location.href='campaigns_RU.php'" type="submit" class="ticket_transactions_btn">View Campaigns</button>
</div>
<br><br>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>