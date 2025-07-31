<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";
include "header.php";

if(isset($_POST['name'])){
$sql = "INSERT INTO `food` (`name`, `user_id`) VALUES ( '".$_POST['name']."', ".$_COOKIE['userid'].")";
 $result = $conn->query($sql);
if ($result) {
    echo "food saved successfuly!";
}else{
        echo "Error: " . $conn->error;
}

exit;
}


?>
<html>
<body>

<form action="" method="POST">
Food name: <input type="text" name="name" placeholder="Enter name of food"><br>
<input type="submit">
</form>

</body>
</html>

