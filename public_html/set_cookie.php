<?php
include "db.php";
include "header.php";
?>
<!DOCTYPE html>
<html>
<body>
    <h2>enter your name:</h2>
    <form action="set_cookie.php" method="post">
        <input type="text" name="username" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    setcookie("username", $name, time() + 3600);
    header("Location: get_cookie.php");
    exit();
}
?>