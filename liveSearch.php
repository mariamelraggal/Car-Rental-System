<?php
session_start();
if (!isset($_SESSION["SESSION_ADMIN"])) {
    header("Location: index.php");
}
include "connectdb.php"; // Using database connection file here
if(isset($_POST["input"])){
  $input=$_POST["input"];
  //class="content-table"
  $query="select * from `users`  natural join `reservation`   natural join `car` c  natural join `category`  join `offices` o on o.OId=c.OId
  where BrandName LIKE '%{$input}%' OR Pickup LIKE '%{$input}%' OR PlateId LIKE '%{$input}%' OR SSN LIKE '%{$input}%'
  OR o.Country LIKE '%{$input}%' OR FirstName LIKE '%{$input}%' OR ReservationNumber LIKE '%{$input}%' ORDER BY (ReservationNumber) DESC";
  $records=mysqli_query($conn, $query);
  if (mysqli_num_rows($records) > 0) {?>
    <div class="heading">
      <h1 style="text-align:left;">Reservations</h1>
      <table class="content-table">

        <thead>
          <tr>
            <th>Reservation Number</th>
            <th>Name</th>
            <th>National Id</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>Plate Id</th>
            <th>Car Name</th>
            <th>Car status</th>
            <th>Pickup Date</th>
            <th>Return Date</th>
            <th>Payment Method</th>
            <th>Total Price</th>
            <th>Delete Reservation</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($data = mysqli_fetch_array($records)) {
    			?>
                <tr>
                  <td><?php echo $data['ReservationNumber']; ?></td>
                  <td><?php echo $data['FirstName']." ".$data['LastName']; ?></td>
                  <td><?php echo $data['SSN']; ?></td>
                  <td><?php echo $data['ContactNo']; ?></td>
                  <td><?php echo $data['Email']; ?></td>
                  <td><?php echo $data['PlateId']; ?></td>
                  <td><?php echo $data['CarName']." ".$data['BrandName']." ".$data['Year']; ?></td>
                  <td><?php echo $data['CarStatus']; ?></td>
                  <td><?php echo $data['Pickup']; ?></td>
                  <td><?php echo $data['Return']; ?></td>
                  <td><?php echo $data['Payment']; ?></td>
                  <td><?php echo $data['TotalPrice']; ?></td>
                  <td>
                  <div class="header-btn">
                  <a href="profile.php?num=<?php echo $data['ReservationNumber']; ?>" class="sign-in" >Delete</a>
                  </div>
                </td>
                </tr>
    			<?php } ?>
        </tbody>
      </table>
    </div>
    <?php
  }
  else{
    ?>
    <div class="heading">
    <h1>Sorry! No results found <i class="far fa-frown"></i></h1>
    </div>
    <?php
  }
}?>
