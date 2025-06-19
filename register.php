<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if you downloaded PHPMailer manually

// File path
$filePath = 'users.txt';

// Get form input
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Check if the file exists and if user already exists
if (file_exists($filePath)) {
    $fileContents = file_get_contents($filePath);
    $users = explode("\n", trim($fileContents));
    
    foreach ($users as $user) {
        list($storedEmail) = explode("|", $user);
        if ($storedEmail === $email) {
            echo 'Email already registered.';
            exit;
        }
    }
}

// Hash the password and save the new user
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$newUser = $email . "|" . $hashedPassword . "\n";
file_put_contents($filePath, $newUser, FILE_APPEND | LOCK_EX);

// Send confirmation email
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.sjftech.co'; // Set the SMTP server to send through
    $mail->SMTPAuth = true;
    $mail->Username = 'info@sjftech.co'; // SMTP username
    $mail->Password = 'TWp.rmm)p%€3'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('info@sjftech.co', 'SJF Tech');
    $mail->addAddress($email); // Add recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Account Created Successfully';
    $mail->Body    = 'Hello,<br>Your account has been created successfully.';
    $mail->AltBody = 'Hello, Your account has been created successfully.';

    $mail->send();
    echo 'Account created successfully. A confirmation email has been sent to your address.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
