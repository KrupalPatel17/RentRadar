<?php
session_start();
include("connect.php");

if (!isset($_SESSION['owner_name'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Status</title>
    <style>
        /* General Styling */
        body {
            background-color: #f3f4f6;
            padding-top: 9%;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Status Table Styling */
        .status-table {
            width: 90%;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            border-collapse: collapse;
            background-color: #fff;
        }

        .status-table th, .status-table td {
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
            background-color: #f9fafb;
        }

        .status-table tr:nth-child(odd) {
            background-color: #e2e8f0;
        }

        .status-table tr:hover {
            background-color: #d1d5db;
            transition: background-color 0.3s;
        }

        /* Icon Button Styling */
        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin: 0 6px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .approve-btn {
            background-color: #28a745;
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);
        }

        .approve-btn:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        .deny-btn {
            background-color: #dc3545;
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
        }

        .deny-btn:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        /* Tooltip Styling */
        .tooltiptext {
            visibility: hidden;
            width: 80px;
            background-color: #333;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
        }

        .icon-btn:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        /* Approved and Denied Status Labels */
        .approved-label, .denied-label {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }

        .approved-label {
            background-color: #28a745;
        }

        .denied-label {
            background-color: #dc3545;
        }
        #b{
            background-color: darkgray;
        }
    </style>
</head>
<body id="b">
    <?php include("owner_nav.php"); ?>
    <div class="container">
        <h2>User Requests</h2>
        <table class="status-table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Home Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $owner_id = $_SESSION['owner_id'];
                $query = "SELECT 
                            tbl_user.user_name, 
                            tbl_user.phone, 
                            tbl_user.email, 
                            tbl_con.contact_id, 
                            tbl_con.status, 
                            tbl_house.house_num, 
                            tbl_house.soc_name, 
                            tbl_house.state, 
                            tbl_house.city 
                          FROM tbl_con 
                          JOIN tbl_user ON tbl_con.user_id = tbl_user.user_id 
                          JOIN tbl_house ON tbl_con.house_id = tbl_house.house_id 
                          WHERE tbl_con.owner_id = '$owner_id'";

                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $houseAddress = $row['house_num'] . ", " . $row['soc_name'] . ", " . $row['city'] . ", " . $row['state'];

                    echo "<tr id='row_{$row['contact_id']}'>
                            <td>{$row['user_name']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['email']}</td>
                            <td>{$houseAddress}</td>
                            <td>
                                <span id='status_{$row['contact_id']}'>";
                    if ($row['status'] == 1) {
                        echo "<span class='approved-label'>Approved</span>";
                    } elseif ($row['status'] == 2) {
                        echo "<span class='denied-label'>Denied</span>";
                    } else {
                        echo "<button class='icon-btn approve-btn' data-id='{$row['contact_id']}'>
                                ✓
                                <span class='tooltiptext'>Approve</span>
                              </button>
                              <button class='icon-btn deny-btn' data-id='{$row['contact_id']}'>
                                ✕
                                <span class='tooltiptext'>Deny</span>
                              </button>";
                    }
                    echo "</span>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // JavaScript for AJAX Approve/Deny functionality
        $(document).ready(function () {
            $(".approve-btn").click(function () {
                let requestId = $(this).data("id");
                updateStatus(requestId, 1); // 1 for approved
            });

            $(".deny-btn").click(function () {
                let requestId = $(this).data("id");
                updateStatus(requestId, 2); // 2 for denied
            });

            function updateStatus(requestId, status) {
                $.ajax({
                    url: 'ajax/update_status.php',
                    type: 'POST',
                    data: { id: requestId, status: status },
                    success: function (response) {
                        if (response === 'success') {
                            const statusCell = $("#status_" + requestId);
                            if (status === 1) {
                                statusCell.html("<span class='approved-label'>Approved</span>");
                            } else {
                                statusCell.html("<span class='denied-label'>Denied</span>");
                            }
                        } else {
                            alert("Error updating status");
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
