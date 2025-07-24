<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";

print_r($_POST);

if($_GET['type']=='login'){

$sql = "SELECT username, password,id,rules  FROM users where username='" . $_POST['username'] . "'";
$result = $conn->query($sql);

//print_r($result);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {

    if ($row['password'] == $_POST['password']) {
      echo "LOGIN OK";
      setcookie("beedata", $row['username'], time() + (86400 * 5), "/"); // Expires in 30 days
      setcookie("userid", $row['id'], time() + (86400 * 5), "/"); // Expires in 30 days
      setcookie("rules", $row['rules'], time() + (86400 * 5), "/"); // Expires in 30 days
      header("Location: https://bee.avishost.com");
      exit;
    } else {
    header("Location: https://bee.avishost.com?msg=wrong data..");
      exit;
      
    }
  }
  
}else{
     header("Location: https://bee.avishost.com?msg=wrong data..");
      exit;
}
  
  

} else {



    $otp = mt_rand(1000, 9999);

  sendmail($_POST['email'],"Your verification code is: ", $otp);  

  $sql = "INSERT INTO users (username, password,email,OTP) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', '" . $_POST['email'] . "','".$otp."')";


 

  if ($conn->query($sql) === TRUE) {
    $inserted_id = $conn->insert_id;
      header("Location: https://bee.avishost.com/verify.php?id=".$inserted_id);
      exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

exit();
