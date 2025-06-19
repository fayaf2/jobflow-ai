<?php
// forgot_password.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $filePath = 'users.txt';
        
        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            $found = false;
            $password = '';

            while (($line = fgets($file)) !== false) {
                list($storedEmail, $storedPassword) = explode(',', trim($line));
                if ($storedEmail === $email) {
                    $found = true;
                    $password = $storedPassword;
                    break;
                }
            }
            fclose($file);
            
            if ($found) {
                // Send the password via email
                $to = $email;
                $subject = "Your Password";
                $message = "Your password is: " . $password;
                $headers = "From: no-reply@yourdomain.com";

                if (mail($to, $subject, $message, $headers)) {
                    echo "Password sent to your email.";
                } else {
                    echo "Failed to send the email. Please try again.";
                }
            } else {
                echo "Email not found.";
            }
        } else {
            echo "User file not found.";
        }
    } else {
        echo "Invalid email address.";
    }
}
?>
