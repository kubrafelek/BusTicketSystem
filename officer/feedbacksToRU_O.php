<?php
session_start();
include("../dbconnect.php");
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    include("loginOfficer.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../main.css">

        <title>FEEDBACKS TO REGISTER USER</title>
    </head>
    <body>
    <!-- Navbar -->
    <div class="navbar">

        <!-- Right-aligned links -->
        <div class="navbar-right">
            <a href="officerProfile.php">Officer Profile</a>
            <a href="../logout.php">Logout</a>
        </div>

    </div>

    <div class="container">
        <h1>Feedback To Register User</h1>
        <hr class="hr_main">

        <form action="#" method="POST">
            <?php
            if (isset($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
                $user = $_SESSION['email'];
                ?><p style="color:indianred"><?php echo "To Email Address: ".$user; ?></p>
                <?php
            }
            ?>
            <br>
            <label for="title">Title</label>
            <input type="text" id="title" name="title_msg" placeholder="Enter title: ">

            <label for="message">Message</label>
            <textarea id="message" name="msg_registered" placeholder="Write something.." style="width: 100%;
    height: 165px;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: 3px solid #b7d7e8;
    background: #f1f1f1;" required></textarea>

            <button type="submit" class="addjourneybtn" name="send_user">Send</button>
        </form>
    </div>


    <footer class="main_footer">
        <h5 id="footer_text"> All Rights Reserved By BUS TICKETLY. © 2020</h5>
    </footer>

    </body>
    </html>

<?php
if (isset($_POST['send_user'])) {
    $mailFrom = "kbr.flk@hotmail.com";
    $mailTo = $_SESSION['email'];
    $title_msg = $_POST['title_msg'];
    $message = $_POST['msg_registered'];

    #int random number generator
    $messageID = rand(1000000, 9999999);

    $feedbackUser = "INSERT INTO message(MessageID, Content,FromEmailAdd,ToEmailAdd,title) VALUES ('$messageID','$message','$mailFrom','$mailTo','$title_msg');";
    if (isset($conn)) {
        $result = mysqli_query($conn, $feedbackUser);

        if (!$result) {
            #echo "Error, check your code !!!";
            echo '<script> 
                               if(confirm("Message is not send ! \nDo you want to continue?")) {
                                    window.location.href = "officerProfile.php"
                              }</script>';
            exit();
        } else {
            #echo "Message send to User";
            echo '<script> 
                               if(confirm("Message send, successfully. \nDo you want to continue?")) {
                                    window.location.href = "officerProfile.php"
                              }</script>';
            exit();
        }
    }
}
?>