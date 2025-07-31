<form method="post" action="">
      <input type="text" name="otp" placeholder="enter otp" required> <br>
      <input type="password" name="new_password" placeholder="type new Password" required><br>
      <input type="password" name="repeat_password" placeholder="repeat new Password" required>

      <input type="submit" value="Login">
</form>

<?php

include "db.php";
include "header.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['otp']) and  isset($_POST['new_password']) and isset($_POST['repeat_password'])){
$sql = " SELECT * FROM `users` WHERE `users`.`email`='" . $_COOKIE['resetpass'] . "'";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
           // echo $row['OTP'];
            if ($row['OTP'] == $_POST['otp'] and $_POST['new_password'] == $_POST['repeat_password']) {
                  $sql = "UPDATE `users` SET `password` = " . $_POST['repeat_password'] . " WHERE `users`.`email`='" . $_COOKIE['resetpass'] . "'";
                  $result = $conn->query($sql);
                  echo "your password was changed ";
                  exit();
            } else {
                  echo "somting get wrong ...";
            }
            
      }
}
}


?>