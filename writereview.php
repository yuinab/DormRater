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
    <?php session_start(); ?>
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center"> 
                <a class="navbar-brand nav-text" href="index.html" >UVA Dorm Rater</a>
                <div class="search-bar" style="width: 700px;">
                    <input class="form-control" type="search" placeholder="Search for a dorm" aria-label="Search">
                </div>
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
        <h1 class="text-center mb-4">Your review for Cauthen</h1>
        <form id="reviewForm" action="submit_review.php" method="post">
            <input type="hidden" name="location_rating" value="0">
            <input type="hidden" name="conditions_rating" value="0">
            <input type="hidden" name="utilities_rating" value="0">

            <!-- Location Rating -->
            <div class="form-group mb-4" data-rating-type="location">
                <label class="star-rating-label">Location</label>
                <div class="star-rating">
                    <i class="bi bi-star" data-rating="1"></i>
                    <i class="bi bi-star" data-rating="2"></i>
                    <i class="bi bi-star" data-rating="3"></i>
                    <i class="bi bi-star" data-rating="4"></i>
                    <i class="bi bi-star" data-rating="5"></i>
                </div>
            </div>
            
            <!-- Conditions Rating -->
            <div class="form-group mb-4" data-rating-type="conditions">
                <label class="star-rating-label">Conditions</label>
                <div class="star-rating">
                    <i class="bi bi-star" data-rating="1"></i>
                    <i class="bi bi-star" data-rating="2"></i>
                    <i class="bi bi-star" data-rating="3"></i>
                    <i class="bi bi-star" data-rating="4"></i>
                    <i class="bi bi-star" data-rating="5"></i>
                </div>
            </div>
            
            <!-- Utilities Rating -->
            <div class="form-group mb-4" data-rating-type="utilities">
                <label class="star-rating-label">Utilities</label>
                <div class="star-rating">
                    <i class="bi bi-star" data-rating="1"></i>
                    <i class="bi bi-star" data-rating="2"></i>
                    <i class="bi bi-star" data-rating="3"></i>
                    <i class="bi bi-star" data-rating="4"></i>
                    <i class="bi bi-star" data-rating="5"></i>
                </div>
            </div>
            
            <!-- Review Text -->
            <div class="form-group mb-4">
                <label for="reviewText">Write your review</label>
                <textarea class="form-control" id="reviewText" name="reviewText" rows="5"></textarea>
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
