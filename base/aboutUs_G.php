<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>ABOUT US G</title>

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
    <a href="homepage_G.php">Homepage</a>
    <a href="aboutUs_G.php">About Us</a>
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
    <a href="support_G.php">Support</a>

    <!-- Right-aligned links -->
    <div class="navbar-right">
        <img src="../img/bus_icon.png" style="float: left; margin-top: 8px">
        <a href="../login.php">Login</a>
        <a href="../registration.php">Registration</a>
    </div>

</div>

<div class="container">
    <h1>Bus Ticketly</h1>
    <hr class="hr_main">
    <h2 style="text-align:center; color:dodgerblue">About Us</h2>
    <p id="text_classic">
        Being the biggest land transportation company in terms of revenue size and number of passengers transported, the
        leading company of Turkey’s transportation sector BusTicketly has 1463 buses in total, 673 which being its own
        property within its fleet.

        It owns a young bus fleet and the age average of it is 3. In addition to the strong capital and organization
        structure of BusTicketly, to which it is registered, Metro Tourism has a significant advantage against its
        competitors through its domestic and overseas ticket sales network via a total of 1.000 active agencies in 77
        cities across Turkey. In a day, an average of 1400 trips take place with approximately 19.000.000 passengers
        transported annually. It provides inner-city transportation for the passengers via its 307 inner-city shuttles.

        In the year 2013, total number of passengers of the Company what was around 21 million reached above 23 million
        in the year 2014. In a period, where attractive options are created for airline, maritime and railroad passenger
        transportation, BusTicketly’s continuation on increasing the number of passengers and destinations shows
        Company’s strong status in the sector. Adopting the principle of not making any compromises in service quality,
        BusTicketly's passenger transportation target to reach in the year 2015 is 26 million.
    </p>

    <br>
    <h2 style="text-align:center; color:dodgerblue">Our Team</h2>
    <div class="row">
        <div class="column_aboutUs">
            <h2>Furkan Yorulmaz</h2>
            <p class="title">CEO & Founder</p>
            <p>furkan@busmail.com</p>
        </div>

        <div class="column_aboutUs">
            <h2>Göksu Pekacar</h2>
            <p class="title">Director</p>
            <p>goksu@busmail.com</p>
        </div>

        <div class="column_aboutUs">
            <h2>Ümmügülsüm Çamoğlu</h2>
            <p class="title">Officer</p>
            <p>gulsum@busmail.com</p>
        </div>
    </div>

</div>

<br>
<br>
<br>
<br>
<br>
<br>
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