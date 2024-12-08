<?php
session_start();
include("../connect.php");
$select = "SELECT * FROM tbl_owners";
$result = mysqli_query($connect, $select);
$i = 0;

if ($result) {
    $output = "
        <div class='table-container'>
            <table class='tbl' cellpadding='0' cellspacing='0' border='0'>
                <thead>
                    <tr>
                        <th style='width:3%'>#</th>
                        <th style='width:5%'>Owner Id</th>
                        <th style='width:8%'>Owner Name</th>
                        <th style='width:15%'>Email</th>
                        <th style='width:13%'>Phone Number</th>
                        <th style='width:25%'>Address</th>
                        <th style='width:15%'>Documents</th>
                        <th style='width:15%'>Status</th>
                        <th style='width:7%'>Action</th>
                    </tr>
                </thead>
                <tbody>";

    while ($uresult = mysqli_fetch_assoc($result)) {
        $userid = $uresult['owner_id'];
        $username = $uresult['owner_name'];
        $email = $uresult['email'];
        $phone = $uresult['phone'];
        $address = $uresult['addresh'];
        $status = $uresult['status'];
        $i++;

        // Conditionally display icons or text based on status
        $statusColumn = '';
        if ($status == 0) {
            $statusColumn = "<button class='status-btn approve' data-id='$userid'><i class='ri-check-line'></i> </button>
                             <button class='status-btn deny' data-id='$userid'><i class='ri-close-line'></i> </button>";
        } elseif ($status == 1) {
            $statusColumn = "<span class='approved-label'>Approved</span>";
        } elseif ($status == 2) {
            $statusColumn = "<span class='denied-label'>Declined </span>";
        }

        // Handle document image display
        $documentImage = $uresult['uploads']; 
        $documentImageHTML = $documentImage ? "<img src='$documentImage' alt='Document' style='width:70px; height:50px;' class='doc-image' data-large-src='$documentImage'>" : "No Document";

        // Update the output to include the document image column
        $output .= "<tr>
                        <td style='width:3%'>$i</td>
                        <td style='width:5%'>$userid</td>
                        <td style='width:8%'>$username</td>
                        <td style='width:15%'>$email</td>
                        <td style='width:13%'>$phone</td>
                        <td style='width:25%'>$address</td>
                        <td style='width:15%'>$documentImageHTML</td> 
                        <td style='width:15%'>$statusColumn</td>
                        <td style='width:7%'><button id='btndelete' class='delete-btn' data-id='$userid'><i class='ri-delete-bin-6-fill'></i></button></td>
                    </tr>";
    }

    $output .= "</tbody></table></div>";

    // Add modal HTML for displaying the large image
    $output .= "
        <div id='imageModal' class='modal'>
            <span class='close'>&times;</span>
            <img class='modal-content' id='modalImage'>
            <div id='caption'></div>
        </div>";

    echo $output;
} else {
    echo "Query failed.";
}
?>
