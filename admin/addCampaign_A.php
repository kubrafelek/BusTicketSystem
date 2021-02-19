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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>ADD JOURNEY</title>
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
<form method="POST">
    <div class="container">
        <h1>Add Campaign</h1>
        <hr class="hr_main">
        <label><b>Campaign Id</b></label>
        <input id="campaign_topic" type="text" placeholder="Campaign Topic" name="id_campaign">
        <br> <br>
        <label><b>Campaign Content</b></label>
        <textarea class="msg_content" id="text_classic" placeholder="Write Campaign..." name="content"
                  required></textarea>

        <button type="submit" class="addjourneybtn" name="add_campaign">Save</button>
    </div>
</form>
<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php

if (isset($_POST['add_campaign'])) {

    $id = $_POST['id_campaign'];
    $content = $_POST['content'];

    $addCampaign = "INSERT INTO campaign(campaignId, campaignContent) VALUES ('$id','$content')";
    if (isset($conn)) {
        $result = mysqli_query($conn, $addCampaign);

        if (!$result) {
            #echo "SQL error!";
            echo '<script> 
                     if(confirm("Campaign is not add !")) {
                               window.location.href = "adminProfile.php"
              }</script>';
            exit();
        } else {
            #echo "New campaign added, successfully.";

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
        <form style=" background-color: #87bdd8;
            margin: 5% auto 15% auto; 
            border: 1px solid #888;
            width: 50%; ">
            <div style=" padding: 60px; text-align: center;">
                <h1 style="color: blanchedalmond">New campaign added, successfully.</h1>
                <p>Do you want to continue ?</p>
		        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="adminProfile.php">OK</a></button>
            </div>
        </form>
    </div>';
            exit();
        }
    }

}
?>