<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>SUPPORT G</title>


    <style>
        /* Add padding and center-align text to the container */
        .container-contactUs {
            padding: 60px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal_background_contactUs {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            padding-top: 50px;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content-contactUs {
            background-color: #87bdd8;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 50%; /* Could be more or less, depending on screen size */
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
        <span onclick="document.getElementById('id01').style.display='none'" class="close-contactUs" title="Close Modal">×</span>
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
        <img src="../img/bus_icon.png" style="float: left; margin-top: 8px">
        <a href="../login.php">Login</a>
        <a href="../registration.php">Registration</a>
    </div>

</div>


<div class="container">
    <h2 style="text-align:center">FREQUENTLY ASKED QUESTIONS</h2>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I reserve ticket?</h8>
        <p> If you want to make a ticket reservation, you must first be a registered user in our system.
            Then you can list the journeys by logging into the system. In this way, you can complete your
            transaction by creating a journey reservation at the appropriate position.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I buy the ticket with the special price?</h8>
        <p>If you want to take advantage of the promotional ticket prices, you must be a registered user in our system.
            If you are registered in the system, you can view the tickets with campaign and make the purchase.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">Can I cancel the ticket I have bought?</h8>
        <p>Yes, you can cancel your purchased ticket.
            If you are a registered user in the system, you can cancel a tickets by viewing the view all my ticket details on your profile page.
            If you are an unregistered user, you can cancel the ticket and also view ticket details by entering  in the "Enter pnr number" section on the homepage.</p>
    </div>
    <br>
    <div class="column_support">
        <h8 style="font-weight: normal; font-family:Candara">How can I contact with Officer?</h8>
        <p>If you are a registered user in the system, you can consult Officera by clicking the contact us page.
            However, if you are a guest user, you cannot contact with Officer.
            For this reason, we expect you to be registered in the system.</p>
    </div>
</div>

<footer class="main_footer">
    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
</footer>

</body>
</html>

<script>
    var modal = document.getElementById('id01');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>