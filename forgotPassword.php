<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5 maxmum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="main.css">

    <title>FORGOT PASSWORD RU</title>
</head>
<br><br><br>
<body>
<form action="process.php" style="border:3px solid #ccc" method="POST">
    <div class="container">
        <h1>Forgot Password</h1>
        <hr>

        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <div class="cancel_signup">
            <button type="button" class="cancelbtn" style="width: 20%"><a href="login.php">Cancel</a></button>
            <button type="submit" class="addjourneybtn" name="send_email">Send</a></button>
        </div>
    </div>
</form>
</body>
</html>
