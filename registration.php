<?php
error_reporting(0);
session_start();
include("dbconnect.php");
if (isset($_SESSION['email'])) {
    echo '<script> 
        if(confirm("You are already logged in ! \n Do you want to continue?")) {
            window.location.href = "../BusTicketly/base/homepage_RU.php"
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

    <title>REGISTRATION</title>

    <style>
        /* The container */
        .cont {
            display: inline-flex;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;

        }

        /* Hide the browser's default radio button */
        .cont input {
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .check {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .cont:hover input ~ .check {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .cont input:checked ~ .check {
            background-color: #2196F3;
        }

        input[type=tel]{
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: 3px solid #b7d7e8;
            background: #f1f1f1;
        }

        input[type=tel]:focus{
            background-color: #ddd;
            outline: none;
        }

    </style>

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

<form action="#" method="POST" style="border:3px solid #ccc">
    <div class="container">
        <h1>Registration</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label><b>Surname</b></label>
        <input type="text" placeholder="Enter Surname" name="surname" required>

        <label><b>Phone Number</b></label>
        <input type="tel" id="phone" name="phone" placeholder="111-222-3344" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><br>

        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label><b>Password</b></label>
        <input type="password" id="input1" placeholder="Enter Password" name="psw" required>

        <label><b>Repeat Password</b></label>
        <input type="password" id="input2" placeholder="Repeat Password" name="psw-repeat" required>

        <input type="checkbox" onclick="myFunction()">Show Password
        <br>
        <script>
            function myFunction() {
                if ((document.getElementById("input1").type === "password") && (document.getElementById("input2").type === "password")) {
                    document.getElementById("input1").type = "text";
                    document.getElementById("input2").type = "text";
                } else {
                    document.getElementById("input1").type = "password";
                    document.getElementById("input2").type = "password";
                }
            }
        </script>
<br>
        <label><b>Gender:</b></label>&nbsp;&nbsp;&nbsp;

        <label class="cont" for="male">Male
            <input type="radio" id="male" name="gender" value="M" checked>
            <span class="check"></span></label>

        <label class="cont" for="female">Female
            <input type="radio" id="female" name="gender" value="F">
            <span class="check"></span></label><br>

        <p>By creating an account you agree to our <a style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="cancel_signup">
            <button type="button" class="cancelbtn"><a href="base/homepage_G.php">Cancel</a></button>
            <button type="submit" class="signupbtn" name="signupbtn">Register Now</a></button>
        </div>
    </div>
</form>
</body>
</html>

<?php

if (isset($_POST['signupbtn'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    $psw_repeat = $_POST['psw-repeat'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
        if(confirm("Invalid email address !")) {
        window.location.href = "../BusTicketly/registration.php"
        }</script>';
        exit();
    } else if ($psw !== $psw_repeat) {
        echo '<script>
        if(confirm("Passwords do not match !")) {
        window.location.href = "../BusTicketly/registration.php"
        }</script>';
        exit();

    } else {
        $registration = "SELECT emailaddress FROM users WHERE emailaddress=?";
        if (isset($conn)) {
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $registration)) {
                echo '<script>
                if(confirm("Some connection troubles !")) {
                window.location.href = "../BusTicketly/registration.php"
                }</script>';
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt); //execute into database
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    echo '<script>
                    if(confirm("User already taken !")) {
                    window.location.href = "../BusTicketly/registration.php"
                    }</script>';
                    exit();
                } else {
                    $registration = "INSERT INTO users(userName,userSurname,gender,emailaddress,mobilePhone, pwd,userType) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $registration)) {
                        echo '<script>
                        if(confirm("Some connection troubles by registering !")) {
                        window.location.href = "../BusTicketly/registration.php"
                        }</script>';
                        exit();
                    } else {
                        $password_hash = password_hash($psw, PASSWORD_DEFAULT);
                        $userType = "registered";
                        mysqli_stmt_bind_param($stmt, "sssssss", $name, $surname, $gender, $email, $phone, $password_hash, $userType);
                        mysqli_stmt_execute($stmt);

                        echo '    <div id="id01" style=" 
                                    position: fixed; 
                                    z-index: 1;
                                    left: 0;
                                    top: 0;
                                    width: 100%; 
                                    height: 100%; 
                                    overflow: auto; 
                                    padding-top: 50px;
                                    background-color: rgb(0, 0, 0); 
                                    background-color: rgba(0, 0, 0, 0.4); "> 
                                <form style=" background-color: cornflowerblue;
                                    margin: 5% auto 15% auto; 
                                    border: 1px solid #888;
                                    width: 50%; ">
                                    <div style=" padding: 60px; text-align: center;">
                                        <h1 style="color: blanchedalmond">Registered completed, successfully.</h1>
                                        <p>Click Login Button</p>
                                        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="login.php">LOGIN</a></button>
                                    </div>
                                </form>
                            </div>';
                        exit();
                    }
                }
            }
        }
    }
}
?>

