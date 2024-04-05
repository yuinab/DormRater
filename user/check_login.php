<?php
//Author Drew Hollar
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id']) || isset($_SESSION['username'])) {
    // If the user is logged in redirect to the My Reviews page
    header("Location: myreviews.php");
    exit;
} else {
    // If the user is not logged in
    header("Location: login.php");
    exit;
}
?>
