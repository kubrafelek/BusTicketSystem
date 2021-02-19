<?php
session_start();
include("../dbconnect.php");

if (isset($_SESSION)) {
    $number = $_SESSION['number'];
    $journeyId = $_SESSION['journeyId'];
    #$seats = $_SESSION['seats'];

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../main.css">
        <title>TICKET PAYMENT BUY G</title>

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
                    <input style="width: 30%" type="tel" pattern="[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}"
                           placeholder="Enter CC Number" name="CCNumber" id="CCNumber" required>
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
                    if (!$res) {
                        echo "Wrong Credit Card Number !";
                        echo '<script> 
                               if(confirm("Wrong Credit Card Number !\nDo you want to continue?")) {
                                    window.location.href = "ticketPayment_G.php"
                              }</script>';
                        exit();
                    } else {
                        while ($row3 = mysqli_fetch_array($res)) {
                            $balance = $row3['balance'];
                            if ($row3['balance'] < $newPrice) {
                                #echo "Your balance have not enough money!";
                                echo '<script> 
                                        if(confirm("Your balance have not enough money !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_G.php"
                                      }</script>';
                                exit();
                            } else {
                                $balance -= $newPrice;
                                $balanceUpdate = "UPDATE payment SET balance='$balance' WHERE CCNumber='$CCNumber'";
                                $output3 = mysqli_query($conn, $balanceUpdate);
                                if (!$output3) {
                                    echo '<script> 
                                        if(confirm("Your ticket purchase is not complete !\nDo you want to continue?")) {
                                            window.location.href = "../base/homepage_G.php"
                                      }</script>';
                                    exit();
                                } else {
                                    #echo "Payment Finished";
                                    $_SESSION['journeyId'] = $journeyId;
                                    $_SESSION['number'] = $number;
                                    $seats = $_SESSION['seats'];
                                    $_SESSION['seats'] = $seats;
                                    header("Location: finishSuccess.php");
                                    #echo '<script> window.location.href = "finishedBuyTicket_G.php"</script>';
                                    exit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
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