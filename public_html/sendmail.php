<?php

// Configuration
$smtpServer = 'bee.avishost.com';
$port = 587; // use 465 for SSL
$username = 'shei@bee.avishost.com';
$password = 'avis-1300'; // Gmail requires app-specific password
$from = 'shei@bee.avishost.com';
$to = 'sheidarajabi7@gmail.com';
$subject = 'Test Email from PHP SMTP';
$message = "Hello,\r\nThis is a test email sent via raw SMTP in PHP.";

// Prepare headers
$headers = "From: <$from>\r\n";
$headers .= "To: <$to>\r\n";
$headers .= "Subject: $subject\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Connect to SMTP server
$socket = fsockopen($smtpServer, $port, $errno, $errstr, 10);
if (!$socket) {
    die("Failed to connect: $errstr ($errno)\n");
}

// Read server response
function get_response($socket) {
    $data = '';
    while ($str = fgets($socket, 515)) {
        $data .= $str;
        if (substr($str, 3, 1) === ' ') {
            break;
        }
    }
    return $data;
}

function send_command($socket, $cmd, $expect = null) {
    fputs($socket, $cmd . "\r\n");
    $response = get_response($socket);
    if ($expect && strpos($response, $expect) !== 0) {
        die("Unexpected response after command [$cmd]: $response");
    }
    return $response;
}

get_response($socket);
send_command($socket, "EHLO localhost", "250");
send_command($socket, "STARTTLS", "220");

// Enable crypto
stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

// Re-send EHLO after TLS
send_command($socket, "EHLO localhost", "250");

// Auth login
send_command($socket, "AUTH LOGIN", "334");
send_command($socket, base64_encode($username), "334");
send_command($socket, base64_encode($password), "235");

// Mail from / rcpt / data
send_command($socket, "MAIL FROM:<$from>", "250");
send_command($socket, "RCPT TO:<$to>", "250");
send_command($socket, "DATA", "354");

// Send message
fputs($socket, $headers . "\r\n" . $message . "\r\n.\r\n");
$response = get_response($socket);
if (strpos($response, "250") !== 0) {
    die("Failed to send message: $response");
}

// Quit
send_command($socket, "QUIT", "221");

echo "Email sent successfully.\n";
