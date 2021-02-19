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
$admin = $_SESSION['email'];
$msg = "SELECT * FROM message WHERE ToEmailAdd='$admin' ORDER BY Date DESC";
if (isset($conn)) {
$result = mysqli_query($conn, $msg);

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

    <title>INFO BOX ADMIN</title>
    <style>
        h3 {
            color: cornflowerblue;
        }

        h8 {
            color: #f44336;
        }


    </style>

</head>
<body>
<!-- Navbar -->
<div class="navbar">

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="adminProfile.php">Admin Profile</a>
        <a href="../logout.php">Logout</a>
    </div>

</div>

<div class="container">
    <h1>All Messages</h1>
    <hr>
    <h3>From Officer</h3>
    <form method="POST">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <p>Title: <?php echo $row['title'] ?> (<?php echo $row['Date'] ?>)</p>
            <h8> "<?php echo $row['Content'] ?>"</h8>
            <hr>
            <br>
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