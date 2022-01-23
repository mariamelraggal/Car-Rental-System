<?php
  session_start();
  if (isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: homepage.php");
  }else if (isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: adminpage.php");
  }
  if(isset($_POST["register"])){
    include 'connectdb.php';
    $ssn = $_POST["ssn"];
    $name = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $email = $_POST["email"];
    //md5 to make password hashed
    $password = md5($_POST["password"]);
    $contactNo = $_POST["contactNo"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    //$conpassword = md5($_POST["conpassword"]);
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE Email='{$email}'")) > 0) {
            echo "<script>alert('Email Already Exists.');</script>";
    }else {
      $sql = "INSERT INTO `users` (`SSN`,`FirstName`,`LastName`,`Email`, `Password`,`ContactNo`,`dob`,`Address`,`City`,`Country`) VALUES ('{$ssn}','{$name}','{$lname}','{$email}','{$password}','{$contactNo}','{$dob}','{$address}','{$city}','{$country}')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: login.php");
      }else {
        echo "<script>alert('Error sql query failure');</script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <script src="regvalidate.js"></script>
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <ul class="navbar">
        <li><a href="index.php">Return Home Page</a></li>
      </ul>
    </header>
    <div class="container">
      <h1>Sign Up</h1>
      <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>
      <form action="" method="post" onsubmit="return validate()" required>
        <div class="inputField">
          <label for="Fname" class="labelInput">First Name</label>
          <input type="name" name="Fname" placeholder="Enter Your First Name" class="input">
        </div>
        <div class="inputField">
          <label for="Lname" class="labelInput">Last Name</label>
          <input type="name" name="Lname" placeholder="Enter Your Last Name" class="input">
        </div>
        <div class="inputField">
          <label for="ssn" class="labelInput">National Id</label>
          <input type="name" name="ssn" placeholder="Enter Your National Id" class="input">
        </div>
        <div class="inputField">
          <label for="email" class="labelInput">Email</label>
          <input type="text" name="email" placeholder="Enter Your Email" class="input">
        </div>
        <div class="inputField">
          <label for="contactNo" class="labelInput">Contact Number</label>
          <input type="text" name="contactNo" placeholder="Enter Your Contact Number" class="input">
        </div>
        <div class="inputField">
          <label for="dob" class="labelInput">Date Of Birth</label>
          <input type="date" name="dob" placeholder="Enter Your Date Of Birth" class="input" max="2003-12-31">>
        </div>
        <div class="inputField">
          <label for="address" class="labelInput">Address</label>
          <input type="text" name="address" placeholder="Enter Your Address" class="input">
        </div>
        <div class="inputField">
          <label for="city" class="labelInput">City</label>
          <input type="text" name="city" placeholder="Enter Your City" class="input">
        </div>
        <div class="inputField">
          <label for="country" class="labelInput">Country</label>
          <input type="text" name="country" placeholder="Enter Your Country" class="input">
        </div>
        <div class="inputField">
          <label for="password" class="labelInput">Password</label>
          <input type="password" name="password" placeholder="Enter Your Password" class="input">
        </div>
        <div class="inputField">
          <label for="conpassword" class="labelInput">Confirm Password</label>
          <input type="password" name="conpassword" placeholder="Enter Your Confirm Password" class="input">
        </div>
        <button name="register" type="submit">Sign Up</button>
      </form>
      <p>Have an account? <a href="login.php">Sign In</a>.</p>
    </div>
  </body>
</html>
