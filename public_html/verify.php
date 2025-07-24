
<?php
include "db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<form method="post">
      <input type="text" name="otp" placeholder="enter the code" required>
      <input type="submit" value="Login">
    </form>

    <?php


if( isset($_GET['id']) and   isset($_POST['otp']) ){


     $sql = "SELECT * FROM `users` WHERE id =".$_GET['id'];

        $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
//echo $row['OTP']; echo $_POST['otp'];
if($_POST['otp'] == $row['OTP']){

echo "OK";
    $sql="UPDATE `users` SET `status` = '1' WHERE `users`.`id`=".$_GET['id'];
     $result = $conn->query($sql);
     if($result){
            header("Location: https://bee.avishost.com");

     }
}else{
    echo "wrong code";
}
      }
    }
    
   // echo ($_GET['id']);
}