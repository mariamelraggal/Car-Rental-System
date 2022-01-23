<?php
session_start();
if (!isset($_SESSION["SESSION_EMAIL"])) {
  header("Location: index.php");
}
include 'connectdb.php';
if (isset($_POST['Submit'])) {
	$selected=" all countries";
	$air=$_POST['airConditioner'];
	$trans=$_POST['transmission'];
	$airbag=$_POST['airBag'];
	$crash=$_POST['crashSensor'];
	$seat=$_POST['seatingCapacity'];
	$color=$_POST['color'];
  $price=$_POST['price'];
  $brandName=$_POST['brandName'];
	$query="SELECT * FROM `car` natural join `category` natural join `offices` where CarStatus='Active' ";
   if($_POST['country'] != "nth")
   {
	$selected=$_POST['country'];
	$query .= " AND Country= '$selected'";
   }
   if($_POST['airConditioner'] != "nth")
   {
	$query .= " AND AirConditioner= '$air'";
   }
   if($_POST['transmission'] != "nth")
   {
	$query .= " AND Auto= '$trans'";
   }
	if($_POST['airBag'] != "nth")
   {
	$query .= " AND DriverAirbag= '$airbag'";
   }
   if($_POST['crashSensor'] != "nth")
   {
	$query .= " AND CrashSensor= '$crash'";
   }
   if($_POST['seatingCapacity'] != "nth")
   {
	$query .= " AND SeatingCapacity= '$seat'";
   }
   if($_POST['color'] != "nth")
   {
	$query .= " AND Color= '$color'";
   }
   if($_POST['price'] != "nth")
   {
	$query .= " AND PricePerDay= '$price'";
   }
   if($_POST['brandName'] != "nth")
   {
	$query .= " AND BrandName= '$brandName'";
   }
   $records=mysqli_query($conn, $query);
}
$office_record=mysqli_query($conn, "select distinct Country from `offices`");
$color_record=mysqli_query($conn, "select distinct Color from `car`");
$noOfSeats_record=mysqli_query($conn, "select distinct SeatingCapacity from `car`");
$price_record=mysqli_query($conn, "select distinct PricePerDay from `car`");
$brand_record=mysqli_query($conn, "select distinct BrandName from `category`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style1.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <title>Home Page</title>
</head>

<body>
  <!--Header-->
  <header>
    <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
    <ul class="navbar">
      <li><a href="#">Home</a></li>
      <li><a href="userProfile.php">Profile</a></li>
    </ul>
    <div class="header-btn">
      <a href="logout.php" class="sign-in">Logout</a>
    </div>
  </header>
  <!--Home-->
  <section class="home" id="home">
    <div class="arrange">
      <div class="text">
        <br><br><br><br><br><h1>From which <span>country</span> <br>would you like to <br>rent your car?</h1>
        <!-- Where to go after picking a country             -->
      </div>

      <div class="form-container">
        <form action="" method="post">
          <div class="arrange">
            <div class="1st">
              <div class="arrange1">
              <div class="text">
                <h2> <span>Choose a country:</span> </h2>
              </div>

              <div class="input-box">
                <select class="minimal" name="country" id="" >
				<option value="nth" >Choose option</option>
				<?php
				while ($data = mysqli_fetch_array($office_record)) {
				?>
                  <option value= <?php echo $data['Country'];?>><?php echo $data['Country'];?></option>
                <?php
				}
				?>
                </select>
              </div>
            </div>
            </div>

            <div class="checkbox-container">
              <div class="input-box">

              <div class="arrange1">
              <div class="text">
                <h2> <span>Specs:</span> </h2>
              </div>
                <div class="grid-col">
                  <div class="text">
                  <select class="minimal" name="color" id="">
                  <option value="nth">Choose color</option>
				<?php
				while ($data = mysqli_fetch_array($color_record)) {
				?>
                  <option value=<?php echo $data['Color'];?>><?php echo $data['Color'];?></option>
				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="seatingCapacity" id="">
                  <option value="nth" >Seating Capacity</option>
				   <?php
				while ($data = mysqli_fetch_array($noOfSeats_record)) {
				?>
                  <option value="<?php echo $data['SeatingCapacity'];?>"><?php echo $data['SeatingCapacity'];?></option>

				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="brandName" id="">
                  <option value="nth">Brand Name</option>
				<?php
				while ($data = mysqli_fetch_array($brand_record)) {
				?>
                  <option value=<?php echo $data['BrandName'];?>><?php echo $data['BrandName'];?></option>
				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="price" id="">
                  <option value="nth" >Price Per Day</option>
				   <?php
				while ($data = mysqli_fetch_array($price_record)) {
				?>
                  <option value="<?php echo $data['PricePerDay'];?>"><?php echo $data['PricePerDay'];?></option>

				<?php
				}
				?>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="airConditioner" id="">
                  <option value="nth" >Air Conditioner</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="transmission" id="">
                  <option value="nth">Transmission</option>
                  <option value="1">Automatic</option>
                  <option value="0">Manual</option>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="crashSensor" id="">
                  <option value="nth" >Crash Sensor</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
                  </div>
                  <div class="text">
                  <select class="minimal" name="airBag" id="">
                  <option value="nth" >Air Bag</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
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

  </section>
  <section class="services" id="services">
    <?php
    if (isset($_POST['Submit'])) {
      if(mysqli_num_rows($records)>0){
    ?>
      <div class="heading">
        <h1>Explore Our Car options in <?php echo $selected; ?>!</h1>
      </div>
      <div class="services-container">
        <?php
        while ($data = mysqli_fetch_array($records)) {
        ?>
          <div class="box">
            <div class="box-img">
              <img src="<?php echo $data['Image']; ?>" alt="">
            </div>
            <h2><?php echo $data['BrandName']; ?></h2>
            <h3><?php echo $data['CarName']; ?></h3>
            <h3><?php echo $data['Year']; ?></h3>
            <h3> <?php if ($data['Auto']) {
                    echo 'Automatic';
                  } else {
                    echo 'Manual';
                  } ?></h3>
            <h3>Overview: <?php echo $data['Overview']; ?></h3>
            <h3>Price/Day: <?php echo $data['PricePerDay']; ?> LE</h3>
            <h3>Air Conditioner: <?php if ($data['AirConditioner']) {
                                    echo '<i class="fas fa-check-square" style="color:green;"></i>';
                                  } else {
                                    echo '<i class="fas fa-times" style="color:red;"></i>';
                                  } ?></h3>
            <h3>Crash Sensor: <?php if ($data['CrashSensor']) {
                                echo '<i class="fas fa-check-square" style="color:green;"></i>';
                              } else {
                                echo '<i class="fas fa-times" style="color:red;"></i>';
                              } ?></h3>
            <h3>Driver Airbag: <?php if ($data['DriverAirbag']) {
                                  echo '<i class="fas fa-check-square" style="color:green;"></i>';
                                } else {
                                  echo '<i class="fas fa-times" style="color:red;"></i>';
                                } ?></h3>
            <h3>Number of seats: <?php echo $data['SeatingCapacity']; ?></h3>
            <a href="formOrder.php?plateId=<?php echo $data['PlateId']; ?>" class="btn">Rent Now</a>
          </div>
      <?php
        }
      }
      else { ?>
        <div class="heading">
          <h1>Sorry! No results found <i class="far fa-frown"></i></h1>
        </div>
      <?php
    }
    }
      ?>
      </div>
  </section>
  <script src="https://unpkg.com/scrollreveal"></script>
  <!--Link to JavaScript-->
  <script src="main.js"></script>
</body>

</html>
