<?php
    include("../connect.php");
    
    session_start();
    $id = $_POST["ides"];
    $sql="SELECT * FROM tbl_house WHERE house_id = {$id}";
    $result=mysqli_query($connect,$sql) or die("SQL FAIELD");
    $output="";
    $button="";
    $i=0;
    if(mysqli_num_rows($result) > 0){
        $output ='';

        while($row=mysqli_fetch_assoc($result)){
            $i++;
            $output .="  <tr>
            <td>House Number</td>
            <td><input type='text' id='pname' value='{$row["house_num"]}' >
            <input type='text' id='eid' hidden value='{$row["house_id"]}'></td>
        </tr>
        <tr>
            <td>Socity Name</td>
            <td><input type='text' id='price' value='{$row["soc_name"]}' ></td>
        </tr>
        <tr>
            <td>Landmark</td>
            <td><input type='text' name='sprice' id='sprice' value='{$row["landmark"]}'></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type='text' name='date'  id='date' value='{$row["state"]}' required></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type='text'  name='time'  id='time'value='{$row["city"]}' required></td>
        </tr>
        <tr>
            <td>Pincode</td>
            <td><input type='number'  name='time'  id='time'value='{$row["pincode"]}' required></td>
        </tr>
        <tr>
            <td>Members</td>
            <td><input type='text'  name='time'  id='time'value='{$row["members"]}' required></td>
        </tr>
        <tr>
            <td>Furnishing</td>
            <td><input type='text'  name='time'  id='time'value='{$row["furnishing"]}' required></td>
        </tr>
        <tr>
            <td>Rent</td>
            <td><input type='number'  name='time'  id='time'value='{$row["rent"]}' required></td>
        </tr>
        <tr>
            <td>Number of Beds</td>
            <td><input type='text'  name='time'  id='time'value='{$row["num_bed"]}' required></td>
        </tr>
        <tr>
            <td>Numbers Of Bathroom</td>
            <td><input type='text'  name='time'  id='time'value='{$row["num_bath"]}' required></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type='text'  name='time'  id='time'value='{$row["description"]}' required></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type='text'  name='time'  id='time'value='{$row["img"]}' required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type='submit' id='btnsubmit' style='background-color:#0000ab' class='btnsave' data-aid='{$row["product_id"]}' value='Add To Auction'></td>
        </tr>";
        

        
        }

  

    mysqli_close($connect);
    
    echo $output;
    }else{
echo "ERROR";
    }

?>