<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Database connection credentials
// To view tables in terminal using command line:
// docker ps to see containters
// docker exec -it db bash
// psql -U localuser example
// then use SQL commands like SELECT*FROM tablename to see whats going on
$host = "db";
$port = "5432";
$database = "example";
$user = "localuser";
$password = "cs4640LocalUser!";

$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if ($dbHandle) {
    echo "Success connecting to the database.\n";
} else {
    die("An error occurred connecting to the database.\n");
}

pg_query($dbHandle, "DROP TABLE IF EXISTS reviews CASCADE;");
pg_query($dbHandle, "DROP TABLE IF EXISTS dorms CASCADE;");
pg_query($dbHandle, "DROP TABLE IF EXISTS users CASCADE;");
pg_query($dbHandle, "DROP SEQUENCE IF EXISTS dorms_id_seq;");
pg_query($dbHandle, "DROP SEQUENCE IF EXISTS users_id_seq;");
pg_query($dbHandle, "DROP SEQUENCE IF EXISTS reviews_id_seq;");

// Create sequences for primary keys
pg_query($dbHandle, "CREATE SEQUENCE dorms_id_seq;");
pg_query($dbHandle, "CREATE SEQUENCE users_id_seq;");
pg_query($dbHandle, "CREATE SEQUENCE reviews_id_seq;");

$createDormsTable = "CREATE TABLE dorms (
    dorm_id SERIAL PRIMARY KEY,
    dorm_name VARCHAR(100) NOT NULL,
    avg_rating INTEGER CHECK (avg_rating >= 1 AND avg_rating <= 5),
    avg_location_rating INTEGER CHECK (avg_location_rating >= 1 AND avg_location_rating <= 5),
    avg_conditions_rating INTEGER CHECK (avg_conditions_rating >= 1 AND avg_conditions_rating <= 5),
    avg_utilities_rating INTEGER CHECK (avg_utilities_rating >= 1 AND avg_utilities_rating <= 5)
)";

$createUsersTable = "CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
)";

$createReviewsTable = "CREATE TABLE reviews (
    review_id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(user_id) ON DELETE CASCADE,
    dorm_name VARCHAR(100) NOT NULL,
    location_rating INTEGER CHECK (location_rating >= 1 AND location_rating <= 5),
    conditions_rating INTEGER CHECK (conditions_rating >= 1 AND conditions_rating <= 5),
    utilities_rating INTEGER CHECK (utilities_rating >= 1 AND utilities_rating <= 5),
    review_text TEXT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
)";

pg_query($dbHandle, $createDormsTable) or die('Error with createDormsTable query: ' . pg_last_error());
pg_query($dbHandle, $createUsersTable) or die('Error with createUsersTable query: ' . pg_last_error());
pg_query($dbHandle, $createReviewsTable) or die('Error with createReviewsTable query: ' . pg_last_error());

echo "Tables created successfully.\n";

// Array of dorms
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

// Insert dorms into the database
foreach ($dorms as $dorm) {
    $insertQuery = "INSERT INTO dorms (dorm_name) VALUES ($1)";
    $result = pg_query_params($dbHandle, $insertQuery, array($dorm));
    if (!$result) {
        echo "Error inserting dorm $dorm: " . pg_last_error($dbHandle);
    }
}
pg_close($dbHandle);
?>