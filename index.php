<?php session_start(); 
require_once 'database/db_setup.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--https://cs4640.cs.virginia.edu/ncd6fc/UVADormRater/-->
    <!--Sprint 3:  https://cs4640.cs.virginia.edu/mhc3cm/DormRater/-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Drew Hollar & Yuina Barzdukas">
    <title>UVA Dorm Rater</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary nav-text" style="background-color: #232d4b">
            <div class="container-fluid">
                <a class="navbar-brand nav-text" href="index.php">UVA Dorm Rater</a>
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
                        <a href="dormpages/gibbons.php">Gibbons</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/kellogg.php">Kellogg</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/lile-maupin.php">Lile-Maupin</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/shannon.php">Shannon</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/tuttle-dunnington.php">Tuttle-Dunnington</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/watson-webb.php">Watson-Webb</a>
                    </div>
                </div>
                <div id="aldermanRoadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/woody.php">Woody</a>
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
                        <a href="dormpages/courtenay.php">Courtenay</a>
                    </div>
                </div>

                <div id="aldermanRoadSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/dunglison.php">Dunglison</a>
                    </div>
                </div>

                <div id="aldermanRoadSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/fitzhugh.php">Fitzhugh</a>
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
                        <a href="dormpages/dillard.php">Dillard</a>
                    </div>
                </div>

                <div id="goochdillardSuiteStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/gooch.php">Gooch</a>
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
                        <a href="dormpages/brown.php">Brown</a>
                    </div>
                </div>

                <div id="resedentialColleges" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/hereford.php">Hereford</a>
                    </div>
                </div>

                <div id="resedentialColleges" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/international.php">International</a>
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
                        <a href="dormpages/bonnycastle.php">Bonnycastle</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/dabney.php">Dabney</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/echols.php">Echols</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/emmet.php">Emmet</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/hancock.php">Hancock</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/humphreys.php">Humphreys</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/kent.php">Kent</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/metcalf.php">Metcalf</a>
                    </div>
                </div>


                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/lefevre.php">Lefevre</a>
                    </div>
                </div>

                <div id="mccormickroadHallStyle" class="collapse" aria-labelledby="headingOne" data-parent="#dormAccordion">
                    <div class="card-body dorm-card">
                        <a href="dormpages/page.php">Page</a>
                    </div>
                </div>

                

                
        </div>




    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Dynamic behavior that does error messages so client-side input validation also uses AJAX-->
    <!-- also uses an object-->
    <!-- also has at least one anonymous function-->
    <script>
// defines the Dorm class
class Dorm {
    constructor(dormData) {
        this.id = dormData.dorm_id;
        this.name = dormData.dorm_name;
        this.averageRating = dormData.avg_rating;
    }

    createDormElement() {
        const dormElement = document.createElement('div');
        dormElement.className = 'dorm-result';
        dormElement.innerHTML = `
            <h3>${this.name}</h3>
            <p>Average Rating: ${this.averageRating}</p>
        `;
        return dormElement;
    }
}

//Anonymous function
document.addEventListener("DOMContentLoaded", function() {
    const searchForm = document.querySelector("form[action='search.php']");
    const searchBar = document.querySelector(".search-bar input");
    const resultsContainer = document.getElementById('dormAccordion');

    searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const query = searchBar.value.trim();

        if (query !== "") {
            fetch('search.php?query=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = ''; // clear results from earlier

                    if(data.message) {
                        resultsContainer.innerHTML = `<p>${data.message}</p>`; // if no dorms are found
                    } else {
                        const uniqueDorms = new Map(); // this map lets only one rating per unique dorm pop up

                        data.forEach(dormData => {
                            if(!uniqueDorms.has(dormData.dorm_name)) {
                                uniqueDorms.set(dormData.dorm_name, true);

                                // use the new dorm OBJECT
                                const dorm = new Dorm(dormData);
                                // append the dom element
                                resultsContainer.appendChild(dorm.createDormElement());
                            }
                        });
                    }
                })
                // debugging for when things mess up
                .catch(error => {
                    console.error('Error fetching search results:', error);
                    resultsContainer.innerHTML = `<p>Error fetching search results.</p>`;
                });
        } else {
            if (!document.querySelector('.search-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('search-error', 'text-danger');
                errorDiv.textContent = "Please enter a dorm name to search.";
                searchBar.parentNode.appendChild(errorDiv);
            }
        }
    });

    searchBar.addEventListener("input", function() {
        const errorDiv = document.querySelector('.search-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    });
});
</script>


</body>

</html>