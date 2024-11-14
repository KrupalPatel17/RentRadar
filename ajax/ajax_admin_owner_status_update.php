<?php
session_start();
include("../connect.php");

if (isset($_POST['uid']) && isset($_POST['action'])) {
    $uid = $_POST['uid'];
    $status = ($_POST['action'] == "approve") ? 1 : 2; // 1 for approved, 2 for denied

    $update = "UPDATE tbl_owners SET status = $status WHERE owner_id = $uid";
    $result = mysqli_query($connect, $update);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
