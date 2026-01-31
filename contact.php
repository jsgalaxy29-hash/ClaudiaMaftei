<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

if (!empty($_POST['website'] ?? '')) {
    http_response_code(200);
    exit('OK');
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.html#contact?error=1');
    exit;
}

$serverName = $_SERVER['SERVER_NAME'] ?? 'example.com';
$from = 'no-reply@' . $serverName;

$subject = 'Nouveau message depuis le site Claudia Maftei';
$body = "Nom : {$name}\n";
$body .= "Email : {$email}\n\n";
$body .= "Message :\n{$message}\n";

$headers = [];
$headers[] = 'From: ' . $from;
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$sent = mail('claudia.segallen@gmail.com', $subject, $body, implode("\r\n", $headers));

if ($sent) {
    header('Location: index.html#contact?sent=1');
    exit;
}

header('Location: index.html#contact?error=1');
exit;
