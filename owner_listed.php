<?php
session_start();
if (isset($_POST['btnlogout'])) {
    unset($_SESSION['owner_name']);
    unset($_SESSION['owner_id']);
    header("Location: login.php");
    exit(); 
}


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
    <title>Bid Bazzar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Custom CSS -->
    <style>
        h2 {
            color: white;
        }

        .body {
            background-color: darkgray;
            padding-top: 9%;
        }

        #tbl_data {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #tbl_data td {
            vertical-align: middle !important;
            text-align: center;
            color: black;
        }

        #tbl_data th {
            vertical-align: middle !important;
            text-align: center;
            color: #fff;
        }

        #tbl_data thead th {
            background-color: #009688;
        }

        .table-hover tbody tr:nth-child(even) td {
            background: #f8f9fa;
        }

        .table-hover tbody tr:nth-child(odd) td {
            background: #e9ecef;
        }

        .table-hover tbody tr:hover td {
            background: #ced4da;
        }

        #tbl_data tbody tr.fade-in {
            animation: fadeIn 0.5s ease;
        }

        #edit {
            color: #4ba2ff;
            transition: all ease 0.5s;
            font-variation-settings:
                'FILL' 1,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }

        #edit:hover {
            transform: scale(1.30);
            color: #0026ee;
            text-decoration: none;
        }

        .edit-btn {
            border: none;
            background-color: transparent;
            position: relative;
            display: inline-block;
        }

        .edit-btn .tooltiptext {
            font-size: 80%;
            visibility: hidden;
            width: 100px;
            background-color: black;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            top: 100%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
            background-color: #2d3536;
        }

        .edit-btn:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        .material-symbols-outlined {
            color: #ff6b6b;
            transition: all ease 0.5s;
            font-variation-settings:
                'FILL' 1,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }

        .material-symbols-outlined:hover {
            color: red;
            transform: scale(1.30);
        }

        .delete-btn {
            border: none;
            background-color: transparent;
            position: relative;
            display: inline-block;
        }

        .delete-btn .tooltiptext {
            font-size: 80%;
            visibility: hidden;
            width: 100px;
            background-color: black;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            top: 100%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
            background-color: #2d3536;
        }

        .delete-btn:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        td .ri-auction-line {
            color: #000dff;
            font-weight: 900;
            font-size: 140%;
            transition: all ease 0.5s;
            filter: drop-shadow(1px 1px 1px black);
        }

        .auction-btn {
            border: none;
            background-color: transparent;
            transition: all ease 0.5s;
            position: relative;
            display: inline-block;
        }

        .auction-btn:hover {
            transform: scale(1.30);
        }

        .auction-btn .tooltiptext {
            font-size: 61%;
            visibility: hidden;
            width: 70px;
            background-color: black;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 90%;
            left: 150%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
            background-color: #2d3536;
        }

        .auction-btn:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }


        #modal {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;

        }

        #modal input {
            width: 80%;
            margin-top: 2%;
            background-color: #ced4da;
            border: 1px solid grey;
            border-radius: 3px;
            transition: all ease 0.5s;
        }

        #modal input:hover {
            transform: scale(1.10)
        }

        #modal_form {
            background: #fff;
            width: 40%;
            position: relative;
            top: 20%;
            left: calc(50%-20%);
            padding: 15px;
            border-radius: 4px;
            max-height: 70vh;
            overflow-y: auto;
            overflow-x: hidden;
            direction: rtl;
        }

        #modal_form>* {
            direction: ltr;
            /* Reset content direction to left-to-right */
            text-align: left;
            /* Ensure text alignment remains correct */
        }

        #modal_form h2 {
            margin: 0 0 15px;
            padding-bottom: 1px solid #000;
            color: #000dff;
            font-weight: bold;
            border-bottom: 2px double darkblue;
        }

        #close-btn {
            background: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
            position: absolute;
            top: 1px;
            right: 1px;
            cursor: pointer;
        }

        #btnsubmit {
            color: #fff;
            font-weight: bold;
            height: 7vh;
            box-shadow: -2px 4px 4px grey, -2px 4px 4px grey, -2px 4px 4px grey, -2px 4px 4px grey;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media screen and (max-width: 768px) {
            nav {
                width: 210%;
            }
        }
    </style>
</head>

<body class="body">
    <?php include("owner_nav.php"); ?>
    <center>
        <div id="modal">
            <div id="modal_form">
                <h2>Update House Details</h2>
                <table cellpading="10" width="100%">

                </table>
                <div id="close-btn">X</div>
            </div>
        </div>
    </center>
    <form action="" method="POST">
        <div class="container">
            <center>
                <h2 class="text-center mb-4" style="color: black;font-weight: bold;">Listed Homes</h2>
            </center>
            <table class="table table-bordered table-striped table-hover" id="tbl_data">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>


                <tr class="fade-in">
                    <td>1</td>
                    <td>Product A</td>
                    <td>Product A Details Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                    <td>Category A</td>
                    <td>10</td>
                    <td>$100</td>
                </tr>
                <!-- Add more rows as needed -->

            </table>

        </div>



        <!-- Bootstrap JS and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <script>
            $(document).ready(function() {
                function load() {
                    $.ajax({
                        url: "ajax/ajaxload.php",
                        type: "POST",
                        success: function(data) {
                            $("#tbl_data").html(data); // Replace the tbody content with the fetched data
                        }

                    });
                };
                load();

                $(document).on("click", ".delete-btn", function() {
                    var id = $(this).data("id");
                    var confirmation = confirm("Are you sure you want to delete this record?");
                    if (confirmation) {
                        $.ajax({
                            url: "ajax/ajaxdelete.php",
                            type: "POST",
                            data: {
                                ids: id
                            },
                            success: function(data) {

                                if (data == 1) {
                                    load();
                                } else {
                                    alert("Cant Delete Record");
                                }
                            }
                        });
                    } else {
                        console.log("Deletion cancelled.");
                    }

                });

                // $(document).on("click", ".edit-btn", function(ele) {
                //     ele.preventDefault();
                //     $("#modal").show();
                //     var sid = $(this).data("id");
                //     $.ajax({
                //         url: "ajax/ajaxupdate.php",
                //         type: "POST",
                //         data: {
                //             ides: sid
                //         },
                //         success: function(data) {
                //             $("#modal_form table").html(data);

                //         }

                //     })
                // });


                $("#close-btn").on("click", function() {
                    $("#modal").hide();
                });

                // $("#search").on("keyup", function() {
                //     var search_term = $(this).val();
                //     $.ajax({
                //         url: "ajaxserach.php",
                //         type: "POST",
                //         data: {
                //             search: search_term
                //         },
                //         success: function(data) {
                //             $("#tbl_data").html(data);
                //         }
                //     })
                // });


                $(document).on("click", "#btnsubmit", function() {
                    var aid = $(this).data("aid");
                    var housenum = $('#housenum').val();
                    var socname = $('#socname').val();
                    var land = $('#land').val();
                    var state = $('#state').val();
                    var city = $('#city').val();
                    var pincode = $('#pincode').val();
                    var members = $('#members').val();
                    var furnishing = $('#furnishing').val();
                    var rent = $('#rent').val();
                    var time = $('#time').val();
                    var time = $('#time').val();

                    if (sprice.trim() === "") {
                        alert("Please Enter Auction Starting Price");
                    } else if (date.trim() === "") {
                        alert("Please Enter Auction Date");
                    } else if (time.trim() === "") {
                        alert("Please Enter Auction Time");
                    } else {
                        $.ajax({
                            url: "ajax_auction_insert.php",
                            type: "POST",
                            data: {
                                aids: aid,
                                stprice: sprice,
                                adate: date,
                                atime: time
                            },
                            success: function(data) {
                                console.log(data);
                                if (data == 1) {
                                    alert("Product Add To Auction");
                                    $("#modal").hide();
                                } else {
                                    alert("Product Can't Add To Auctions");
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </form>
</body>

</html>