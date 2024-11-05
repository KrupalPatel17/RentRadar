<?php
session_start();
include("../connect.php");

if (isset($_POST['ids'])) {
    $houseId = $_POST['ids'];
    $user_id = $_SESSION['users_id'];

    // Remove the house from the user's watchlist in the database
    $sql = "DELETE FROM tbl_watchlist WHERE house_id = '$houseId' AND user_id = '$user_id'";
    if ($connect->query($sql) === TRUE) {
        echo "removed";
    } else {
        echo "error";
    }
    $connect->close();
}
?>
