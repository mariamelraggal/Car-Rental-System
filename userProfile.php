<?php
session_start();
if (!isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: index.php");
}
include "connectdb.php"; // Using database connection file here
$result = mysqli_query($conn, "SELECT * FROM users WHERE Email='{$_SESSION["SESSION_EMAIL"]}'");
if (mysqli_num_rows($result) > 0) {
  $data = mysqli_fetch_array($result);
}
$records=mysqli_query($conn, "select * from `reservation` natural join `car` natural join `category` where SSN='{$data['SSN']}' ORDER BY (ReservationNumber) DESC");
if(isset($_POST['Submit']))
{
	$query="select * from `reservation` natural join `car` natural join `category` where SSN='{$data['SSN']}'";
	$pick=$_POST['pickup'];
	$brand=$_POST['brandname'];
	$plateid=$_POST['plateid'];
	if($_POST['brandname'] != "nth")
   {
	$query .= " AND BrandName= '$brand'";
   }
	if($_POST['pickup'] != "nth")
   {
	$query .= " AND Pickup= '$pick'";
   }
   if($_POST['plateid'] != "nth")
   {
	$query .= " AND PlateId= '$plateid'";
   }
   $query .= " ORDER BY (ReservationNumber) DESC";
   $records=mysqli_query($conn, $query);
}
$pickup_record=mysqli_query($conn, "select distinct Pickup from `reservation` where SSN='{$data['SSN']}'");
$Plate_record=mysqli_query($conn, "select distinct PlateId from `reservation` where SSN='{$data['SSN']}'");
$carB_record=mysqli_query($conn, "select distinct BrandName from `car` natural join `category` natural join `reservation` where SSN='{$data['SSN']}'");
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
        <a href="logout.php" class="sign-in">Logout</a>
      </div>
    </header>
    <!--Home-->
     <section class="home" id="home">
      <div class="arrange">
        <div class="text">
          <br><br><br><br><br><br>
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
        <form action="" method="post">
          <div class="arrange">


            <div class="checkbox-container">
              <div class="input-box">

              <div class="arrange1">

                <div class="grid-col">
                  <div class="form-container">
        <form action="" method="post">
          <div class="arrange">


            <div class="checkbox-container">
              <div class="input-box">

              <div class="arrange1">
              <div class="text">
                <h2> <span>Specs:</span> </h2>
              </div>
                <div class="grid-col">
                  <div class="text">
                  <select class="minimal" name="plateid" id="">
                  <option value="nth">Plate ID</option>
				<?php
				while ($data = mysqli_fetch_array($Plate_record)) {
				?>
                  <option value=<?php echo $data['PlateId'];?>><?php echo $data['PlateId'];?></option>
				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="pickup" id="">
                  <option value="nth" >Pickup</option>
				   <?php
				while ($data = mysqli_fetch_array($pickup_record)) {
				?>
                  <option value="<?php echo $data['Pickup'];?>"><?php echo $data['Pickup'];?></option>

				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="brandname" id="">
                  <option value="nth">Brand Name</option>
				<?php
				while ($data = mysqli_fetch_array($carB_record)) {
				?>
                  <option value=<?php echo $data['BrandName'];?>><?php echo $data['BrandName'];?></option>
				<?php
				}
				?>
                </select>
                  </div>

                </div>
              </div>
              </div>
            </div>

            <div class="btn-container">
              <input type="submit" name="Submit" id="" class="btn">
            </div>
          </div>
        </form>
      </div>

                </div>
              </div>
              </div>
            </div>

            <div class="btn-container">
              <input type="submit" name="Submit" id="" class="btn">
            </div>
          </div>
        </form>
      </div>



      </div>

    </section>
    <!--Reservations Table-->
    <section class="services">
      <div class="heading">
        <h1 style="text-align:left;">Reservations</h1>
        <table class="content-table">

          <thead>
            <tr>
              <th>Reservation Number</th>
              <th>Plate Id</th>
              <th>Car Name</th>
              <th>Pickup Date</th>
              <th>Return Date</th>
              <th>Payment Method</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
		   <?php
			if(mysqli_num_rows($records)>0){

			while ($data = mysqli_fetch_array($records)) {
			?>
            <tr>
              <td><?php echo $data['ReservationNumber']; ?></td>
              <td><?php echo $data['PlateId']; ?></td>
              <td><?php echo $data['CarName']." ".$data['BrandName'];?></td>
              <td><?php echo $data['Pickup']; ?></td>
              <td><?php echo $data['Return']; ?></td>
              <td><?php echo $data['Payment']; ?></td>
              <td><?php echo $data['TotalPrice']; ?></td>
            </tr>
             <?php
			}
			}

			else{
				?>
				<div class="heading">
				<h1>Sorry! No results found <i class="far fa-frown"></i></h1>
				</div>
				<?php
			}?>
          </tbody>
        </table>
      </div>
    </section>
  </body>
</html>
