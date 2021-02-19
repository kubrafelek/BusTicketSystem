<?php
$dbname = "busdb"; // database name
$conn = mysqli_connect("localhost", "root","");
if (!$conn) {
    die('not connected:'.mysqli_error());
}
$b = mysqli_select_db($conn, $dbname);
if (!$b) {
    // its the error that is given after a failed retrieval of a database schema
    die("db couldn't retrieved".mysqli_error($dbname));
}

#echo "Connection success.";
?>
