<?php
session_start();
include("connect.php");

if (!isset($_SESSION['user_name'])) {
    header("location:login.php");
}
$user_id=$_SESSION['users_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - House Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        #b {
            background-color: darkgray;
        }

        .filter-container {
            max-width: 1170px;
            margin: 20px auto;
            padding: 20px;
            background: #ececec;
            border-radius: 10px;
            margin-top: 7%;
            border: 1px solid black;
        }

        .filter-container input{
            border: 1px solid black;
        }

        .products-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: darkgray;
            margin-top: 2%;
        }

        .product {
            background-color: white;
            padding: 20px;
            margin-bottom: 30px;
            width: calc(33.33% - 20px);
            float: left;
            margin-right: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            color: #333;
            height: 390px; /* Fixed height for the house block */
            overflow: hidden; /* Prevent content overflow */
        }

        .product img {
            width: 100%;
            height: 200px; /* Fixed image height */
            display: block;
            object-fit: cover; /* Maintain image aspect ratio */
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.4rem;
            color: #009688;
            font-weight: 600;
        }

        .product p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 5px 0;
        }

        .product .btn-view {
            display: block;
            text-align: center;
            margin: 15px auto 0;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #009688;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .product .btn-view:hover {
            background-color: #00796B;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .product {
                width: calc(50% - 20px);
            }
        }

        @media screen and (max-width: 480px) {
            .product {
                width: calc(100% - 20px);
                margin-right: 0;
            }
        }
    </style>
</head>

<body id="b">
<form action="" method="POST">
        <?php include "navbar.php"; ?>

        <!-- Filter Section -->
        <div class="filter-container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <select id="state" class="form-control" name="state" required>
                        <option value="">Select State</option>
                        <option value="">Select State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <select id="city" class="form-control" name="city" required>
                        <option value="">Select City</option>
                        
                    </select>
                </div>
            </div>
            
        </div>
        
        <div id="filtered-houses" class="products-container clearfix">
           <center> <h2><b style="color:white; text-shadow:1px 1px 2px black">Watch List</b></h2></center>
            <?php include "ajax/watchlistfilter_houses.php"; ?> 
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        function loadHouses() {
            const state = $('#state').val();
            const city = $('#city').val();
            console.log(state);

            // Only make the AJAX request if both state and city are selected
            if (state && city) {
                $.ajax({
                    url: 'ajax/watchlistfilter_houses.php', // PHP file to get houses based on filter
                    method: 'POST',
                    data: { state: state, city: city },
                    success: function(response) {
                        $('#filtered-houses').html(response); // Update the house listings
                    }
                });
            } else {
                // If no filters are selected, reload all houses
                $.ajax({
                    url: 'ajax/watchlistfilter_houses.php',
                    method: 'POST',
                    data: {}, // Empty data to load all houses
                    success: function(response) {
                        $('#filtered-houses').html(response);
                    }
                });
            }
        }

        // Trigger loading houses whenever state or city is changed
        $('#state, #city').on('change', function() {
            loadHouses();
        });
    });
</script>

<script>
        const stateCityMap = {
            'Andhra Pradesh': ['Visakhapatnam', 'Vijayawada', 'Guntur'],
            'Arunachal Pradesh': ['Itanagar', 'Tawang', 'Ziro'],
            'Assam': ['Guwahati', 'Silchar', 'Dibrugarh'],
            'Bihar': ['Patna', 'Gaya', 'Bhagalpur'],
            'Chhattisgarh': ['Raipur', 'Bilaspur', 'Durg'],
            'Goa': ['Panaji', 'Margao', 'Vasco da Gama'],
            'Gujarat': ['Ahmedabad', 'Surat', 'Vadodara'],
            'Haryana': ['Gurgaon', 'Faridabad', 'Panipat'],
            'Himachal Pradesh': ['Shimla', 'Manali', 'Dharamshala'],
            'Jharkhand': ['Ranchi', 'Jamshedpur', 'Dhanbad'],
            'Karnataka': ['Bangalore', 'Mysore', 'Mangalore'],
            'Kerala': ['Thiruvananthapuram', 'Kochi', 'Kozhikode'],
            'Madhya Pradesh': ['Bhopal', 'Indore', 'Gwalior'],
            'Maharashtra': ['Mumbai', 'Pune', 'Nagpur'],
            'Manipur': ['Imphal', 'Churachandpur', 'Ukhrul'],
            'Meghalaya': ['Shillong', 'Tura', 'Jowai'],
            'Mizoram': ['Aizawl', 'Lunglei', 'Champhai'],
            'Nagaland': ['Kohima', 'Dimapur', 'Mokokchung'],
            'Odisha': ['Bhubaneswar', 'Cuttack', 'Rourkela'],
            'Punjab': ['Ludhiana', 'Amritsar', 'Chandigarh'],
            'Rajasthan': ['Jaipur', 'Jodhpur', 'Udaipur'],
            'Sikkim': ['Gangtok', 'Namchi', 'Gyalshing'],
            'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai'],
            'Telangana': ['Hyderabad', 'Warangal', 'Nizamabad'],
            'Tripura': ['Agartala', 'Udaipur', 'Kailashahar'],
            'Uttar Pradesh': ['Lucknow', 'Kanpur', 'Varanasi'],
            'Uttarakhand': ['Dehradun', 'Haridwar', 'Nainital'],
            'West Bengal': ['Kolkata', 'Howrah', 'Darjeeling']
        };

        document.getElementById('state').addEventListener('change', function() {
            const cities = stateCityMap[this.value] || [];
            const citySelect = document.getElementById('city');

            citySelect.innerHTML = '<option value="">Select City</option>';
            cities.forEach(function(city) {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        });
    </script>

</body>

</html>
