<?php
include("../connect.php");
session_start();
$id = $_POST["ids"];
$uid = $_SESSION['users_id'];

$checkQuery = "SELECT * FROM tbl_con WHERE house_id='$id' AND user_id='$uid'";
$checkResult = mysqli_query($connect, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "exists";

} else {
    $sel = "SELECT * FROM tbl_house WHERE house_id='$id'";
    $result = mysqli_query($connect, $sel);
    $cunt = mysqli_fetch_assoc($result);

    $owner_id = $cunt['owner_id'];

    $insert = "INSERT INTO tbl_con VALUES (0, $uid, $owner_id, $id, 0)";
    if (mysqli_query($connect, $insert)) {
        echo "added";
    } else {
        echo "error";
    }
}
?>
