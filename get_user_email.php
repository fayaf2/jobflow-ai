<?php
session_start(); // Start the session

if (isset($_SESSION['user_email'])) {
    echo $_SESSION['user_email'];
} else {
    echo 'No user email found.';
}
?>
