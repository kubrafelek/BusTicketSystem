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

if (isset($_POST['submit_registered'])) {
    $from = $_POST['from'];
    $to = $_POST['destination'];
    $date = $_POST['date'];
    $time = "";
    $price = "";

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <title>LIST OF JOURNEYS RU</title>
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
            <a href="registerUserProfile.php"><?php include "registeredUserName.php"; ?></a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
    <h1>All Journeys</h1>
    <hr class="hr_main">
    <table id="seats" style="width: 85%">
    <tr style="color: darkred">
    <th>Bus</th>
    <th>From</th>
    <th>To</th>
    <th>Date</th>
    <th>Time</th>
    <th>Price</th>
    <th>Buy Ticket Action</th>
    <th>Reserve Ticket Action</th>
    <?php
    $query = "SELECT * FROM journey WHERE DeparturePlace='$from' AND DestinationPlace='$to' AND journeyDate='$date' ORDER BY journeyDate";
    if (isset($conn)) {
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo '<script> 
                          if(confirm("We can not find any journey. Choose an other date!")) {
                                window.location.href = "../base/homepage_RU.php"
                      }</script>';
            exit();
        }

        while ($row = mysqli_fetch_array($result)) {

            $today = strtotime("today");
            $journeyDate = $row['journeyDate'];
            $journeyDate = strtotime($journeyDate);

            if ($today == $journeyDate) {
                echo '<script> 
                          if(confirm("We can not view journeys. Choose an other date!")) {
                                window.location.href = "../base/homepage_RU.php"
                      }</script>';
                exit();
            }

            if ($row['isCancelled'] != '1') {
                /*echo '<script>
                          if(confirm("We can not find any journey. Choose an other date!")) {
                                window.location.href = "../base/homepage_RU.php"
                      }</script>';
                exit();*/
                ?>
                <tr>
                    <td><img src="../img/bus.png" width="50px" height="50px"></td>
                    <td><?php echo $row['DeparturePlace']; ?></td>
                    <td><?php echo $row['DestinationPlace']; ?></td>
                    <td><?php
                        $originalDate = $row['journeyDate'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        echo $newDate ?></td>
                    <td><?php echo $row['journeyTime']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
                        <?php echo "<form action='chooseSeatNoBuy_RU.php' method='post'><button value =" . $row['journeyId'] . " name=\"journeyId\" style=\"background-color: darkgreen; width: 70%; border-radius: 20px\">Buy Ticket</button></form>";
                        ?>
                    </td>
                    <td>
                        <?php
                        echo "<form method='POST'><button style=\"background-color: darkblue; width: 70%; border-radius: 20px\" value =" . $row['journeyId'] . "  name='journeyId'>Reserved Ticket</form></button>";
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
    }
}
?>

    </table>
</div>
    <br>
    <br>
    <footer class="main_footer">
        <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
    </footer>
</body>
    </html>
<?php
$journeyId = "";
if (isset($_POST['journeyId'])) {
    date_default_timezone_set("Europe/Istanbul");
    $_SESSION['journeyId'] = $_POST['journeyId'];
    $journeyId = $_SESSION['journeyId'];

    $journey_date = "SELECT * FROM journey WHERE journeyId='$journeyId'";
    if (isset($conn)) {
        $output = mysqli_query($conn, $journey_date);
        if (!$output) {
            #echo "Error";
            echo '<script>
            if(confirm("Some connection error !")){
                window.location.href = "../base/homepage_RU.php"
            }
            </script>';
        } else {
            while ($row = mysqli_fetch_array($output)) {
                $journeyDate = $row['journeyDate'];
                $start_date = strtotime("today");
                $end_date = strtotime("$journeyDate");
                $diff = ($end_date - $start_date);
                $day = ($diff) / 60 / 60 / 24;
                if ($day >= 3) {
                    $_SESSION['journeyId'] = $journeyId;
                    header("Location: ../registered/chooseSeatNoReserve_RU.php");
                    exit();
                } else {
                    echo '<script>
                    if(confirm("Ticket can not reserve.\n Do you want to continue?")){
                        window.location.href = "../base/homepage_RU.php"
                    }
                     </script>';
                }
            }
        }
    }
} ?>