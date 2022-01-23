<?php
    session_start();
    if (!isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: index.php");
    }
    include 'connectdb.php';
    $plateId=$_GET['plateId'];
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE Email='{$_SESSION["SESSION_EMAIL"]}'");
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
    }
    $carDetails=mysqli_query($conn,"SELECT * FROM `car` NATURAL JOIN `category` NATURAL JOIN `offices` WHERE PlateId='{$plateId}'");
    if (mysqli_num_rows($carDetails) > 0) {
        $carData = mysqli_fetch_array($carDetails);
    }
	$flag=1;
    if(isset($_POST['Submit']))
    {
        $sDate = $_POST["startDate"];
        $eDate = $_POST["endDate"];
        $sDate2 = strtotime($_POST["startDate"]);
        $eDate2 = strtotime($_POST["endDate"]);
        $userSSN = $data['SSN'];
        $cardNum = $_POST["cardnumber"];
        $daysRented = round(($eDate2 - $sDate2) / 86400);
        $totalPrice = $daysRented * $carData['PricePerDay'];
        $paymentM = 'NULL';
        if(isset($_POST['op'])){
          $paymentM = $_POST['op']." ".$cardNum;

        }
	if(mysqli_num_rows(mysqli_query($conn,"select * from `reservation` r  where PlateId='$plateId' and ((r.Pickup <= '$sDate' and r.Return >= '$sDate') or  (r.Pickup >= '$sDate' and r.Pickup <='$eDate'))")) > 0){
		 $flag=0;

	}else{
      $sql = "INSERT INTO `reservation` (`SSN`,`PlateId`,`Pickup`, `Return`,`Payment`,`TotalPrice`) VALUES ('{$userSSN}','{$plateId}','{$sDate}','{$eDate}','{$paymentM}','{$totalPrice}')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: userProfile.php");
      }else {
        echo "<script>alert('Error sql query failure');</script>";
      }
	}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="Cardform.css">
    <title>Home Page</title>
</head>
<body>

    <!--Header-->
    <header>
        <a href="#" class="logo"><img src="images/logo.png" alt="website logo"></a>
        <div class="header-btn">
            <a href="homepage.php" class="sign-in">Go back</a>
            <a href="logout.php" class="sign-in">Log Out</a>
        </div>
    </header>
<!-------------------------------------------------------------------------------->
<div class="container">
      <h1>Rent A Car</h1>
	  <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>
	  <?php if($flag==0){ ?>
      <span id="error" style="color:red; font-size: 18px; font-weight: bold;">Invalid time</span>
	  <?php } ?>
      <form action="" method="post" onsubmit="return validate()" required>
          <!--Printing User Data---------->
        <div class="inputField">
          <label class="labelInput">Frist Name: <?php echo $data['FirstName']; ?></label>
        </div>

        <div class="inputField">
          <label class="labelInput">Last Name: <?php echo $data['LastName']; ?></label>
        </div>

        <div class="inputField">
          <label class="labelInput">Email: <?php echo $data['Email']; ?></label>
        </div>

        <div class="inputField">
          <label class="labelInput">Contact Number: <?php echo $data['ContactNo']; ?></label>
        </div>
        <!---Printing Car Data---------->
        <div class="inputField">
        <br>
        <label class="labelInput">Car Details</label>
            <label class="labelInput">Country: <?php echo $carData['Country']?></label>
        </div>

        <div class="inputField">
           <label class="labelInput">Car Name: <?php echo $carData['CarName']?></label>
        </div>

        <div class="inputField">
           <label class="labelInput">Brand Name: <?php echo $carData['BrandName']?></label>
        </div>

        <div class="inputField">
           <label class="labelInput">Car Plate ID: <?php echo $carData['PlateId']?></label>
        </div>

        <div class="inputField">
           <label class="labelInput">Price Per Day: <?php echo $carData['PricePerDay']?></label>
        </div>
         <!--- Taking Input---------->
        <div class="inputField">
            <br>
            <label class="labelInput">Choose Pickup Date:</label>
            <input type="date" id="start" name="startDate" value="2022-01-01" min="2022-01-01" max="2023-01-01" class="labelInput">
        </div>
        <div class="inputField">
            <label class="labelInput">Choose Return Date:</label>
            <input type="date" id="end" name="endDate" value="2022-01-01" min="2022-01-01" max="2023-01-01" class="labelInput">
        </div>

        <div class="inputField">
        <br>
        <label class="labelInput">Choose Payment Method:</label>
        <input type="radio" id="paymentOp1" name="op" value="Credit/Debit Card" onclick="text(0)">
        <label for="op1">Credit/Debit Card</label>
        <input type="radio" for id="paymentOp2" name="op" value="Cash" onclick="text(1)">
        <label for="op2">Cash</label>
        </div>

        <div class="row" id="mycode" style="display: none;">
      <div class="col-75" >
        <div class="containerr">
            <div class="row">
              <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                  <i class="fa fa-cc-visa" style="color:navy;"></i>
                  <i class="fa fa-cc-amex" style="color:blue;"></i>
                  <i class="fa fa-cc-mastercard" style="color:red;"></i>
                  <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">

              </div>

            </div>
        </div>
      </div>
    </div>
        <button name="Submit" type="submit">Rent</button>
      </form>

    </div>


    <!-- Payment Form -->



    <script src="https://unpkg.com/scrollreveal"></script>
    <!--Link to JavaScript-->
    <script src="main.js"></script>
	<script src="Date.js"></script>
</body>
</html>
