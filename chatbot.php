<?php
session_start(); // Start the session

if (!isset($_SESSION['user_email'])) {
    header('Location: sign_in.html'); // Redirect to sign-in page if not logged in
    exit;
}

$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Chatbot</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to the Job Chatbot</h1>
        <p>User Email: <?php echo htmlspecialchars($user_email); ?></p>
    </header>
    <main>
        <div id="chatbot">
            <div id="chatbox">
                <!-- Chat messages will appear here -->
            </div>
            <input type="text" id="user-input" placeholder="Type your message...">
            <button id="send-button">Send</button>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#send-button').click(function() {
                var userInput = $('#user-input').val();
                if (userInput) {
                    $('#chatbox').append('<div>User: ' + userInput + '</div>');
                    $('#user-input').val('');
                    
                    // Process user input with chatbot API or logic
                    // For demonstration, we'll just echo the input
                    $('#chatbox').append('<div>Chatbot: ' + userInput + '</div>');
                }
            });
        });
    </script>
</body>
</html>
