<?php
include("../connect.php");
session_start();
$id = $_POST["ids"];
$uid = $_SESSION['users_id'];

// Check if the house is already in the watchlist
$checkQuery = "SELECT * FROM tbl_watchlist WHERE house_id='$id' AND user_id='$uid'";
$checkResult = mysqli_query($connect, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // House already in watchlist
    echo "exists";
} else {
    // Fetch house details
    $sel = "SELECT * FROM tbl_house WHERE house_id='$id'";
    $result = mysqli_query($connect, $sel);
    $cunt = mysqli_fetch_assoc($result);

    $state = $cunt['state'];
    $city = $cunt['city'];
    $rent = $cunt['rent'];
    $img = $cunt['img'];
    $owner_id = $cunt['owner_id'];

    // Insert new entry in the watchlist
    $insert = "INSERT INTO tbl_watchlist VALUES (0, $uid, $owner_id, $id, '$state', '$city', $rent, '$img')";
    if (mysqli_query($connect, $insert)) {
        echo "added";
    } else {
        echo "error";
    }
}
?>
