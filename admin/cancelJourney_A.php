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

        <title>CANCEL JOURNEY</title>
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

    <div class="container">
        <h1>Cancel Journey</h1>
        <hr class="hr_main">
        <form action="#" method="POST">
            <input style="width: 30%" type="text" placeholder="Enter Journey ID:" name="journeyId">
            <button type="submit" class="canceljourney_tiketbtn" name="cancelJourney">Cancel Journey</button>
        </form>
    </div>

    <footer class="main_footer">
        <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
    </footer>

    </body>
    </html>

<?php

$conn = mysqli_connect("localhost", "root", "", "busdb");
if (isset($_POST['cancelJourney'])) {
    $journeyId = $_POST['journeyId'];

    $deleteJourney = "UPDATE journey SET isCancelled='1' WHERE journeyId='$journeyId';";

    $result = mysqli_query($conn, $deleteJourney);
    if (!$result) {
        echo '<script>
                  if(confirm("Journey can not cancelled !")) {
                            window.location.href = "adminProfile.php"
           }</script>';
        exit();
    } else {

        $findTicketCustomers = "SELECT * FROM ticket WHERE journeyId='$journeyId';";
        $findTicketCustomersConn = mysqli_query($conn, $findTicketCustomers);

        $findReserveCustomers = "SELECT * FROM reservation WHERE journeyId='$journeyId';";
        $findReserveCustomersConn = mysqli_query($conn, $findReserveCustomers);

        $allEmails = "";
        while ($row = mysqli_fetch_assoc($findTicketCustomersConn)) {
            $mailTo = $row['emailaddress'];
            $pnr = $row['PNR'];
            #echo " " . $mailTo;

            $messageID = rand(1000000, 9999999);
            $mailFrom = "kbr.flk@hotmail.com";
            $title_msg = "Journey Cancelled";
            $message = "Your journey cancelled.";

            $feedbackUser = "INSERT INTO message(MessageID, Content,FromEmailAdd,ToEmailAdd,title) VALUES ('$messageID','$message','$mailFrom','$mailTo','$title_msg');";
            $result = mysqli_query($conn, $feedbackUser);

            $cancelTicket = "UPDATE ticket SET isCancelled='1', ticketType='Cancelled',seatId='0' WHERE journeyId='$journeyId' AND PNR='$pnr'";
            $cancelAll = mysqli_query($conn, $cancelTicket);
        }

        while ($row2 = mysqli_fetch_assoc($findReserveCustomersConn)) {
            $email = $row2['emaillUser'];
            $pnr = $row2['reservationId'];
            #echo " " . $email;

            $messageID = rand(1000000, 9999999);
            $mailFrom = "kbr.flk@hotmail.com";
            $title_msg = "Journey Cancelled";
            $message = "Your journey cancelled.";
            $feedbackUser = "INSERT INTO message(MessageID, Content,FromEmailAdd,ToEmailAdd,title) VALUES ('$messageID','$message','$mailFrom','$email','$title_msg');";
            $result = mysqli_query($conn, $feedbackUser);

            $cancelTicket = "UPDATE reservation SET isCancelled='1', ticketType='Cancelled',seatId='0' WHERE journeyId='$journeyId' AND reservationId='$pnr'";
            $cancelAll = mysqli_query($conn, $cancelTicket);
        }
        #echo "Journey Canceled";
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
                <h1 style="color: blanchedalmond">Journey cancelled, successfully.</h1>
                <p>Do you want to continue ?</p>
		        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="adminProfile.php">OK</a></button>
            </div>
        </form>
    </div>';
        exit();
    }
}
?>