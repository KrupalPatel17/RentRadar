<?php
include("../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner_id = $_POST['owner_id'];

    $query = "SELECT owner_name, phone, email FROM tbl_owners WHERE owner_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $owner_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ownerDetails = $result->fetch_assoc();
        echo json_encode($ownerDetails);
    } else {
        echo json_encode(["error" => "No details found"]);
    }

    $stmt->close();
}
?>
