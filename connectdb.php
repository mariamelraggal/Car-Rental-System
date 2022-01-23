<?php
$conn = mysqli_connect("localhost", "root", "", "CAR_RENTAL");
if (!$conn) {
  echo "<script>alert('Connection failed.');</script>";
  die("Failed to connect!");
}
?>
