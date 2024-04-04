<?php
// Function to clear session variables if set
function clearReviewSession() {
    if(isset($_SESSION['dorm_name'])) {
        unset($_SESSION['dorm_name']);
    }
    if(isset($_SESSION['review_text'])) {
        unset($_SESSION['review_text']);
    }
    if(isset($_SESSION['location_rating'])) {
        unset($_SESSION['location_rating']);
    }
    if(isset($_SESSION['conditions_rating'])) {
        unset($_SESSION['conditions_rating']);
    }
    if(isset($_SESSION['utilities_rating'])) {
        unset($_SESSION['utilities_rating']);
    }
}