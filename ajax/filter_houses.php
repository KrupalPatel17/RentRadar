<?php
include("../connect.php");

// Check if state and city are provided
$state = isset($_POST['state']) ? $_POST['state'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';

$sql = "SELECT * FROM tbl_house";

// Apply filters if state and city are provided
if (!empty($state) && !empty($city)) {
    $sql = "SELECT * FROM tbl_house WHERE state = '$state' AND city = '$city'";
}

$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $count = 0;
    while ($row = $result->fetch_array()) {
        if ($count % 3 == 0 && $count != 0) {
            echo "<div class='clearfix'></div>";
        }
        echo "<div class='product'>";
        echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "'>";
        echo "<p><strong>State:</strong> " . $row['state'] . "&nbsp &nbsp &nbsp &nbsp &nbsp" . "<strong>City:</strong> " . $row['city'] . "</p>";
        echo "<p><strong>Rent:</strong> ₹" . $row['rent'] . "</p>";
        echo "<a href='displayhouse.php?pids={$row["house_id"]}' class='btn-view'>View Details</a>";
        echo "</div>";
        $count++;
    }
} else {
    echo "<p>No houses available in the selected state and city.</p>";
}

$connect->close();
?>
