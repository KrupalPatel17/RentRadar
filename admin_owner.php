<?php
session_start();

// Logout functionality
if (isset($_POST['btnlogout'])) {
    unset($_SESSION['admin']);
    header("Location: login.php");
    exit(); 
}

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Owner Management</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: darkgray;
        }

        h1 {
            margin-top: 3%;
            font-size: 36px;
            color: #009688;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
        }

        .table-container {
            width: 100%;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
            padding: 20px;
        }

        .search-bar {
            width: 60%;
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
            border-radius: 20px;
            border: 1px solid #555;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .search-bar:focus {
            outline: none;
            border-color: #009688;
            box-shadow: 0 0 8px rgba(0, 150, 136, 0.3);
        }

        .tbl {
            width: 100%;
            border-collapse: separate;
            /* Use 'separate' instead of 'collapse' */
            border-spacing: 0;
            /* Add spacing between cells if needed */
            border: 1px solid black;
            /* Add a border around the whole table */
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid black;
            /* Ensure borders are visible */
        }

        th {
            text-transform: uppercase;
            background-color: #009688;
            color: #ffffff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #e0f2f1;
        }

        tr:hover {
            background-color: #b2dfdb;
            border: 2px solid black;
        }

        .delete-btn {
            background: transparent;
            color: #f44336;
            font-size: 1.2em;
            border: none;
            transition: transform 0.3s ease;
        }

        .delete-btn:hover {
            color: #d32f2f;
            transform: scale(1.15);
        }

        .status-btn {
            border: none;
            padding: 8px 12px;
            color: #ffffff;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            border-radius: 50px;
            border: 1px solid black;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .status-btn.approve {
            background-color: #4CAF50;
            /* Green */
        }

        .status-btn.deny {
            background-color: #f44336;
            /* Red */
        }

        .status-btn:hover {
            transform: scale(1.1);
        }

        .approved-label,
        .denied-label {
            padding: 6px 10px;
            color: #ffffff;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .approved-label {
            background-color: #4CAF50;
        }

        .denied-label {
            background-color: #f44336;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
            padding-top: 60px;
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        #caption {
            text-align: center;
            color: white;
            padding: 10px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: red;
            font-size: 35px;
            font-weight: bold;
            background-color: white;
            border-radius: 50px;
            border: 1px solid black;
            padding: 3px 7px;
        }

        .close:hover,
        .close:focus {
            color: #f44336;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content {
            transition: transform 0.25s ease;
        }

        .doc-image {
            cursor: pointer;

        }
    </style>
</head>

<body id="b">
    <?php include("admin_navbar.php");?>
    <section>
        <h1 style="padding-top: 80px;">Manage Owners</h1>
        <div class="table-container">
            <input type="text" id="search" class="search-bar" placeholder="Search Owners...">
            <div id="tbl_rep">
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "ajax/ajax_admin_owner.php",
                    type: "POST",
                    success: function(data) {
                        $("#tbl_rep").html(data);
                    }
                });
            }
            loadTable();

            $(document).on("click", ".doc-image", function() {
                var largeSrc = $(this).data('large-src'); 
                var caption = $(this).attr('alt');
                $('#modalImage').attr('src', largeSrc); 
                $('#caption').text(caption); 
                $('#imageModal').fadeIn(); 
            });

            // Close modal
            $(document).on("click", ".close", function() {
                $('#imageModal').fadeOut(); 
            });


            $(document).on("click", ".status-btn", function() {
                var id = $(this).data("id");
                var action = $(this).hasClass("approve") ? "approve" : "deny";

                $.ajax({
                    url: "ajax/ajax_admin_owner_status_update.php",
                    type: "POST",
                    data: {
                        uid: id,
                        action: action
                    },
                    success: function(response) {
                        if (response == "success") {
                            loadTable();
                        } else {
                            alert("Unable to update status.");
                        }
                    }
                });
            });

            // Delete Owner
            $(document).on("click", ".delete-btn", function() {
                var id = $(this).data("id");
                var confirmation = confirm("Are you sure you want to delete this user?");
                if (confirmation) {
                    $.ajax({
                        url: "ajax/ajax_admin_owner_delete.php",
                        type: "POST",
                        data: {
                            uid: id
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                            } else {

                                alert("Unable to delete user.");
                            }
                        }
                    });
                }
            });

            // Search Owners
            $("#search").on("keyup", function() {
                var search_term = $(this).val();
                $.ajax({
                    url: "ajax/ajax_admin_owner_search.php",
                    type: "POST",
                    data: {
                        search: search_term
                    },
                    success: function(data) {
                        $("#tbl_rep").html(data);
                    }
                });
            });
        });
    </script>


</body>

</html>