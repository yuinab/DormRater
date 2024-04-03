<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Yuina Barzdukas">
    <title>Cauthen Reviews</title>
    <link rel="stylesheet" href="dormpages/dorm_styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>

<body>
<?php session_start(); ?>
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
                <?php if(isset($_SESSION['username'])): ?>
                <span class="btn nav-btn" style="margin-right: 12px; color: #e57200;">Hello,
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <a href="user/logout.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Log
                    Out</a>
                <?php else: ?>
                <a href="user/login.php" class="btn nav-btn" style="background-color: #e57200; margin-right: 12px;">Log
                    In</a>
                <a href="user/signup.php" class="btn nav-btn" style="margin-right: 12px; background-color: #e57200">Sign
                    Up</a>
                <?php endif; ?>
                <a href="user/check_login.php" class="btn nav-btn"
                    style="background-color: #e57200; margin-right: 12px;">My Reviews</a>
            </form>
        </div>
    </nav>
</header>
    <main class="container mt-4 mt-5">
        <h1 class="main-title">
            My Reviews
        </h1>

        <div class="row row-cols-1 row-cols-md-2 g-2 mt-5">
            <button type="button"  class="btn" data-bs-toggle="button">
                <i class="bi-trash"></i>
            </button>
            <a class="btn" href="writereview.html" role="button"><i class="bi-pencil-square"></i></a>
            <div class="card mt-3" style="width: 100rem;">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <h5 class="card-title mb-0">
                          Cauthen 2023-2024
                      </h5>
                      <span class="ml-auto review-ratings">
                          <i class="bi-star-fill"></i>
                          <p style="margin-right: 20px; margin-left: 2px;">3.33</p>
                          <i class="bi-pin-map"></i>
                          <p style="margin-right: 20px; margin-left: 2px;">5</p>
                          <i class="bi-lungs"></i>
                          <p style="margin-right: 20px; margin-left: 2px;">2</p>
                          <i class="bi-house-gear"></i>
                          <p>3</p>
                      </span>
                  </div>
                  <p class="card-text">Dirty and it gave me black mold poisoning.</p>
                  <button type="button" class="btn" data-bs-toggle="button">
                    <i class="bi-hand-thumbs-up"></i>
                    <span class="count">0</span>
                </button>
                <button type="button" class="btn" data-bs-toggle="button">
                    <i class="bi-hand-thumbs-down"></i>
                    <span class="count">0</span>
                </button>
              </div>
          </div>
</body>