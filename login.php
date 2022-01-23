<?php
  session_start();
  if (isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: homepage.php");
  }else if (isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: adminpage.php");
  }
  if(isset($_POST["login"])){
    include 'connectdb.php';
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    //check if the email and password exists
    $sql=mysqli_query($conn,"SELECT * FROM `users` WHERE Email='{$email}' AND Password='{$password}'");
    if (mysqli_num_rows($sql) === 1) {
      $data = mysqli_fetch_array($sql);
      if($data["admin"] == True){
        $_SESSION["SESSION_ADMIN"] = $email;
        header("Location: adminpage.php");
      }else{
        $_SESSION["SESSION_EMAIL"] = $email;
        header("Location: homepage.php");
      }
    }else{
      //check either email or password is incorrect
      if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users` WHERE Email='{$email}'")) === 1){
        echo "<script>alert('Invalid password.');</script>";
      }else {
        echo "<script>alert('Invalid email.');</script>";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <script src="loginJs.js"></script>
    <header>
      <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
      <ul class="navbar">
        <li><a href="index.php">Return Home Page</a></li>
      </ul>
    </header>
    <div class="container">
      <h1>Sign In</h1>
      <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>
      <form action="" method="post" onsubmit="return validate()" required>
        <div class="inputField">
          <label for="email" class="labelInput">Email</label>
          <input type="email" name="email" placeholder="Enter Your Email" class="input">
        </div>
        <div class="inputField">
          <label for="password" class="labelInput">Password</label>
          <input type="password" name="password" placeholder="Enter Your Password" class="input">
        </div>
        <button name="login" type="submit">Sign In</button>
      </form>
      <p>Don't have an account? <a href="register.php">Sign Up</a>.</p>
    </div>
  </body>
</html>
