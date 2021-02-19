<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../main.css">

    <title>HOMEPAGE G</title>

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
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
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
        <span onclick="document.getElementById('id01').style.display='none'" class="close-contactUs"
              title="Close Modal">×</span>
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

<div class="big-image">
    <div id="list_journey">
        <form action="../guest/listOfJourneys_G.php" method="POST">
            <label for="from">From</label>
            <select id="from" name="from">
                <option value="İstanbul">İstanbul</option>
                <option value="Ankara">Ankara</option>
                <option value="İzmir">İzmir</option>
                <option value="Adana">Adana</option>
                <option value="Bursa">Bursa</option>
                <option value="Antep">Antep</option>
                <option value="Muğla">Muğla</option>
                <option value="Alanya">Alanya</option>
                <option value="Ordu">Ordu</option>
            </select>
            <label for="destination">Destination</label>
            <select id="destination" name="destination">
                <option value="İstanbul">İstanbul</option>
                <option value="Ankara">Ankara</option>
                <option value="İzmir">İzmir</option>
                <option value="Adana">Adana</option>
                <option value="Bursa">Bursa</option>
                <option value="Antep">Antep</option>
                <option value="Muğla">Muğla</option>
                <option value="Alanya">Alanya</option>
                <option value="Ordu">Ordu</option>
            </select>

            <label for="date">Date</label>
            <br>

            <input type="date" id="date" name="date">
            <!-- disable script for past dates -->
            <script>
                var today = new Date().toISOString().split('T')[0];
                document.getElementsByName("date")[0].setAttribute('min', today);
            </script>
            <br>

            <button type="submit" class="listbtn" name="submit_guest">List Journeys</a></button>
        </form>
    </div>
</div>


<form action="../guest/viewTicketDetail_G.php" method="POST">
    <input type="text" id="pnrinput" placeholder="Enter pnr number:" name="pnr">
    <button type="submit" class="pnrbtn">Find Ticket</a></button>
</form>

<!-- <a href="../guest/viewTicketDetail_G.php"> -->

<h5 class="h5_class">MOST TRAVELED CITIES</h5>
<div id="box_mostTraveledCities">
    <div class="box_city">
        <div class="image"><img src="../img/gorsel01.jpg" width="250px" height="250px"></div>
        <h3 class="h3_class"> ISTANBUL </h3>
    </div>

    <div class="box_city">
        <div class="image"><img src="../img/gorsel02.jpg" width="250px" height="250px"></div>
        <h3 class="h3_class"> ANKARA </h3>
    </div>

    <div class="box_city">
        <div class="image"><img src="../img/gorsel03.jpg" width="250px" height="250px"></div>
        <h3 class="h3_class"> ADANA </h3>
    </div>

    <div class="box_city">
        <div class="image"><img src="../img/gorsel04.jpg" width="250px" height="250px"></div>
        <h3 class="h3_class"> IZMIR </h3>
    </div>
</div>

<h5 class="h5_class">OPPORTUNITIES</h5>
<div id="box_class_icons">
    <div class="box_inside_icons">
        <div class="image_icon"><img class="img_size" src="../img/ann.png"></div>
        <h3 class="h4_class"> Announcements </h3>
        <p class="homepage_pid">There are many variations of passages of Lorem Ipsum available,</p>
    </div>

    <div class="box_inside_icons">
        <div class="image_icon"><img class="img_size" src="../img/campaing.png"></div>
        <h3 class="h4_class"> Campaigns </h3>
        <p class="homepage_pid">There are many variations of passages of Lorem Ipsum available,</p>
    </div>

    <div class="box_inside_icons">
        <div class="image_icon"><img class="img_size" src="../img/news.png"></div>
        <h3 class="h4_class"> News </h3>
        <p class="homepage_pid">There are many variations of passages of Lorem Ipsum available,</p>
    </div>
</div>

<div id="row_id">
    <div class="col_class">
        <h2 class="topic" style="width: 100%">Travel Information</h2>
        <ul>
            <li>Our Fleet</li>
            <li>Segment</li>
            <li>Passenger Rights</li>
            <li>Frequently Asked Questions</li>
        </ul>
    </div>

    <div class="col_class">
        <h2 class="topic" style="width: 100%">Web Pages</h2>
        <ul>
            <li>Homepage</li>
            <li>About Us</li>
            <li>Support</li>
            <li>Our Campaigns</li>
        </ul>
    </div>

    <div class="col_class">
        <h2 class="topic" style="width: 100%">Contact Us</h2>
        <p id="phone_num"><img src="../img/telephone.png" width="35px" height="35px"> 0890 960 66 77 </p>

        <p id="text_socialmedia">Social Medias</p>
        <div class="div_social_medias" style="margin-bottom: -15px">
            <ul class="social_medias">
                <a href="https://www.twitter.com" target="_blank">
                    <img src="../img/twitter.png">
                </a>

                <a href="https://www.youtube.com" target="_blank">
                    <img src="../img/youtube.png">
                </a>

                <a href="https://www.instagram.com" target="_blank">
                    <img src="../img/instagram.png">
                </a>
            </ul>
        </div>

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
