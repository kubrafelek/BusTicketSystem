<?php
$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE emailaddress='$email'";
if (isset($conn)) {
    $queryConn = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($queryConn)) {
        $name = $row['userName'];
        echo " " . $name;
    }
} ?>