<?php
    session_start();
    require '../unset_sessions.php';
    clearReviewSession();
    require_once '../database/db_connect.php';
    //Change session to Balz-Dobie
    $_SESSION['dorm_name'] = 'Balz-Dobie';
    // calculating averages
    $total_ratings = 0;
    $total_location = 0;
    $total_conditions = 0;
    $total_utilities = 0;
    $review_count = 0;

    // reviews for Balz-Dobie from the database
    $dorm_name = 'Balz-Dobie'; // name of the dorm for which to fetch review, change on each site
    $query = "SELECT * FROM reviews WHERE dorm_name = $1 ORDER BY created_at DESC";
    $result = pg_prepare($dbHandle, "fetch_reviews", $query);
    $result = pg_execute($dbHandle, "fetch_reviews", array($dorm_name));

    // averages if there are reviews
    if ($result && pg_num_rows($result) > 0) {
        while ($review = pg_fetch_assoc($result)) {
            $total_location += (int)$review['location_rating'];
            $total_conditions += (int)$review['conditions_rating'];
            $total_utilities += (int)$review['utilities_rating'];
            $review_count++;
        }

        // Reset the pointer to the first result
        pg_result_seek($result, 0);

        $average_location = $total_location / $review_count;
        $average_conditions = $total_conditions / $review_count;
        $average_utilities = $total_utilities / $review_count;
        $average_rating = ($average_location + $average_conditions + $average_utilities) / 3;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Yuina Barzdukas">
    <title>Balz-Dobie Reviews</title>
    <link rel="stylesheet" href="dorm_styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand nav-text" href="../index.php">UVA Dorm Rater</a>
                    <div class="search-bar" style="width: 700px;">
                        <input class="form-control" type="search" placeholder="Search for a dorm" aria-label="Search">
                    </div>
                </div>
                <form class="d-flex" role="search">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <span class="btn nav-btn" style="margin-right: 12px; color: #e57200;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="../user/logout.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Log Out</a>
                    <?php else : ?>
                        <a href="../user/login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">Log In</a>
                        <a href="../user/signup.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Sign Up</a>
                    <?php endif; ?>
                    <a href="../user/check_login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">My Reviews</a>
                </form>
            </div>
        </nav>
    </header>
    <main class="container mt-4 mt-5">
        <h1 class="main-title">
        Balz-Dobie
        </h1>

        <div class="row row-cols-1 row-cols-md-2 g-2 mt-5">
            <div class="col offset-md-3 pb-3">
                <div class="card text-center mb-3 h-100" style="max-width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi-star-fill"></i>
                            <?php echo ($review_count > 0) ? round($average_rating, 2) : '-'; ?>
                        </h5>
                        <p class="card-text"><?php echo ($review_count > 0) ? $review_count : '-'; ?> Review<?php echo ($review_count !== 1 && $review_count > 0) ? 's' : ''; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-3">
                <div class="card text-center mb-3 h-100" style="max-width: 15rem;">
                    <div class="card-body">
                        <p class="card-text mx-3">
                            <i class="bi-pin-map"></i>
                            Location
                            <b><?php echo ($review_count > 0) ? round($average_location, 2) : '-'; ?></b>
                        </p>
                        <p class="card-text mx-3">
                            <i class="bi-lungs"></i>
                            Conditions
                            <b><?php echo ($review_count > 0) ? round($average_conditions, 2) : '-'; ?></b>
                        </p>
                        <p class="card-text mx-3">
                            <i class="bi-house-gear"></i>
                            Utilities
                            <b><?php echo ($review_count > 0) ? round($average_utilities, 2) : '-'; ?></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
                <h2 class="d-inline-block mr-3">Reviews</h2>
                <a href="../writereview.php" class="btn nav-btn" style="background-color: #e57200">Add your review!</a>
            </div>

        <?php
if ($result) {
    if ($review_count > 0) {
        while ($review = pg_fetch_assoc($result)) {
            $review_date = new DateTime($review['created_at']);
            $review_date_formatted = $review_date->format('F j, Y');
            echo "<div class='card mt-3' style='max-width: 100%;'>";
            echo "<div class='card-body'>";
            echo "<div class='d-flex align-items-center'>";
            echo "<h5 class='card-title mb-0'>{$review_date_formatted}</h5>"; // Formatted date
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
            echo "<p class='card-text text-left'>" . htmlspecialchars($review['review_text']) . "</p>"; // Left-align review text
            // Add buttons for likes and dislikes if you have that functionality
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='card mt-3' style='width: 100%;'>"; // Changed 100rem to 100% to fit the container
        echo "<div class='card-body'>";
        echo "<h4 class='no-reviews'>No Reviews Yet</h4>";
        echo "</div>";
        echo "</div>";
    }
}
?>
    </main>

</body>

</html>
