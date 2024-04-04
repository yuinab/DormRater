<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--https://cs4640.cs.virginia.edu/ncd6fc/UVADormRater/-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar">
    <title>UVA Dorm Rater</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
            <div class="container-fluid">
                <a class="navbar-brand nav-text" href="index.html">UVA Dorm Rater</a>
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
    <main class="container mt-4 mt-5">
        <h1 class="main-title">
            UVA Dorm Rater
        </h1>

        <p class="welcome-blurb text-center">
            Welcome to UVA Dorm Rater! Rate your experience, read reviews from fellow students, and
            learn more about your future or current home for your studies. Start exploring now!
        </p>

        <form action="search.php" method="get">
        <div class="search-bar mt-5 mb-5">
        <input class="form-control" type="search" name="query" placeholder="Search for a dorm" aria-label="Search">
        </div>
        </form>
        
        <div id="dormAccordion" class="accordion">
            <h2 class="text-center">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#aldermanRoadHallStyle"
                    aria-expanded="false" aria-controls="aldermanRoadHallStyle">
                    Alderman Road Hall-Style
                </button>
            </h2>
            
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/balz-dobie.php">Balz-Dobie</a>
                    </div>
                </div>

                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/cauthen.php">Cauthen</a>
                    </div>
                </div>

                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Gibbons</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Kellogg</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Lile-Maupin</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Shannon</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Tuttle-Dunnington</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Watson-Webb</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Woody</a>
                    </div>
                </div>
            <h2 class="text-center">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#aldermanRoadSuiteStyle"
                    aria-expanded="false" aria-controls="aldermanRoadSuiteStyle">
                    Alderman Road Suite-Style
                </button>
            </h2>

                <div id="aldermanRoadSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Courtenay</a>
                    </div>
                </div>

                <div id="aldermanRoadSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Dunglison</a>
                    </div>
                </div>

                <div id="aldermanRoadSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Fitzhugh</a>
                    </div>
                </div>

            <h2 class="text-center">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#goochdillardSuiteStyle"
                    aria-expanded="false" aria-controls="goochdillardSuiteStyle">
                    Gooch Dillard Suite-Style
                </button>
            </h2>

                <div id="goochdillardSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Dillard</a>
                    </div>
                </div>

                <div id="goochdillardSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Gooch</a>
                    </div>
                </div>

            <h2 class="text-center">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#resedentialColleges"
                    aria-expanded="false" aria-controls="resedentialColleges">
                    Residential Colleges
                </button>
            </h2>
                <div id="resedentialColleges" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Brown</a>
                    </div>
                </div>

                <div id="resedentialColleges" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Hereford</a>
                    </div>
                </div>

                <div id="resedentialColleges" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">International</a>
                    </div>
                </div>

            <h2 class="text-center">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#mccormickroadHallStyle"
                    aria-expanded="false" aria-controls="mccormickroadHallStyle">
                    McCormick Road Hall-Style
                </button>
            </h2>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Bonnycastle</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Dabney</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Echols</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Emmet</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Hancock</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Humphreys</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Kent</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Metcalf</a>
                    </div>
                </div>


                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Lefevre</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="link-to-dorm-review.html">Page</a>
                    </div>
                </div>

                

                
        </div>




    </main>
    <!-- Include Bootstrap JS and its dependencies before the closing body tag -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".search-bar input").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); 
                var query = this.value.trim(); 
                if (query !== "") {
                    window.location.href = "search.php?query=" + encodeURIComponent(query); 
                }
            }
        });
    });
</script>
