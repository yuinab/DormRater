<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: user/login.php'); // Adjusted to assume login.php is in the same directory level as submit_review.php
    exit;
}

require_once 'database/db_connect.php'; // Adjust the path according to your project structure

// Check if form data is sent via POST method and session contains user ID
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $user_id = $_SESSION['user_id']; // The logged-in user's ID
    $dorm_name = "Cauthen"; // This could also be dynamic based on form input or another session variable
    $location_rating = filter_input(INPUT_POST, 'location_rating', FILTER_VALIDATE_INT);
    $conditions_rating = filter_input(INPUT_POST, 'conditions_rating', FILTER_VALIDATE_INT);
    $utilities_rating = filter_input(INPUT_POST, 'utilities_rating', FILTER_VALIDATE_INT);

    // Handling possible null value for reviewText
    $review_text = isset($_POST['reviewText']) ? htmlspecialchars($_POST['reviewText'], ENT_QUOTES, 'UTF-8') : '';

    // Prepare and bind
    $query = "INSERT INTO reviews (user_id, dorm_name, location_rating, conditions_rating, utilities_rating, review_text) VALUES ($1, $2, $3, $4, $5, $6)";
    $result = pg_prepare($dbHandle, "insert_review", $query);
    $result = pg_execute($dbHandle, "insert_review", array($user_id, $dorm_name, $location_rating, $conditions_rating, $utilities_rating, $review_text));

    if ($result) {
        echo "Review submitted successfully!";
        // Redirect or display success message
        // Uncomment the below line if you want to redirect after successful submission
        // header('Location: index.php');
    } else {
        echo "An error occurred: " . pg_last_error($dbHandle);
        // Handle error
    }
} else {
    // Redirect to the form if this script is accessed via a GET request
    header('Location: writereview.php'); // Adjust as necessary based on your directory structure
}
?>
