<?php

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'stephensouth1307@example.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set the receiving email address
$contact->to = $receiving_email_address;

// Validate and set the sender's name and email
if (isset($_POST['name']) && isset($_POST['email'])) {
    $contact->from_name = htmlspecialchars($_POST['name']);
    $contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
} else {
    die('Name and email are required.');
}

// Set the email subject
$contact->subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'No Subject';

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
);
*/

// Add messages to the email
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message(isset($_POST['message']) ? htmlspecialchars($_POST['message']) : 'No message', 'Message', 10);

// Send the email and echo the result
echo $contact->send();
?>
