<?php
session_start();
include("connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_name'])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Status</title>
    <style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 9%;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .status-table {
            width: 90%;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
        }

        .status-table th,
        .status-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            color: #555;
        }

        .status-table th {
            background-color: #009688;
            color: #fff;
        }

        .status-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-table tr:nth-child(odd) {
            background-color: #e9ecef;
        }

        .status-table tr:hover {
            background-color: #ced4da;
        }

        .details-btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .details-btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        /* Status styling */
        .status-approved {
            background-color: #28a745;
            color: white;
            padding: 5px;
            border-radius: 4px;
        }

        .status-denied {
            background-color: #dc3545;
            color: white;
            padding: 5px;
            border-radius: 4px;
        }

        .status-pending {
            background-color: #007bff;
            color: white;
            padding: 5px;
            border-radius: 4px;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            display: block;
            opacity: 1;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 15px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-50px);
            transition: transform 0.3s ease;
            position: relative;
    
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #009688;

        }

        .modal-header h4 {
            margin: 0;
            font-size: 1.5em;
            color: whitesmoke;
            font-weight: bold;
        }

        .close-btn {
            font-size: 20px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            position: absolute;
            top: 7px;
            right: 7px;
            background-color: red;
            border: 1px solid grey;
            border-radius: 50%;
            padding: 5px 8px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn:hover {
            color: #000;
        }

        #b {
            background-color: darkgray;
        }
    </style>
</head>

<body id="b">
    <?php include("navbar.php"); ?>
    <div class="container">
        <h2 style=" font-weight: bold;">House Status</h2>
        <table class="status-table">
            <thead>
                <tr>
                    <th>House Address</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['users_id'];
                $query = "SELECT 
                            tbl_house.house_num, 
                            tbl_house.soc_name, 
                            tbl_house.state, 
                            tbl_house.city, 
                            tbl_con.contact_id, 
                            tbl_con.status, 
                            tbl_con.owner_id 
                          FROM tbl_con 
                          JOIN tbl_house ON tbl_con.house_id = tbl_house.house_id 
                          WHERE tbl_con.user_id = '$user_id'";

                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $houseAddress = $row['house_num'] . ", " . $row['soc_name'];
                    $statusText = ($row['status'] == 1) ? "Approved" : (($row['status'] == 2) ? "Denied" : "Pending");
                    $isApproved = ($row['status'] == 1);
                    $statusClass = $row['status'] == 1 ? "status-approved" : ($row['status'] == 2 ? "status-denied" : "status-pending");

                    echo "<tr>
                            <td>{$houseAddress}</td>
                            <td>{$row['state']}</td>
                            <td>{$row['city']}</td>
                            <td><span class='{$statusClass}'>{$statusText}</span></td>
                            <td>
                                <button class='details-btn' " . ($isApproved ? "" : "disabled") . " onclick='showModal({$row['owner_id']})'>Show Details</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="ownerDetailsModal" class="modal">
        <div class="modal-content" >
            <div class="modal-header">
                <h4>Owner Details</h4>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div style="border:1px solid #000;border-radius: 1px;">
            <p><strong> &nbsp Name:</strong> <span id="ownerName"></span></p>
            <p><strong> &nbsp Phone:</strong> <span id="ownerPhone"></span></p>
            <p><strong> &nbsp Email:</strong> <span id="ownerEmail"></span></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showModal(ownerId) {
            $.ajax({
                url: 'ajax/get_owner_details.php',
                type: 'POST',
                data: {
                    owner_id: ownerId
                },
                dataType: 'json',
                success: function(data) {
                    $('#ownerName').text(data.owner_name);
                    $('#ownerPhone').text(data.phone);
                    $('#ownerEmail').text(data.email);
                    $('#ownerDetailsModal').addClass('show');
                },
                error: function() {
                    alert("Error fetching owner details.");
                }
            });
        }

        function closeModal() {
            $('#ownerDetailsModal').removeClass('show');
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('ownerDetailsModal')) {
                closeModal();
            }
        };
    </script>
</body>

</html>