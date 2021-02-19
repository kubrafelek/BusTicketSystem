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
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>RESET PASSWORD RU</title>
</head>

<body>
<form action="#" style=" border:3px solid #ccc" method="POST">
    <div class="container">
        <h1>Reset Password</h1>
        <hr>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <div class="cancel_signup">
            <button type="button" class="cancelbtn" style="width: 20%"><a href="../registered/registerUserProfile.php">Cancel</a></button>
            <button type="submit" class="addjourneybtn" name="reset_pass">Confirm</a></button>
        </div>
    </div>
</form>
</body>
</html>

<?php

if (isset($_POST["reset_pass"])) {
    $userEmail = $_SESSION['email'];
    $psw = $_POST['psw'];
    $psw_repeat = $_POST['psw-repeat'];

    if ($psw != $psw_repeat) {
        #echo "Passwords not match";
        echo '<script> 
              if(confirm("Passwords do not match !")) {
               window.location.href = "../registered/registerUserProfile.php"
              }</script>';
        exit();
    }

    $sql = "SELECT * FROM users WHERE emailaddress=?";
    if (isset($conn)) {
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            #echo "Error in the sql check !";
            echo '<script> 
                          if(confirm("Something connection problem occur !")) {
                                window.location.href = "../registered/registerUserProfile.php"
                      }</script>';
            exit();
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdHash = password_hash($psw, PASSWORD_DEFAULT);
                $_SESSION['email'] = $row['emailaddress'];
                $_SESSION['psw'] = $row['pwd'];
                $reset_psw = "UPDATE users SET pwd='$pwdHash' WHERE emailaddress='$userEmail'";
                $output = mysqli_query($conn, $reset_psw);
                echo '<script> 
                          if(confirm("Your password changed, successfully.")) {
                                window.location.href = "../registered/registerUserProfile.php"
                      }</script>';
                exit();
            } else {
                echo '<script> 
                          if(confirm("Your password was not change!")) {
                                window.location.href = "../registered/registerUserProfile.php"
                      }</script>';
                exit();

            }

        }
    }
}
?>

