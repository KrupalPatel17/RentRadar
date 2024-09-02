<?php
session_start();

include("connect.php");

if (!isset($_SESSION['owner_name'])) {
  header("location:login.php");
}

include("connect.php");
if (isset($_POST['btnadd'])) {

  $filename = $_FILES["uploadfile"]["name"];
  $tmpname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "img/" . $filename;
  move_uploaded_file($tmpname, $folder);


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


  $veid = $_SESSION['owner_id'];
  $insert = "insert into tbl_house values(0,'$houseNumber','$societyName','$landmark','$state','$city','$pincode','$membersAllowed','$furnish','$rent','$num_beds','$num_bath','$description','$folder','$veid')";

//   echo $insert;
//   echo $_SESSION['owner_name'];
//   exit();
  if (mysqli_query($connect, $insert)) {
    echo '<script>alert("Product Inserted Successfully")</script>';
  } else {
    echo '<script>alert("You Must Enter Unique Serial Number Or Check Product Details Dont Use Special Chareaters Only Use , ")</script>';
  
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Rent Form</title>
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
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
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
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .form-container button:hover {
            background-color: #0056b3;
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


<body>
    <?php include("owner_nav.php"); ?>

    <div class="form-container">
        <h2>List Your House</h2>
        <form action="" method="POST" id="productForm" enctype="multipart/form-data">
            <label for="houseNumber">House Number:</label>
            <input type="text" id="houseNumber" name="houseNumber" required>

            <label for="societyName">House Address:</label>
            <div class="row">
                <input type="text" id="societyName" name="societyName" placeholder="Society Name" required>
                <input type="text" id="landmark" name="landmark" placeholder="Landmark" required>
            </div>
            <div class="row">
                <select id="state" name="state" required>
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
                <select id="city" name="city" required>
                    <option value="">Select City</option>
                    <!-- Cities will be populated based on selected state -->
                </select>
            </div>

            <label for="houseNumber">House Pincode:</label>
            <input type="number" id="houseNumber" name="pincode" required>

            
            <label for="membersAllowed">Members Allowed:</label>
            <input type="number" id="membersAllowed" name="membersAllowed" required>
            
            <label for="houseNumber">Furnishing:</label>
            <select id="state" name="furnish" required>
                <option value="">Select Furnishing</option>
                <option value="Furnished">Furnished</option>
                <option value=Semi-Furnished">Semi-Furnished</option>
                <option value="Unfurnished">Unfurnished</option>
            </select>

            <label for="rent">Rent:</label>
            <input type="number" id="rent" name="rent" required>

            <label for="rent">Number of Bedrooms:</label>
            <input type="number" id="rent" name="num_beds" required>

            <label for="rent">Number of Bathrooms:</label>
            <input type="number" id="rent" name="num_bath" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" placeholder="Describe your house..." required></textarea>

            <label for="housePhoto">Upload House Photo:</label>
            <input type="file" id="housePhoto" name="uploadfile" required>

            <button type="submit" name="btnadd" >Submit</button>
        </form>
    </div>

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