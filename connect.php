<?php
error_reporting(E_ALL & ~E_WARNING);
$connect = mysqli_connect("localhost", "root", "", "rent_radar");
if (!$connect)
    echo "Can not connect to database" or die(mysqli_connect_error());
?>