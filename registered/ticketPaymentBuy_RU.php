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

if (isset($_SESSION)) {
    $number = $_SESSION['number'];
    $journeyId = $_SESSION['journeyId'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <title>TICKET PAYMENT BUY RU</title>

        <style>
            input[type=tel] {
                width: 20%;
                padding: 15px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: 2.5px solid #b7d7e8;
                background: #f1f1f1;
            }

            input[type=tel]:focus {
                background-color: #ddd;
                outline: none;
            }
        </style>
    </head>
<body>


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
    <h1>Ticket Payment</h1>
    <hr class="hr_main">
    <?php
    $query2 = "SELECT * FROM journey WHERE journeyId='$journeyId'";
    if (isset($conn)) {
        $output2 = mysqli_query($conn, $query2);

        if (!$output2) {
            echo 'error';
        } else {
            while ($row2 = mysqli_fetch_array($output2)) {
                $price = $row2['price'];
                $newPrice = $price * $number;
                echo "<h4>Total Amount For Payment: " . $newPrice;
                ?>
                <form action="#" method="POST">
                    <br>
                    <label>Credit Card Number :</label>
                    <input type="tel" placeholder="..." name="CCNumber" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}"
                           id="CCNumber" min="1" required>
                    <button style="width: 10%" type="submit" name="paymentbutton" class="CCNumbers">Pay</button>
                </form>
                </div>

                <footer class="main_footer">
                    <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
                </footer>

                </body>
                </html>

                <?php
                if (isset($_POST['paymentbutton'])) {
                    $CCNumber = $_POST['CCNumber'];

                    $ccn = "SELECT * FROM payment WHERE CCNumber='$CCNumber'";
                    $res = mysqli_query($conn, $ccn);

                    while ($row3 = mysqli_fetch_array($res)) {
                        $balance = $row3['balance'];
                        if ($row3['balance'] < $newPrice) {
                            echo '<script> 
                                        if(confirm("Your balance have not enough money !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_RU.php"
                                      }</script>';
                            exit();
                        } else {
                            $balance -= $newPrice;
                            $balanceUpdate = "UPDATE payment SET balance='$balance' WHERE CCNumber='$CCNumber'";
                            $output3 = mysqli_query($conn, $balanceUpdate);
                            if (!$output3) {
                                echo '<script> 
                                        if(confirm("Your ticket purchase is not complete !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_RU.php"
                                      }</script>';
                                exit();
                            } else {
                                $_SESSION['journeyId'] = $journeyId;
                                $_SESSION['number'] = $number;
                                $seats = $_SESSION['seats'];
                                $_SESSION['seats'] = $seats;
                                header("Location: finishBuySuccess.php");
                                #echo '<script> window.location.href = "finishedBuyTicket_RU.php"</script>';
                                exit();
                            }
                        }
                    }

                }
            }
        }
    }
}
?>



