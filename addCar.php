<?php
session_start();
if (!isset($_SESSION["SESSION_ADMIN"])) {
  header("Location: index.php");
}
include 'connectdb.php';
$worked = 1;
if(isset($_POST["addCar"])){
  $status=$_POST["status"];
  $officeId=$_POST["officeId"];
  $automatic=$_POST["Automatic"];
  $color=$_POST["color"];
  $crashSensor=$_POST["crashSensor"];
  $seatingCapacity=$_POST["seatingCapacity"];
  $airConditioner=$_POST["airConditioner"];
  $airbag=$_POST["airbag"];
  $image=$_POST["image"];
  $year=$_POST["year"];
  $price=$_POST["price"];
  $Overview=$_POST["Overview"];
  $CarName=$_POST["CarName"];
  $PlateId=$_POST["PlateId"];
  $BrandName=$_POST["BrandName"];
  
  if(isset($PlateId)){
	  if($airConditioner=="nth" || $airbag=="nth" || $crashSensor=="nth" || $automatic=="nth" || $status=="nth" )
	  {
		  echo "<script>alert('All specs must be specified');</script>";
	  }
	  else{
  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `car` WHERE PlateId='{$PlateId}'")) > 0) {
          $worked=0;
  }else {
	  if(isset($BrandName)){
	  $test=mysqli_query($conn,"select * from `category` where CarName='$CarName' and BrandName='$BrandName'");
	  
	  
	if(mysqli_num_rows($test)>0){
		$test=mysqli_fetch_array($test);
		$CarName=$test['CarName'];
		$BrandName=$test['BrandName'];
	}else{
		$data1=mysqli_query($conn,"insert into `category` values('$CarName','$BrandName')");
	}
    $sql = "INSERT INTO `car` (`PlateId`,`CarName`,`Overview`,`PricePerDay`, `Year`,`Image`,`DriverAirbag`,`AirConditioner`,`SeatingCapacity`,`CrashSensor`,`Color`,`Auto`,`OId`,`CarStatus`)
    VALUES ('{$PlateId}','{$CarName}','{$Overview}','{$price}','{$year}','{$image}','{$airbag}','{$airConditioner}','{$seatingCapacity}','{$crashSensor}','{$color}','{$automatic}','{$officeId}','{$status}')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location: adminPage.php");
    }else {
      echo "<script>alert('Error sql query failure');</script>";
    }
  }else{
	  echo "<script>alert('Brand Name must be specified');</script>";
  }
  }
  }}  else{
	   echo "<script>alert('Plate Id must be specified');</script>";
  }
	  
  
  }
  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="style.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <ul class="navbar">
        <li><a href="adminpage.php">Return Home Page</a></li>
      </ul>
    </header>
    <div class="container">
      <h1>Add New Car</h1>
      <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>
      <?php
      if (isset($_POST["addCar"])) {
        if ($worked==0) {
          echo '<span id="error" style="color:red; font-size: 18px; font-weight: bold;">Plate Id Already Exists</span>';
        }
      }
       ?>
      <form action="" method="post" onsubmit="return validate()" required>
        <div class="inputField">
          <label for="PlateId" class="labelInput">Plate Id</label>
          <input type="name" name="PlateId" placeholder="Enter Car Plate Id" class="input">
        </div>
        <div class="inputField">
          <label for="CarName" class="labelInput">Car Name</label>
          <input type="name" name="CarName" placeholder="Enter Car Name" class="input">
        </div>
        <div class="inputField">
          <label for="BrandName" class="labelInput">Brand Name</label>
          <input type="name" name="BrandName" placeholder="Enter Brand Name" class="input">
        </div>
        <div class="inputField">
          <label for="Overview" class="labelInput">Overview</label>
          <input type="name" name="Overview" placeholder="Enter Overview" class="input">
        </div>
        <div class="inputField">
          <label for="price" class="labelInput">Price Per Day</label>
          <input type="text" name="price" placeholder="Enter Price Per Day" class="input">
        </div>
        <div class="inputField">
          <label for="year" class="labelInput">Year</label>
          <input type="year" name="year" placeholder="Enter Year" class="input">
        </div>
        <div class="inputField">
          <label for="image" class="labelInput">Image Path</label>
          <input type="text" name="image" placeholder="Enter Car Image Path" class="input">
        </div>
        <div class="inputField">
          <label for="airbag" class="labelInput">Driver AirBag</label>
          <select name="airbag" class="input" required>
            <option value="nth">Choose Option:</option>
            <option value="True">Yes</option>
            <option value="False">No</option>
          </select>
        </div>
        <div class="inputField">
          <label for="airConditioner" class="labelInput">AirConditioner</label>
          <select name="airConditioner" class="input" required>
            <option value="nth">Choose Option:</option>
            <option value="True">Yes</option>
            <option value="False">No</option>
          </select>
        </div>
        <div class="inputField">
          <label for="seatingCapacity" class="labelInput">Seating Capacity</label>
          <input type="number" name="seatingCapacity" placeholder="Enter Car Seating Capacity" class="input">
        </div>
        <div class="inputField">
          <label for="crashSensor" class="labelInput">Crash Sensor</label>
          <select name="crashSensor" class="input" required>
            <option value="nth" >Choose Option:</option>
            <option value="True">Yes</option>
            <option value="False">No</option>
          </select>
        </div>
        <div class="inputField">
          <label for="color" class="labelInput">Color</label>
          <input type="text" name="color" placeholder="Enter Car Color" class="input">
        </div>
        <div class="inputField">
          <label for="Automatic" class="labelInput">Transmission Type</label>
          <select name="Automatic" class="input" required>
            <option value="nth">Choose Option:</option>
            <option value="True">Automatic</option>
            <option value="False">Manual</option>
          </select>
        </div>
        <div class="inputField">
          <label for="officeId" class="labelInput">office Id</label>
          <input type="number" name="officeId" placeholder="Enter Office Id" class="input">
        </div>
        <div class="inputField">
          <label for="status" class="labelInput">Car Status</label>
          <select name="status" class="input" required>
            <option value="nth">Choose Option:</option>
            <option value="Active">Active</option>
            <option value="Outofservice">Out Of Service</option>
          </select>
        </div>
        <button name="addCar" type="submit">Add Car</button>
      </form>
    </div>
	<script src="addCarJs.js"></script>
  </body>
</html>
