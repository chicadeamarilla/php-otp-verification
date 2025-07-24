<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = rand(1000, 9999); // Generate 4-digit OTP
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $_POST['email'];

    // Simulate sending email
    echo "OTP sent to " . htmlspecialchars($_POST['email']) . ": <b>$otp</b>";
    echo "<br><a href='otp.php?step=verify'>Go to OTP Verification</a>";
    exit;
}

if (isset($_GET['step']) && $_GET['step'] == 'verify') {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['code'])) {
        if ($_POST['code'] == $_SESSION['otp']) {
            echo " OTP Verified!";
        } else {
            echo " Incorrect OTP!";
        }
        exit;
    }
    ?>
    <form method="post">
        Enter OTP: <input type="text" name="code" required>
        <input type="submit" value="Verify">
    </form>
    <?php
    exit;
}
?>

<form method="post">
    Enter your email: <input type="email" name="email" required>
    <input type="submit" value="Send OTP">
</form>
