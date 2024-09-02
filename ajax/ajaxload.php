<?php
session_start();
include("../connect.php");
$id = $_SESSION['owner_id'];
$sql = "SELECT * FROM tbl_house where owner_id='$id'";
$result = mysqli_query($connect, $sql) or die("SQL FAIELD");

$output = "";
$button = "";
$i = 0;
if (mysqli_num_rows($result) > 0) {
    $output = '<table   margin-top: 20px border-radius: 10px overflow: hidden box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1)>
        <thead>
        <tr>
            <th>#</th>
            <th>House Number</th>
            <th>Socity Name</th>
            <th>Landmark</th>
            <th>State</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Members</th>
            <th>Furnishing</th>
            <th>Rent</th>
            <th>Action</th>
           
        </tr>
        </thead>';

    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $output .= "<tr><td>$i</td><td>{$row["house_num"]}</td>
        <td>{$row["soc_name"]}</td><td>{$row["landmark"]}</td>
        <td>{$row["state"]}</td><td>{$row["city"]}</td>
        <td>{$row["pincode"]}</td><td>{$row["members"]}</td>
        <td>{$row["furnishing"]}</td><td>{$row["rent"]}</td>
        <td class='i'> &nbsp<button class='edit-btn'  data-id='{$row["house_id"]}'>
        <span class='material-symbols-outlined' id='edit'>edit</span> <span class='tooltiptext'>Edit Details</span></button>&nbsp
        <button class='delete-btn' data-id='{$row["house_id"]}'><span class='material-symbols-outlined' >delete</span> <span class='tooltiptext'>Delete Product</span></button>&nbsp</td></tr>";
    }


    $output .= "</table>";

    mysqli_close($connect);

    echo $output;
} else {
    echo '<h1 style="color:white">NO PRODUCTS ARE INSERTED</h1>';
}
?>