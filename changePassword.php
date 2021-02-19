<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="main.css">

    <title>CHANGE PASSWORD RU</title>
</head>
<br><br><br>
<body>
<form action="#" style="border:3px solid #ccc" method="POST">
    <div class="container">
        <h1>Change Password</h1>
        <hr>

        <label><b>Enter Code:</b></label>
        <input type="text" placeholder="Enter Code" name="code" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <div class="cancel_signup">
            <button type="button" class="cancelbtn" style="width: 20%"><a href="login.php">Cancel</a></button>
            <button type="submit" class="addjourneybtn" name="reset_pass">Apply</a></button>
        </div>
    </div>
</form>
</body>
</html>

<?php

if (isset($_POST["reset_pass"])) {

    $code = $_POST['code'];
    $psw = $_POST['psw'];
    $psw_repeat = $_POST['psw-repeat'];

    if ($psw != $psw_repeat) {
        echo '<script>
                    if(confirm("Passwords do not match !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
        exit();
    }

    $sql = "SELECT * FROM users WHERE code=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<script>
                    if(confirm("Some connection problem occurs !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $pwdHash = password_hash($psw, PASSWORD_DEFAULT);
            $email = $row['emailaddress'];
            //$_SESSION['psw'] = $row['pwd'];
            $reset_psw = "UPDATE users SET pwd='$pwdHash' WHERE code='$code'";
            $output = mysqli_query($conn, $reset_psw);

            //delete code on database
            $deleteCode = "UPDATE users SET code='0' WHERE emailaddress='$email'";
            $deleteConn = mysqli_query($conn, $deleteCode);

            echo '<script>
                    if(confirm("Your password changed, successfully !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
            exit();
        } else {
            echo '<script>
                    if(confirm("Some problems occurs !")) {
                    window.location.href = "../BusTicketly/login.php"
                    }</script>';
            exit();
        }



    }
}

?>
