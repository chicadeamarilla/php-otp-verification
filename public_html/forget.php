<?php
include "db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "header.php";
?>

<form method="post">
      <input type="text" name="Email" placeholder="enter your email" required>
      <input type="submit" value="Login">   
</form>

    <?php
if(isset($_POST['Email'])){
           $sql = "SELECT * FROM `users` WHERE Email  ='".$_POST['Email']."'";
      //     echo $sql;
        //   exit;
        $result = $conn->query($sql); 

    if ($result && $result->num_rows > 0) {
              $otp = mt_rand(1000, 9999);

        $sql="UPDATE `users` SET `OTP` = " .  $otp . " WHERE `users`.`email`='".$_POST['Email']."'";
     //   echo $sql;
      //  exit;
        $result = $conn->query($sql);

      sendmail($_POST['Email'] , 'Verification code' , "your otp code is:". $otp );
       setcookie("resetpass",( $_POST['Email'] ), time() + (86400 * 5), "/");
            header("Location: https://bee.avishost.com/resetPassword.php");


}else{
      echo "user Email not found ";
}

}
    
