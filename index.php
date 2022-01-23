<?php
session_start();
if (isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: homepage.php");
}else if (isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: adminpage.php");
}
include "connectdb.php"; // Using database connection file here
$records = mysqli_query($conn,"select * from `car` natural join `category` where CarStatus='Active'"); // fetch data from database
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
  </head>
  <body>
    <!--Header-->
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <!--<div class="bx bx-menu" id="menu-icon"></div>-->
      <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">About Us</a></li>
      </ul>
      <div class="header-btn">
        <a href="register.php" class="sign-up">Sign Up</a>
        <a href="login.php" class="sign-in">Sign In</a>
      </div>
    </header>
    <!--Home-->
    <section class="home" id="home">
      <div class="text">
        <h1><span>Looking</span> to <br>rent a car</h1>
        <p>High Quality Cars with Booking from everywhere in the world!</p>
      </div>
    </section>
    <!--Services-->
    <section class="services" id="services">
      <div class="heading">
        <span>Best Services</span>
        <h1>Explore Our Car options!</h1>
      </div>
      <div class="services-container">
      <?php
			while($data = mysqli_fetch_array($records))
			{
			?>
        <div class="box">
          <div class="box-img">
					<img src="<?php echo $data['Image']; ?>" alt="">
          </div>
		  <h2><?php echo $data['BrandName']; ?></h2>
          <h3><?php echo $data['CarName']; ?></h3>
          <a href="login.php" class="btn">Rent Now</a>
        </div>
		<?php
		}
		?>
	</div>
    </section>
    <section class="about" id="about">
      <div class="heading">
        <span>About Us</span>
        <h1>Best Customer Experience</h1>
      </div>
      <div class="about-container">
        <div class="about-img">
          <img src="images/aboutus.png" alt="">
        </div>
        <div class="about-text">
          <span>About Us</span>
          <p>Rental Car Services website for providing <br> Comfortable, Affordable, and Cheapest Rental Cars!</p>
        </div>
      </div>
    </section>
    <!--Scroll Reveal-->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!--Link to JavaScript-->
    <script src="main.js"></script>
  </body>
</html>
