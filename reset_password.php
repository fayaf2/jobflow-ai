<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    if (empty($token) || empty($newPassword)) {
        echo "Invalid request.";
        exit;
    }

    // Validate token
    $tokens = file('reset_tokens.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $validToken = false;
    $email = '';

    foreach ($tokens as $record) {
        list($storedEmail, $storedToken, $expiry) = explode('|', $record);
        if ($storedToken === $token && time() < $expiry) {
            $validToken = true;
            $email = $storedEmail;
            break;
        }
    }

    if (!$validToken) {
        echo "Invalid or expired token.";
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the user's password
    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updatedUsers = [];
    foreach ($users as $user) {
        list($storedEmail, $storedHash) = explode('|', $user);
        if ($storedEmail === $email) {
            $updatedUsers[] = "$email|$hashedPassword";
        } else {
            $updatedUsers[] = $user;
        }
    }
    file_put_contents('users.txt', implode("\n", $updatedUsers));

    // Remove used token
    $tokens = array_filter($tokens, function($record) use ($token) {
        return !str_contains($record, $token);
    });
    file_put_contents('reset_tokens.txt', implode("\n", $tokens));

    echo "Password has been reset successfully.";
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            #formContainer {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 300px;
            }
            input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #e0e0e0;
                border-radius: 4px;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div id="formContainer">
            <h2>Reset Password</h2>
            <form action="reset_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="password" name="password" placeholder="Enter new password" required>
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </body>
    </html>

    <?php
}
?>
