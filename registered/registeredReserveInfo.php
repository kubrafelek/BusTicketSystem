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
$journeyId = $_SESSION['journeyId'];
$number = "";
if (isset($_POST['choose_seat_reserve'])) {
    $number = $_POST['number'];
    $_SESSION['number'] = $number;
    $journeyId = $_SESSION['journeyId'];

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <title>REGISTERED BUY INFO</title>
        <style>
            input[type=submit] {
                width: 40%;
                background-color: dodgerblue;
                color: snow;
                font-family: "Dubai Medium";
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 20px;
            }

            input[type=submit]:hover {
                background-color: dodgerblue;
            }

            input[type=text], input[type=email] {
                width: 30%;
                padding: 5px;
                margin: 0 0 0 0;
                display: inline-block;
                border: 3px solid #b7d7e8;
                background: #f1f1f1;
                float: left;
            }

            input[type=text]:focus, input[type=email]:focus {
                background-color: #ddd;
                outline: none;
            }

            label {
                float: left;
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
            <a href="registerUserProfile.php"><?php include "registeredUserName.php" ?></a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <form action="#" method="POST">
    <div class="container">
    <h1>Information For Reserve Ticket</h1>
    <hr>

    <?php
    $_SESSION['seats'] = $_POST['seats'];
    for ($i = 0; $i < $number; $i++) { ?>
        <div>
            <label><b>Name: </b></label>
            <input type="text" style="margin-left:35px" placeholder="Enter Name" name="name[]" required><br><br>

            <label><b>Surname: </b></label>
            <input type="text" style="margin-left:5px" placeholder="Enter Surname" name="surname[]"
                   required><br><br>

            <label><b>Email: </b></label>
            <input type="text" style="margin-left:35px" placeholder="Enter Email" name="email[]"
                   required><br><br>

            <label><b>Gender: &nbsp;</b></label>
            <label class="cont" for="male">Male
                <input type="checkbox" id="male" name="gender[]" value="M" checked>
                <span class="check"></span></label>

            <label class="cont" for="female"> &nbsp;&nbsp;Female
                <input type="checkbox" id="female" name="gender[]" value="F">
                <span class="check"></span></label><br>
        </div>
        <hr><br>
    <?php }
} ?>

    <div class="cancel_signup">
        <button type="button" onClick="window.location.href = '../base/homepage_RU.php'" class="cancelbtn"
                style="width: 10%; border-radius: 40px">Return
        </button>
        <button type="submit" class="addjourneybtn" name="regUserReserve">Next</button>
    </div>
    </div>
</form>

    <footer class="main_footer">
        <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
    </footer>

</body>
    </html>


<?php
$seats = "";
if (isset($_POST['regUserReserve'])) {
    $seats = $_SESSION['seats'];
    $journeyId = $_SESSION['journeyId'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $ticketType = "Reserved";
    $number = $_SESSION['number'];

    $arr2 = array();
    for ($k = 0; $k < $number; $k++) {
        $ticket = array($name[$k], $surname[$k], $email[$k], $gender[$k], $seats[$k]);
        $arr2[$k] = $ticket;
    }

    $arrayReservation = [];
    foreach ($arr2 as $key => $value) {

        $PNR = rand(10000000, 99999999);
        $regUserTicket = "INSERT INTO reservation(reservationId, journeyId, emaillUser,seatId, name, surname,  gender, ticketType)
                                    VALUES('$PNR','$journeyId','$value[2]',$value[4],'$value[0]','$value[1]','$value[3]','$ticketType');";
        if (isset($conn)) {

            $insertTicketTable = mysqli_query($conn, $regUserTicket);
            if (!$insertTicketTable) {
                echo "SQL error, check your code! ";
            }
        }
        $arrayReservation[$key] = $PNR;
    }

    $_SESSION['arrayPNR'] = $arrayReservation;
    header("Location: finishReserveSuccess.php");
    #echo header("Location: finishedReserveTicket_RU.php");
    exit();
}
?>