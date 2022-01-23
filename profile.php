<?php
session_start();
if (!isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: index.php");
}
include "connectdb.php"; // Using database connection file here
if(isset($_GET['num']))
{
$sql=mysqli_query($conn,"DELETE FROM `reservation` WHERE ReservationNumber='{$_GET['num']}'");
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE Email='{$_SESSION["SESSION_ADMIN"]}'");
if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_array($result);
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
    <link rel="stylesheet" href="style1.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!---Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <!--Header-->
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <!--<div class="bx bx-menu" id="menu-icon"></div>-->
      <ul class="navbar">
        <li><a href="homepage.php" >Home</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
      <div class="header-btn">
		<a href="addCar.php" class="sign-in">Add New Car</a>
        <a href="logout.php" class="sign-in">Logout</a>
      </div>
    </header>
    <!--Home-->
     <section class="home" id="home">
      <div class="arrange">
        <div class="text">
          <br><br><br>
          <h2><span>Profile:</span></h2>
          <h3><span>Full Name: </span> <?php echo "{$data["FirstName"]} {$data["LastName"]}";?></h3>
          <h3><span>Email: </span> <?php echo "{$data["Email"]}";?></h3>
          <h3><span>Contact Number: </span> <?php echo "{$data["ContactNo"]}";?></h3>
          <h3><span>Date Of Birth: </span> <?php echo "{$data["dob"]}";?></h3>
          <h3><span>Address: </span> <?php echo "{$data["Address"]}";?></h3>
          <h3><span>City: </span> <?php echo "{$data["City"]}";?></h3>
          <h3><span>Country: </span> <?php echo "{$data["Country"]}";?></h3>
        </div>
        <div class="form-container">
          <div class="arrange">
            <div class="text">
              <h3><span>Type for Search:</span></h3>
              <input type="text" id="live_search" autocomplete="off" placeholder="Search..">
            </div>
            <div class="btn-container" id="searchBtn">
              <input type="submit" name="Submit" id="" class="btn">
            </div>
          </div>
      </div>

      </div>

    </section>
    <!--Reservations Table-->
    <section class="services" id="searchResult">

    </section>
    <script src="searchJs.js"></script>
  </body>
</html>
