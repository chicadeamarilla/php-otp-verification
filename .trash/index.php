<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dummy credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "password") {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: flower_form.php");
        exit;
    } else {
        echo "Invalid login.";
    }
}
?>

<form method="post">
    <label for="username">Username:</label><br>
    <input type="text" name="username"><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Login">
    <a href='signup.php' > sign up </a>

</form>