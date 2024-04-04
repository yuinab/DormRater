<?php
if (isset($_POST['delete_review']) && isset($_POST['review_id'])) {
    require_once '../database/db_connect.php';

    $review_id = $_POST['review_id'];

    $query = "DELETE FROM reviews WHERE review_id = $1";
    $result = pg_prepare($dbHandle, "delete_review", $query);
    $result = pg_execute($dbHandle, "delete_review", array($review_id));

    if ($result) {
        header('Location: myreviews.php'); 
        exit;
    } else {
        echo "Failed to delete review.";
    }
}
?>