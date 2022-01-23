<?php
session_start();
if (!isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: index.php");
}
include "connectdb.php"; // Using database connection file here
$plateId=$_GET['status'];
$carDetails="SELECT * FROM `car` NATURAL JOIN `category` WHERE PlateId='{$plateId}'";
$data=mysqli_fetch_array(mysqli_query($conn,$carDetails));
if(isset($_POST["editCar"]))
{
 if($_POST['status'] != "nth"){
    $query=mysqli_query($conn,"UPDATE `car` SET CarStatus='{$_POST['status']}' WHERE PlateId='{$plateId}'");
  }
  if($_POST['price'] != ""){
    $query=mysqli_query($conn,"UPDATE `car` SET PricePerDay='{$_POST['price']}' WHERE PlateId='{$plateId}'");
  }
    header("Location: adminpage.php");

}
if(isset($_POST["deleteCar"]))
{
  // sql to delete a record
$sql = mysqli_query($conn,"DELETE FROM `car` WHERE PlateId='{$plateId}'");
header("Location: adminpage.php");

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <title>Car Rental</title>
  </head>
  <body>
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <ul class="navbar">
        <li><a href="adminpage.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
      </ul>
      <div class="header-btn">
        <a href="addCar.php" class="sign-in">Add New Car</a>
        <a href="logout.php" class="sign-in">Logout</a>
      </div>
    </header>
    <div class="container">
      <h1>Edit Car Status</h1>
      <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>
      <form action="" method="post">
        <div class="inputField">
          <label for="name" class="labelInput">Plate Id: <?php echo $data['PlateId']; ?></label>
        </div>
        <div class="inputField">
          <label for="name" class="labelInput">Car Name: <?php echo $data['CarName'];?></label>
        </div>
        <div class="inputField">
          <label for="name" class="labelInput">Brand Name: <?php echo $data['BrandName'];?></label>
        </div>
        <div class="inputField">
          <label for="name" class="labelInput">Current Car Status: <?php echo $data['CarStatus'];?></label>
        </div>
        <div class="inputField">
          <label for="name" class="labelInput">Current Price Per Day: <?php echo $data['PricePerDay'];?> LE</label>
        </div>
        <div class="inputField">
          <label for="status" class="labelInput">Car Status</label>
          <select name="status" class="input">
            <option value="nth">Choose Option:</option>
            <option value="Active">Active</option>
            <option value="OutOfService">Out of Service</option>
          </select>
        </div>
        <div class="inputField">
          <label for="price" class="labelInput">Price</label>
          <input type="name" name="price" placeholder="Enter Price Per Day" class="input">
        </div>
        <button name="editCar" type="submit">Edit Status</button>
        <button name="deleteCar" type="submit">Delete Car</button>

      </form>
    </div>
  </body>
</html>
