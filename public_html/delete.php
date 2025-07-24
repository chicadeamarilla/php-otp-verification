<?php
include "db.php";


 $sql ="DELETE FROM jarden WHERE `jarden`.`id`=" . $_GET['id'] ; 
    $result = $conn->query($sql);
    header("Location: https://bee.avishost.com");

?>

