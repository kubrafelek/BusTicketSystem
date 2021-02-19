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

        <title>EDIT JOURNEY</title>

        <style>

            input[type=time] {
                width: 100%;
                padding: 13px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: 3px solid #b7d7e8;
                background: #f1f1f1;
                border-radius: 3px;
            }

            input[type=time]:focus {
                background-color: #ddd;
                outline: none;
            }

            #date {
                width: 100%;
                padding: 24px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: 3px solid #b7d7e8;
                background: #f1f1f1;
                border-radius: 3px;
            }

            #date:focus {
                background-color: #ddd;
                outline: none;
            }
        </style>
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


    <?php
    if (isset($_POST['journeyId'])){
    $id = $_POST['journeyId'];
    $_SESSION['journeyId'] = $_POST['journeyId'];

    $editJourney = "SELECT * FROM journey WHERE journeyId='$id'";
    if (isset($conn)) {
    $result = mysqli_query($conn, $editJourney);


    if (!$result) {
        echo "SQL error, check your query";
    } else {
    while ($row = mysqli_fetch_array($result)) {

    $from = $row['DeparturePlace'];
    $to = $row['DestinationPlace'];
    $date = $row['journeyDate'];
    $time = $row['journeyTime'];
    $price = $row['price'];
    ?>

    <form action="#" method="POST">
        <div class="container">
            <h1>Edit Journey</h1>
            <hr class="hr_main">

            <label><b>From</b></label>
            <input type="text" placeholder="<?php echo "" . $from ?>" name="from" disabled>

            <label><b>To</b></label>
            <input type="text" placeholder="<?php echo "" . $to ?>" name="to" disabled>

            <label><b>Date</b></label>
            <br>
            <input type="date" id="date" placeholder="<?php echo "" . $date ?>" name="date" required>
            <script>
                var today = new Date().toISOString().split('T')[0];
                document.getElementsByName("date")[0].setAttribute('min', today);
            </script>
            <label><b>Time</b></label>
            <input type="time" placeholder="<?php echo "" . $time ?>" name="time" required>
            <br>

            <label><b>Price</b></label>
            <input type="text" placeholder="<?php echo "" . $price ?>" name="price" required>
            <br>
            <br>
            <button type="submit" class="addjourneybtn" name="add_journey">Save</a></button>
        </div>
        <?php }
        }
        }
        }
        ?>
    </form>

    <footer class="main_footer">
        <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
    </footer>

    </body>
    </html>

<?php
if (isset($_POST['add_journey'])) {
    $id = $_SESSION['journeyId'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $price = $_POST['price'];

    $editQuery = "UPDATE journey SET journeyDate='$date', journeyTime='$time', price='$price' WHERE journeyId='$id'";
    if (isset($conn)) {
        $result = mysqli_query($conn, $editQuery);

        if (!$result) {
            #echo "SQL error, check your query";
           echo '<script>
                     if(confirm("Journey is not edit !")) {
                               window.location.href = "adminProfile.php"
              }</script>';
            exit();
        } else {
            #echo "Journey edited successfully";

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
                <h1 style="color: blanchedalmond">Journey edited, successfully.</h1>
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