<?php
session_start();
include('../connect.php');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $contact_id = $_POST['id'];
    $status = $_POST['status'];

    // Validate status to ensure it's only 1 (approved) or 2 (denied)
    if ($status == 1 || $status == 2) {
        $query = "UPDATE tbl_con SET status = ? WHERE contact_id = ?";
        $stmt = mysqli_prepare($connect, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $status, $contact_id);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "success";
            } else {
                echo "error";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "error";
        }
    } else {
        echo "invalid_status"; // In case of an unexpected status value
    }
} else {
    echo "missing_data"; // If required data is not provided in the request
}

mysqli_close($connect); // Close the database connection
?>
