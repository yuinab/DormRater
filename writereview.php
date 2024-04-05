<?php
//Author: Drew Hollar & Yuina Barzdukas
session_start();
require_once 'database/db_connect.php'; 

$review_id = isset($_GET['review_id']) ? $_GET['review_id'] : null;

if ($review_id) {
    $query = "SELECT * FROM reviews WHERE review_id = $1";
    $result = pg_prepare($dbHandle, "fetch_review", $query);
    
    $result = pg_execute($dbHandle, "fetch_review", array($review_id));
    
    if ($result && pg_num_rows($result) > 0) {
        $review = pg_fetch_assoc($result);
        
        $_SESSION['dorm_name'] = $review['dorm_name'];
        $reviewText= $review['review_text'];
        $utilitiesRating = $review['utilities_rating'];
        $locationRating = $review['location_rating'];
        $conditionsRating = $review['conditions_rating'];
    } 
}
else {
    $reviewText="";
    $utilitiesRating = 0;
    $locationRating = 0;
    $conditionsRating = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar">
    <title>Write Review</title>
    <link rel="stylesheet" href="writereview_styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
 
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center"> 
                <a class="navbar-brand nav-text" href="index.php" >UVA Dorm Rater</a>
                <form action="search.php" method="get">
                        <div class="search-bar" style="width: 700px;">
                        <input class="form-control" type="search" name="query" placeholder="Search for a dorm" aria-label="Search">
                    </div>
                    </form>
            </div>
            <form class="d-flex" role="search">
                    <?php if(isset($_SESSION['username'])): ?>
                        <span class="btn nav-btn" style="margin-right: 12px; color: #e57200;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="user/logout.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Log Out</a>
                    <?php else: ?>
                        <a href="user/login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">Log In</a>
                        <a href="user/signup.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Sign Up</a>
                    <?php endif; ?>
                    <a href="user/check_login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">My Reviews</a>
                </form>
        </div>
    </nav>
    </header>
    <main class="container mt-5">
        <h1 class="text-center mb-4">Your review for <?php echo htmlspecialchars($_SESSION['dorm_name']); ?></h1>
        <form id="reviewForm" action="submit_review.php" method="post">
            <!-- Location Rating -->
            <div class="form-group mb-4" data-rating-type="location">
                <label class="star-rating-label">Location</label>
                <div class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?php echo ($i <= $locationRating) ? '-fill' : ''; ?>" data-rating="<?php echo $i; ?>"></i>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="location_rating" value="<?php echo $review['location_rating']; ?>">
            </div>
            
            <!-- Conditions Rating -->
            <div class="form-group mb-4" data-rating-type="conditions">
                <label class="star-rating-label">Conditions</label>
                <div class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?php echo ($i <= $conditionsRating) ? '-fill' : ''; ?>" data-rating="<?php echo $i; ?>"></i>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="conditions_rating" value="<?php echo $conditionsRating; ?>">
            </div>
            
            <!-- Utilities Rating -->
            <div class="form-group mb-4" data-rating-type="utilities">
                <label class="star-rating-label">Utilities</label>
                <div class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?php echo ($i <= $utilitiesRating) ? '-fill' : ''; ?>" data-rating="<?php echo $i; ?>"></i>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="utilities_rating" value="<?php echo $utilitiesRating; ?>">
            </div>
            
            <!-- Review Text -->
            <div class="form-group mb-4">
                <label for="reviewText">Write your review</label>
                <textarea class="form-control" id="reviewText" name="reviewText" rows="5"><?php echo $reviewText; ?></textarea>
            </div>
            
            <button type="submit" class="btn submit-btn" style="background-color: #e57200">Submit</button>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let stars = document.querySelectorAll('.star-rating .bi');
            stars.forEach(star => {
                star.addEventListener('click', setRating);
            });

            function setRating(event) {
                let span = event.currentTarget;
                let stars = span.parentNode.querySelectorAll('.bi');
                let match = false;
                stars.forEach(star => {
                    if (match) {
                        star.classList.remove('bi-star-fill');
                        star.classList.add('bi-star');
                    } else {
                        star.classList.add('bi-star-fill');
                        star.classList.remove('bi-star');
                    }
                    if (star === span) {
                        match = true;
                    }
                });
                // Set the value of the hidden input to the rating
                let ratingValue = span.dataset.rating;
                let ratingType = span.closest('.form-group').getAttribute('data-rating-type');
                document.querySelector(`input[name='${ratingType}_rating']`).value = ratingValue;
            }
        });
    </script>
</body>
</html>
