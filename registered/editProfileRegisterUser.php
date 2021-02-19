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

$uName = "";
$uSurname = "";
$gender = "";
$phone = "";
$email = $_SESSION['email'];

$query = "SELECT * FROM users WHERE emailaddress='$email'";

if (isset($conn)) {
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Error check query";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $uName = $row['userName'];
        $uSurname = $row['userSurname'];
        $gender = $row['gender'];
        if ($gender = 'F') {
            $gender = 'Female';
        } else {
            $gender = 'Male';
        }
        $email = $row['emailaddress'];
        $phone = $row['mobilePhone'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>REGISTER EDIT PROFILE</title>
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
        <a href="../registered/registerUserProfile.php"><?php include'registeredUserName.php'; ?></a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<form action="#" method="POST">
    <div class="container">
        <h1>Personal & Privacy Settings</h1>
        <hr class="hr_main">
        <label><b>Name</b></label>
        <input type="text" placeholder="<?php echo " " . $uName ?>" name="name" >

        <label><b>Surname</b></label>
        <input type="text" placeholder="<?php echo "" . $uSurname ?>" name="surname">

        <label><b>Gender</b></label>
        <input type="text" placeholder="<?php echo "" . $gender ?>" name="gender" disabled>

        <label><b>Email</b></label>
        <input type="text" placeholder="<?php echo "" . $email ?>" name="email" disabled>

        <label><b>Phone Number</b></label>
        <input type="text" placeholder="<?php echo "" . $phone ?>" name="phone">

        <label><b>Password</b></label>
        <input type="password" placeholder="<?php echo "**********" ?>" name="psw">

        <label><b>Repeat Password</b></label>
        <input type="password" placeholder="<?php echo "**********" ?>" name="psw-repeat">

        <button type="submit" class="cancelbtn" style="width: 20%"><a href="resetPassword.php">Reset Password</a>
        </button>
        <button type="submit" class="addjourneybtn" name="saved">Save</button>
    </div>
</form>

</body>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

<?php
if (isset($_POST['saved'])) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_SESSION['email'];

    if (!empty($phone)) {
        $reset = "UPDATE users SET mobilePhone='$phone' WHERE emailaddress='$email'";
        $result = mysqli_query($conn, $reset);
        if (!$result) {
            echo '<script language="javascript">';
            echo "alert('Your phone number was not change !')";
            echo '</script>';
            exit();
        } else {
            echo '<script> 
            if(confirm("Your phone number changed, successfully.\nDo you want to continue?")) {
                window.location.href = "registerUserProfile.php"
            }</script>';
            exit();
        }
    }


    if (!empty($name) && !empty($surname)) {
        $reset = "UPDATE users SET userName='$name', userSurname='$surname' WHERE emailaddress='$email'";
        $result = mysqli_query($conn, $reset);
        if (!$result) {
            echo '<script language="javascript">';
            echo "alert('Your name and surname was not change !')";
            echo '</script>';
            exit();
        } else {
            echo '<script> 
            if(confirm("Your name and surname changed, successfully.\nDo you want to continue?")) {
                window.location.href = "registerUserProfile.php"
            }</script>';
            exit();
        }
    } else {
        echo '<script language="javascript">';
        echo "alert('Your name and surname was not change !')";
        echo '</script>';
        exit();
    }
}
}
?>
