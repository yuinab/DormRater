<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: user/login.php');
    exit;
}

require_once 'database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $dorm_name = $_SESSION['dorm_name'];
    $location_rating = filter_input(INPUT_POST, 'location_rating', FILTER_VALIDATE_INT);
    $conditions_rating = filter_input(INPUT_POST, 'conditions_rating', FILTER_VALIDATE_INT);
    $utilities_rating = filter_input(INPUT_POST, 'utilities_rating', FILTER_VALIDATE_INT);

    $review_text = isset($_POST['reviewText']) ? htmlspecialchars($_POST['reviewText'], ENT_QUOTES, 'UTF-8') : '';

    // Check if session variables are set to decide whether to insert or update
    if (isset($_SESSION['utilities_rating']) && isset($_SESSION['location_rating']) && isset($_SESSION['conditions_rating'])) {
        // Update the existing entry
        $update_query = "UPDATE reviews SET location_rating = $1, conditions_rating = $2, utilities_rating = $3, review_text = $4 WHERE user_id = $5 AND dorm_name = $6";
        $result = pg_prepare($dbHandle, "update_review", $update_query);
        $result = pg_execute($dbHandle, "update_review", array($location_rating, $conditions_rating, $utilities_rating, $review_text, $user_id, $dorm_name));
    } else {
        // Insert a new entry
        $query = "INSERT INTO reviews (user_id, dorm_name, location_rating, conditions_rating, utilities_rating, review_text) VALUES ($1, $2, $3, $4, $5, $6)";
        $result = pg_prepare($dbHandle, "insert_review", $query);
        $result = pg_execute($dbHandle, "insert_review", array($user_id, $dorm_name, $location_rating, $conditions_rating, $utilities_rating, $review_text));
    }

    if ($result) {
        // Calculate and update average ratings in the dorms table
        $update_avg_query = "UPDATE dorms SET 
            avg_location_rating = (SELECT AVG(location_rating) FROM reviews WHERE dorm_name = $1),
            avg_conditions_rating = (SELECT AVG(conditions_rating) FROM reviews WHERE dorm_name = $1),
            avg_utilities_rating = (SELECT AVG(utilities_rating) FROM reviews WHERE dorm_name = $1),
            avg_rating = ((SELECT AVG(location_rating) FROM reviews WHERE dorm_name = $1) + (SELECT AVG(conditions_rating) FROM reviews WHERE dorm_name = $1) + (SELECT AVG(utilities_rating) FROM reviews WHERE dorm_name = $1)) / 3
            WHERE dorm_name = $1";
        $result_avg = pg_prepare($dbHandle, "update_avg_ratings", $update_avg_query);
        $result_avg = pg_execute($dbHandle, "update_avg_ratings", array($dorm_name));

        if (!$result_avg) {
            echo "Error updating average ratings: " . pg_last_error($dbHandle);
        }

        header("Location: user/myreviews.php");
    } else {
        echo "An error occurred: " . pg_last_error($dbHandle);
    }
} else {
    header('Location: writereview.php');
}
?>
