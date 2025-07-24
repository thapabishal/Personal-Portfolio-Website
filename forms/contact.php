<?php

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo "405 Method Not Allowed";
  exit;
}

// Sanitize and validate input
$name    = strip_tags(trim($_POST["name"] ?? ""));
$email   = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST["subject"] ?? ""));
$message = trim($_POST["message"] ?? "");

// Check required fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
  http_response_code(400);
  echo "Please fill in all required fields.";
  exit;
}

// Email setup
$to = "bishal.datascience@gmail.com"; // Change to your actual email
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

$body = "From: $name\n";
$body .= "Email: $email\n\n";
$body .= "Message:\n$message\n";

// Send email
if (mail($to, $subject, $body, $headers)) {
  echo "OK";
} else {
  http_response_code(500);
  echo "Something went wrong. Message not sent.";
}
?>
