<?php
session_start();
include("../connect.php");

$uid = $_SESSION['users_id'];
$select = "SELECT * FROM tbl_house";
$result = mysqli_query($connect, $select);
$i = 0;

if ($result) {
    $output = "
                <div class='tbl-container'>
                    <table class='tbl' cellpadding='0' cellspacing='0' border='1'>
                        <thead>
                            <tr>
                                <th style='width:4%'>#</th>
                                <th>House ID</th>
                                <th style='width:30%'>Address</th>
                                <th style='width:10%'>Members</th>
                                <th>Furnishing</th>
                                <th style='width:10%'>Rent</th>
                                <th style='width:25%'>Description</th>
                                <th style='width:12%'>Owner ID</th>
                                <th style='width:7%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

    while ($uresult = mysqli_fetch_assoc($result)) {
        $i++;
        $userid = $uresult['house_id'];
        $house_num = $uresult['house_num'];
        $soc_name = $uresult['soc_name'];
        $landmark = $uresult['landmark'];
        $state = $uresult['state'];
        $city = $uresult['city'];
        $pincode = $uresult['pincode'];
        $members = $uresult['members'];
        $furnishing = $uresult['furnishing'];
        $rent = $uresult['rent'];
        $description = $uresult['description'];
        $owner_id = $uresult['owner_id'];

        // Concatenate address details
        $address = "$house_num, $soc_name, $landmark, $city, $state - $pincode";

        // Construct table row
        $output .= "<tr>
                        <td style='width:4%'>$i</td>
                        <td>$userid</td>
                        <td style='width:30%'>$address</td>
                        <td style='width:10%'>$members</td>
                        <td>$furnishing</td>
                        <td style='width:10%'>$rent</td>
                        <td style='width:25%'>$description</td>
                        <td style='width:12%'>$owner_id</td>
                        <td style='width:7%'><button id='btndelete' class='delete-btn' data-id='$userid'><i class='ri-delete-bin-6-fill'></i></button></td>
                    </tr>";
    }

    $output .= "</tbody></table></div>";
    echo $output;
} else {
    echo "Query failed.";
}
