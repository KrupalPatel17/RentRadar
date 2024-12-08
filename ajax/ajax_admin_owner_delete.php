<?php
include("../connect.php");

$id = $_POST["uid"];

$del = "delete from tbl_owners where owner_id='$id'";


if (mysqli_query($connect, $del)) {
    
    echo 1;
} else {
    echo 0;
    echo $del;
}
?>