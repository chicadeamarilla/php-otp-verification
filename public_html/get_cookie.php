<?php
include "db.php";
include "header.php";
?>
<?php
$name = isset($_COOKIE["username"]) ? $_COOKIE["username"] : "Guest";
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Hello, <?php echo htmlspecialchars($name); ?>!</h2>
    <a href="set_cookie.php">Back</a>
</body>
</html>