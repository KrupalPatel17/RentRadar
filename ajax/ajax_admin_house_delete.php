<?php
include("../connect.php");

$id = $_POST["uid"];

$del = "delete from tbl_house where house_id='$id'";


if (mysqli_query($connect, $del)) {

    echo 1;
} else {
    echo 0;
}
?>