<?php
$CONTACT_TO = 'claudia.segalen@gmail.com';
$CONTACT_SUBJECT_PREFIX = '[Site Claudia] ';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$redirectBase = 'index.html?status=';
$redirectAnchor = '#contact';

if (!empty($_POST['website'] ?? '')) {
    header('Location: ' . $redirectBase . 'spam' . $redirectAnchor);
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$maxNameLength = 100;
$maxEmailLength = 254;
$maxMessageLength = 2000;

if (
    $name === '' ||
    $message === '' ||
    $email === '' ||
    strlen($name) > $maxNameLength ||
    strlen($email) > $maxEmailLength ||
    strlen($message) > $maxMessageLength ||
    preg_match('/[\r\n]/', $email) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    header('Location: ' . $redirectBase . 'invalid' . $redirectAnchor);
    exit;
}

$serverName = $_SERVER['SERVER_NAME'] ?? 'example.com';
$from = 'no-reply@' . $serverName;

$subject = $CONTACT_SUBJECT_PREFIX . 'Nouveau message depuis le site';
$body = "Nom : {$name}\n";
$body .= "Email : {$email}\n\n";
$body .= "Message :\n{$message}\n";

$headers = [];
$headers[] = 'From: ' . $from;
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$sent = mail($CONTACT_TO, $subject, $body, implode("\r\n", $headers));

if ($sent) {
    header('Location: ' . $redirectBase . 'success' . $redirectAnchor);
    exit;
}

header('Location: ' . $redirectBase . 'error' . $redirectAnchor);
exit;
