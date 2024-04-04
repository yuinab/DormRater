<?php
// List of dorms
$dorms = array(
    "Balz-Dobie",
    "Cauthen",
    "Gibbons",
    "Kellogg",
    "Lile-Maupin",
    "Shannon",
    "Tuttle-Dunnington",
    "Watson-Webb",
    "Woody",
    "Courtenay",
    "Dunglison",
    "Fitzhugh",
    "Dillard",
    "Gooch",
    "Brown",
    "Hereford",
    "International",
    "Bonnycastle",
    "Dabney",
    "Echols",
    "Emmet",
    "Hancock",
    "Humphreys",
    "Kent",
    "Metcalf",
    "Lefevre",
    "Page"
);

$query = $_GET['query'];

$matching_dorms = array_filter($dorms, function($dorm) use ($query) {
    return stripos($dorm, $query) !== false;
});

if (!empty($matching_dorms)) {
    echo "<h2>Search Results:</h2>";
    echo "<ul>";
    foreach ($matching_dorms as $dorm) {
        echo "<li><a href='dormpages/$dorm.php'>$dorm</a></li>";
    }
    echo "</ul>";
} else {
    echo "No matching dorms found.";
}
?>