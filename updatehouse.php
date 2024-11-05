<?php
session_start();

include("connect.php");

if (!isset($_SESSION['owner_name'])) {
    header("location:login.php");
}

if (isset($_GET['pid'])) {
    $sel = "select * from tbl_house where house_id=$_GET[pid]";
    $res = mysqli_query($connect, $sel);
    $house = mysqli_fetch_assoc($res);
    $house_id= $house['house_id'];
}

// // Fetch current house details
// $query = "SELECT * FROM tbl_house WHERE id = '$house_id'";
// $result = mysqli_query($connect, $query);
// $house = mysqli_fetch_assoc($result);  
if (isset($_POST['btnupdate'])) {

    $houseNumber = $_POST['houseNumber'];
    $societyName = $_POST['societyName'];
    $landmark = $_POST['landmark'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $membersAllowed = $_POST['membersAllowed'];
    $furnish = $_POST['furnish'];
    $rent = $_POST['rent'];
    $num_beds = $_POST['num_beds'];
    $num_bath = $_POST['num_bath'];
    $description = $_POST['description'];

    // Handle file upload only if a new image is uploaded
    if (!empty($_FILES["uploadfile"]["name"])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tmpname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "img/" . $filename;
        move_uploaded_file($tmpname, $folder);

        // Update query with image
        $update = "UPDATE tbl_house SET house_num='$houseNumber', soc_name='$societyName', landmark='$landmark', state='$state', city='$city', pincode='$pincode', members='$membersAllowed', furnishing='$furnish', rent='$rent', num_bed='$num_beds', num_bath='$num_bath', description='$description', img='$folder' WHERE house_id='$house_id'";
    } else {
        // Update query without image
        $update = "UPDATE tbl_house SET house_num='$houseNumber', soc_name='$societyName', landmark='$landmark', state='$state', city='$city', pincode='$pincode', members='$membersAllowed', furnishing='$furnish', rent='$rent', num_bed='$num_beds', num_bath='$num_bath', description='$description' WHERE house_id='$house_id'";
    }

    if (mysqli_query($connect, $update)) {
        echo '<script>alert("House details updated successfully")</script>';
         header("location:owner_listed.php");
    } else {
        echo '<script>alert("Error updating details. Please try again.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update House Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            padding-top: 52%;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .form-container {
            background-color: #ffffff87;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            margin-top: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #007bff;
        }

        .form-container input[type="file"] {
            padding: 3px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #009688;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .form-container button:hover {
            background-color: #009688;
        }

        .row select,
        .row input {
            flex: 1;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 11px;
            width: 102%;
            padding-left: 2%;
            margin-bottom: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body style="background-color: darkgray;">
    <?php include("owner_nav.php"); ?>

    <div class="form-container">
        <h2>Update Your House Details</h2>
        <form action="" method="POST" id="updateForm" enctype="multipart/form-data">
            <label for="houseNumber">House Number:</label>
            <input type="text" id="houseNumber" name="houseNumber" value="<?php echo $house['house_num']; ?>" required>

            <label for="societyName">House Address:</label>
            <div class="row">
                <input type="text" id="societyName" name="societyName" value="<?php echo $house['soc_name']; ?>" required>
                <input type="text" id="landmark" name="landmark" value="<?php echo $house['landmark']; ?>" required>
            </div>

            <div class="row">
                <select id="state" name="state" required onchange="updateCityDropdown()">
                    <option value="">Select State</option>
                    <option value="Andhra Pradesh" <?php echo $house['state'] == 'Andhra Pradesh' ? 'selected' : ''; ?>>Andhra Pradesh</option>
                    <option value="Arunachal Pradesh" <?php echo $house['state'] == 'Arunachal Pradesh' ? 'selected' : ''; ?>>Arunachal Pradesh</option>
                    <option value="Assam" <?php echo $house['state'] == 'Assam' ? 'selected' : ''; ?>>Assam</option>
                    <option value="Bihar" <?php echo $house['state'] == 'Bihar' ? 'selected' : ''; ?>>Bihar</option>
                    <option value="Chhattisgarh" <?php echo $house['state'] == 'Chhattisgarh' ? 'selected' : ''; ?>>Chhattisgarh</option>
                    <option value="Goa" <?php echo $house['state'] == 'Goa' ? 'selected' : ''; ?>>Goa</option>
                    <option value="Gujarat" <?php echo $house['state'] == 'Gujarat' ? 'selected' : ''; ?>>Gujarat</option>
                    <option value="Haryana" <?php echo $house['state'] == 'Haryana' ? 'selected' : ''; ?>>Haryana</option>
                    <option value="Himachal Pradesh" <?php echo $house['state'] == 'Himachal Pradesh' ? 'selected' : ''; ?>>Himachal Pradesh</option>
                    <option value="Jharkhand" <?php echo $house['state'] == 'Jharkhand' ? 'selected' : ''; ?>>Jharkhand</option>
                    <option value="Karnataka" <?php echo $house['state'] == 'Karnataka' ? 'selected' : ''; ?>>Karnataka</option>
                    <option value="Kerala" <?php echo $house['state'] == 'Kerala' ? 'selected' : ''; ?>>Kerala</option>
                    <option value="Madhya Pradesh" <?php echo $house['state'] == 'Madhya Pradesh' ? 'selected' : ''; ?>>Madhya Pradesh</option>
                    <option value="Maharashtra" <?php echo $house['state'] == 'Maharashtra' ? 'selected' : ''; ?>>Maharashtra</option>
                    <option value="Manipur" <?php echo $house['state'] == 'Manipur' ? 'selected' : ''; ?>>Manipur</option>
                    <option value="Meghalaya" <?php echo $house['state'] == 'Meghalaya' ? 'selected' : ''; ?>>Meghalaya</option>
                    <option value="Mizoram" <?php echo $house['state'] == 'Mizoram' ? 'selected' : ''; ?>>Mizoram</option>
                    <option value="Nagaland" <?php echo $house['state'] == 'Nagaland' ? 'selected' : ''; ?>>Nagaland</option>
                    <option value="Odisha" <?php echo $house['state'] == 'Odisha' ? 'selected' : ''; ?>>Odisha</option>
                    <option value="Punjab" <?php echo $house['state'] == 'Punjab' ? 'selected' : ''; ?>>Punjab</option>
                    <option value="Rajasthan" <?php echo $house['state'] == 'Rajasthan' ? 'selected' : ''; ?>>Rajasthan</option>
                    <option value="Sikkim" <?php echo $house['state'] == 'Sikkim' ? 'selected' : ''; ?>>Sikkim</option>
                    <option value="Tamil Nadu" <?php echo $house['state'] == 'Tamil Nadu' ? 'selected' : ''; ?>>Tamil Nadu</option>
                    <option value="Telangana" <?php echo $house['state'] == 'Telangana' ? 'selected' : ''; ?>>Telangana</option>
                    <option value="Tripura" <?php echo $house['state'] == 'Tripura' ? 'selected' : ''; ?>>Tripura</option>
                    <option value="Uttar Pradesh" <?php echo $house['state'] == 'Uttar Pradesh' ? 'selected' : ''; ?>>Uttar Pradesh</option>
                    <option value="Uttarakhand" <?php echo $house['state'] == 'Uttarakhand' ? 'selected' : ''; ?>>Uttarakhand</option>
                    <option value="West Bengal" <?php echo $house['state'] == 'West Bengal' ? 'selected' : ''; ?>>West Bengal</option>
                </select>


                <select id="city" name="city" required>
                    <option value="">Select City</option>
                </select>
            </div>

            <label for="pincode">House Pincode:</label>
            <input type="number" id="pincode" name="pincode" value="<?php echo $house['pincode']; ?>" required>

            <label for="membersAllowed">Members Allowed:</label>
            <input type="number" id="membersAllowed" name="membersAllowed" value="<?php echo $house['members']; ?>" required>

            <label for="houseNumber">Furnishing:</label>
            <select id="furnish" name="furnish" required>
                <option value="">Select Furnishing</option>
                <option value="Furnished" <?php echo $house['furnishing'] == 'Furnished' ? 'selected' : ''; ?>>Furnished</option>
                <option value="Semi-Furnished" <?php echo $house['furnishing'] == 'Semi-Furnished' ? 'selected' : ''; ?>>Semi-Furnished</option>
                <option value="Unfurnished" <?php echo $house['furnishing'] == 'Unfurnished' ? 'selected' : ''; ?>>Unfurnished</option>
            </select>

            <label for="rent">Rent:</label>
            <input type="number" id="rent" name="rent" value="<?php echo $house['rent']; ?>" required>

            <label for="rent">Number of Bedrooms:</label>
            <input type="number" id="rent" name="num_beds" value="<?php echo $house['num_bed']; ?>" required>

            <label for="rent">Number of Bathrooms:</label>
            <input type="number" id="rent" name="num_bath" value="<?php echo $house['num_bath']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo $house['description']; ?></textarea>

            <label for="housePhoto">Upload House Photo:</label>
            <input type="file" id="housePhoto" name="uploadfile">
            <p>Current image: <img src="<?php echo $house['img']; ?>" width="100px"></p>

            <button type="submit" name="btnupdate">Update</button>
        </form>
    </div>

    <script>
        // JavaScript Object of States and Cities
        var citiesByState = {
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

        // Function to Update the City Dropdown
        function updateCityDropdown() {
            var stateSelect = document.getElementById('state');
            var citySelect = document.getElementById('city');
            var selectedState = stateSelect.value;

            // Clear previous options in the city dropdown
            citySelect.innerHTML = '<option value="">Select City</option>';

            if (selectedState && citiesByState[selectedState]) {
                var cities = citiesByState[selectedState];
                cities.forEach(function(city) {
                    var option = document.createElement('option');
                    option.value = city;
                    option.text = city;
                    citySelect.appendChild(option);
                });

                // If there's a selected city in PHP
                var selectedCity = "<?php echo $house['city'] ?? ''; ?>";
                if (selectedCity) {
                    citySelect.value = selectedCity;
                }
            }
        }

        // Run the function once to populate the city dropdown when the page loads
        updateCityDropdown();
    </script>

</body>

</html>