<?php
session_start();
include("../connect.php");
$uid = $_SESSION['users_id'];
$select = "SELECT * FROM tbl_user ";
$result = mysqli_query($connect, $select);
$i = 0;

if ($result) {
    $output = "
                <table class='tbl' cellpadding='0' cellspacing='0' border='0'>
                    <thead>
                        <tr>
                            <th style='width:4%'>#</th>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th style='width:25%'>Email</th>
                            <th>Phone Number</th>
                            <th style='width:25%'>Address</th>
                            <th style='width:7%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>"; // Start of tbody

    while ($uresult = mysqli_fetch_assoc($result)) {
        $userid = $uresult['user_id'];
        $username = $uresult['user_name'];
        $email = $uresult['email'];
        $phone = $uresult['phone'];
        $address = $uresult['address'];
        $i++;

        $output .= "<tr>
                        <td style='width:4%'>$i</td>
                        <td>$userid</td>
                        <td>$username</td>
                        <td style='width:25%'>$email</td>
                        <td>$phone</td>
                        <td style='width:25%'>$address</td>
                        <td style='width:7%'><button id='btndelete' class='delete-btn' data-id='$userid' ><i class='ri-delete-bin-6-fill'></i></button></td>
                    </tr>";
    }

    $output .= "</tbody></table>"; // End of tbody and table
    echo $output; // Output the constructed table
} else {
    echo "Query failed."; // Handle case where the query failed
}
?>
