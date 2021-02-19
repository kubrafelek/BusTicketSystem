<?php
session_start();
include("dbconnect.php");
if (isset($_SESSION['email'])) {
    echo '<script> 
        if(confirm("You are already logged in ! \n Do you want to continue?")) {
            window.location.href = "../BusTicketly/login.php"
         }</script>';
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>LOGIN PAGE</title>
</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Left-aligned links (default) -->
    <a href="base/homepage_G.php">Homepage</a>
    <a href="base/aboutUs_G.php">About Us</a>
    <a href="base/support_G.php">Support</a>


    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="login.php">Login</a>
        <a href="registration.php">Registration</a>
    </div>

</div>


<form action="#" style="border:3px solid #ccc" method="POST">
    <div class="container">
        <h1>Login Form</h1>
        <p>Please fill in this form to login with an account.</p>
        <hr>
        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="input" name="psw" required>

        <input type="checkbox" onclick="myFunction()">Show Password
        <br>
        <br>
        <script>
            function myFunction() {
                var x = document.getElementById("input");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <span style="margin-left: 60%">Forgot password?<a href="forgotPassword.php" style="color: dodgerblue"> Click Here !</a></span>
        <br>
        <br>
        <div class="cancel_signup">
            <button type="button" class="cancelbtn"><a href="registration.php">Registration</a></button>
            <button type="submit" class="signupbtn" name="login_user">Login</a></button>
        </div>
    </div>
</form>
</body>
</html>

<?php

if (isset($_POST['login_user'])) {

    $email = $_POST['email'];
    $psw = $_POST['psw'];

    if (empty($email) || empty($psw)) {
        echo '<script>
        if(confirm("Fill all blanks !")) {
        window.location.href = "../BusTicketly/login.php"
        }</script>';
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
        if(confirm("Invalid email address !")) {
        window.location.href = "../BusTicketly/login.php"
        }</script>';
        exit();
    } else {

        $query = "SELECT * FROM users WHERE emailaddress=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<script>
            if(confirm("Some connection troubles !")) {
            window.location.href = "../BusTicketly/login.php"
            }</script>';
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                if($row['userType'] == 'Admin') {
                    $_SESSION['email'] = $row['emailaddress'];
                    echo '<script>window.location.href = "../BusTicketly/admin/adminProfile.php"</script>';
                    exit();
                }

                if($row['userType'] == 'Officer') {
                    $_SESSION['email'] = $row['emailaddress'];
                    echo '<script>window.location.href = "../BusTicketly/officer/officerProfile.php"</script>';
                    exit();
                }

                $pwdCheck = password_verify($psw, $row['pwd']);
                if ($pwdCheck == false) {
                    echo '<script>
                    if(confirm("Invalid password !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
                    exit();

                } else if ($pwdCheck == true) {
                    $_SESSION['email'] = $row['emailaddress'];
                    header("Location: ../BusTicketly/base/homepage_RU.php");
                    exit();

                } else {
                    echo '<script>
                    if(confirm("Wrong user input !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
                    exit();
                }
            } else {
                echo '<script>
                if(confirm("No user match!")) {
                window.location.href = "../BusTicketly/login.php"
                }</script>';
                exit();
            }
        }
    }
}
?>


