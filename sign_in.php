<?php
session_start(); // Start the session
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if you downloaded PHPMailer manually

// File path
$filePath = 'users.txt';

// Get form input
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Read users from file
if (file_exists($filePath)) {
    $fileContents = file_get_contents($filePath);
    $users = explode("\n", trim($fileContents));
    
    foreach ($users as $user) {
        list($storedEmail, $hashedPassword, $storedName) = explode("|", $user);
        if ($storedEmail === $email) {
            if (password_verify($password, $hashedPassword)) {
                // Store user info in session
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $storedName;

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
                    $mail->Subject = 'Sign In Successful';
                    $mail->Body    = 'Hello,<br>You have successfully signed in.';
                    $mail->AltBody = 'Hello, You have successfully signed in.';

                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
                // Redirect to chatbot page with query parameters
                header('Location: chatbot.html?email=' . urlencode($email) . '&name=' . urlencode($storedName));
                exit;
            } else {
                echo 'Invalid password.';
                exit;
            }
        }
    }
}
echo 'Email not registered.';
?>
