<?php 
//Authors: Drew Hollar & Yuina Barzdukas
session_start(); 
require '../unset_sessions.php';
clearReviewSession();
require_once '../database/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM reviews WHERE user_id = $1 ORDER BY created_at DESC";
$result = pg_prepare($dbHandle, "fetch_reviews", $query);
$result = pg_execute($dbHandle, "fetch_reviews", array($user_id));

$_SESSION['dorm_name'] = '';
$_SESSION['review_text'] = '';
$_SESSION['location_rating'] = '';
$_SESSION['conditions_rating'] = '';
$_SESSION['utilities_rating'] = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Yuina Barzdukas">
    <title>Cauthen Reviews</title>
    <link rel="stylesheet" href="../dormpages/dorm_styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand nav-text" href="../index.php">UVA Dorm Rater</a>
                    <form action="../search.php" method="get">
                        <div class="search-bar" style="width: 700px;">
                        <input class="form-control" type="search" name="query" placeholder="Search for a dorm" aria-label="Search">
                    </div>
                    </form>
                </div>
                <form class="d-flex" role="search">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <span class="btn nav-btn" style="margin-right: 12px; color: #e57200;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="logout.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Log Out</a>
                    <?php else : ?>
                        <a href="login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">Log In</a>
                        <a href="signup.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Sign Up</a>
                    <?php endif; ?>
                    <a href="check_login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">My Reviews</a>
                </form>
            </div>
        </nav>
    </header>
    <main class="container mt-4 mt-5">
        <h1 class="main-title">
            My Reviews
        </h1>

        <?php
        if (pg_num_rows($result) > 0) {
            while ($review = pg_fetch_assoc($result)) {

                $review_dorm= $review['dorm_name'];
                $review_date = new DateTime($review['created_at']);
                $review_date_formatted = $review_date->format('F j, Y');
                $review_id = $review['review_id'];
                echo "<div class='card mt-3' style='max-width: 100%;'>";
                echo "<div class='card-body'>";
                
                // Buttons for deleting and editing reviews
                echo "<div class='d-flex align-items-center mb-3'>";
                echo "<form action='delete_review.php' method='post'>";
                echo "<input type='hidden' name='review_id' value='{$review['review_id']}'>";
                echo "<button type='submit' class='btn' name='delete_review'>";
                echo "<i class='bi-trash'></i>";
                echo "</button>";
                echo "</form>";
                echo "<a class='btn' href='../writereview.php?review_id=" . $review_id . "' role='button'><i class='bi-pencil-square'></i></a>";
                echo "</div>";

                // Review details
                echo "<div class='d-flex align-items-center'>";
                echo "<h5 class='card-title mb-0'>{$review_dorm} - {$review_date_formatted} </h5>";
                echo "<span class='ml-auto review-ratings'>";
                echo "<i class='bi-star-fill'></i>";
                echo "<p style='margin-right: 20px; margin-left: 2px;'>" . round(($review['location_rating'] + $review['conditions_rating'] + $review['utilities_rating']) / 3, 2) . "</p>";
                echo "<i class='bi-pin-map'></i>";
                echo "<p style='margin-right: 20px; margin-left: 2px;'>{$review['location_rating']}</p>";
                echo "<i class='bi-lungs'></i>";
                echo "<p style='margin-right: 20px; margin-left: 2px;'>{$review['conditions_rating']}</p>";
                echo "<i class='bi-house-gear'></i>";
                echo "<p>{$review['utilities_rating']}</p>";
                echo "</span>";
                echo "</div>";

                // Review text
                echo "<p class='card-text'>" . htmlspecialchars($review['review_text']) . "</p>";
                
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='card mt-3' style='width: 100%;'>";
            echo "<div class='card-body'>";
            echo "<h4 class='no-reviews'>No Reviews Yet</h4>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </main>
</body>

</html>
