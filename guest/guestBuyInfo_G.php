<?php
session_start();
include("../dbconnect.php");
/*if (isset($_POST['seats'])) {
    $seats = $_POST['seats'];
    $_SESSION['seats'] = $seats;
}*/

$journeyId = $_SESSION['journeyId'];
$number = "";

if (isset($_POST['choose_seat'])) {
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
    <title>GUEST INFORMATION</title>
    <style>
        /* Add padding and center-align text to the container */
        .container-contactUs {
            padding: 60px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal_background_contactUs {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            padding-top: 50px;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content/Box */
        .modal-content-contactUs {
            background-color: #87bdd8;
            margin: 5% auto 15% auto;
            border: 1px solid #888;
            width: 50%;
        }

        /* The Modal Close Button (x) */
        .close-contactUs {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
        }

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
    <a href="../base/homepage_G.php">Homepage</a>
    <a href="../base/aboutUs_G.php">About Us</a>

    <a onclick="document.getElementById('id01').style.display='block'">Contact Us</a>
    <div id="id01" class="modal_background_contactUs">
        <span onclick="document.getElementById('id01').style.display='none'" class="close-contactUs"
              title="Close Modal">×</span>
        <form class="modal-content-contactUs">
            <div class="container-contactUs">
                <h1 style="color: blanchedalmond">You cannot use contact us</h1>
                <p> You must be registered into website</p>
            </div>
        </form>
    </div>

    <a href="../base/support_G.php">Support</a>

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <a href="../login.php">Login</a>
        <a href="../registration.php">Registration</a>
    </div>

</div>


<form action="#" method="POST">
    <div class="container">
        <h1>Guest Information For Buy Ticket</h1>
        <hr>

        <?php
        /* foreach ($_POST['seats'] as $v) {
             echo ' seat ' . $v . ' <br/>';
         }*/

        $_SESSION['seats'] = $_POST['seats'];
        for ($i = 0; $i < $number; $i++) { ?>
            <div>
                <label><b>Name: </b></label>
                <input type="text" style="margin-left:35px" placeholder="Enter Name" name="name[]" required><br><br>

                <label><b>Surname: </b></label>
                <input type="text" style="margin-left:5px" placeholder="Enter Surname" name="surname[]"
                       required><br><br>

                <label><b>Email: </b></label>
                <input type="text" style="margin-left:35px" placeholder="Enter Email" name="email[]" required><br><br>

                <label><b>Gender: &nbsp;</b></label>
                <label class="cont" for="male">Male
                    <input type="checkbox" id="male" name="gender[]" value="M" checked>
                    <span class="check"></span> &nbsp;</label>

                <label class="cont" for="female">Female
                    <input type="checkbox" id="female" name="gender[]" value="F">
                    <span class="check"></span></label><br>
            </div>
            <hr><br>
        <?php }
        } ?>

        <div class="cancel_signup">
            <button type="button" class="cancelbtn" style="width: 10%; border-radius: 40px"><a
                        href="../base/homepage_G.php">Return</a></button>
            <button type="submit" class="addjourneybtn" name="guest_info">Next</button>
        </div>
    </div>
</form>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<?php

if (isset($_POST['guest_info'])) {
    $seats = $_SESSION['seats'];
    $journeyId = $_SESSION['journeyId'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $ticketType = "GuestBuy";
    
    $number = $_SESSION['number'];

    $arr = array();
    for ($k = 0; $k < $number; $k++) {
        $ticket = array($name[$k], $surname[$k], $email[$k], $gender[$k], $seats[$k]);
        $arr[$k] = $ticket;
    }

    $arrayPNR = [];
    foreach ($arr as $key => $value) {

        $PNR = rand(10000000, 99999999);
        $regUserTicket = "INSERT INTO ticket(journeyId, name, surname, emailaddress, ticketType, PNR,seatId, gender)
                                    VALUES('$journeyId','$value[0]','$value[1]','$value[2]','$ticketType','$PNR',$value[4],'$value[3]') ";
        if (isset($conn)) {
            $insertTicketTable = mysqli_query($conn, $regUserTicket);
            if (!$insertTicketTable) {
                echo "SQL error, check your code! ";
            }
        }
        $arrayPNR[$key] = $PNR;
    }
    $_SESSION['arrayPNR'] = $arrayPNR;
    echo header("Location: ticketPayment_G.php");
    exit();
}
?>

<script>
    var modal = document.getElementById('id01');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
