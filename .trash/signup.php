<?php
$usersFile = 'users.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        echo "Username and password are required.";
    } else {
        $userExists = false;

        if (file_exists($usersFile)) {
            $lines = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($existingUser) = explode('|', $line);
                if ($existingUser === $username) {
                    $userExists = true;
                    break;
                }
            }
        }

        if ($userExists) {
            echo "Username already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $status = "active"; // CHANGE to 'active' so login works
            file_put_contents($usersFile, "$username|$hashedPassword|$status\n", FILE_APPEND);
            echo "Account created. You can now <a href='login.php'>log in</a>.";
        }
    }
}
?>

<h2>Sign Up</h2>
<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Sign Up">
</form>