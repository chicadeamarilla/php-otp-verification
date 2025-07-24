<html>
<body>


<?php

include "db.php";
if ($_POST ) {
  //  print_r($_POST);
    $sql = "INSERT INTO `jarden` (`id`, `name`, `breed_id`, `user_id`, `description`) VALUES (NULL, '".$_POST['name']."', ".$_POST['breed'].",".$_COOKIE['userid'].",'" .$_POST['description']."')";
   $result = $conn->query($sql);
   if ($result) {
    echo "Query successful!";
    header("Location: https://bee.avishost.com");

} else {
    echo "Error: " . $conn->error;
}
}
$breed_list = []; // blank array
    
    $sql = "SELECT * FROM breed";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $breed_list[$row['id']] = $row['name'];
      }
    }
    
//print_r($breed_list);
?>
<form method="POST">
Name: <input type="text" name="name"><br>
Breed:  <select name="breed">
    <?php foreach($breed_list as $key=>$breed){ ?>
    <option value="<?= $key ?>"><?= $breed  ?></option>
    <?php } ?>
  </select>
      description: <input type="text" name="description"><br>

<input type="submit">
</body>

</html>
    
