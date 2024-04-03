<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Database connection credentials
$host = "db";
$port = "5432";
$database = "uva_dorm_rater";
$user = "";
$password = "";

$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if ($dbHandle) {
    echo "Success connecting to the database.\n";
} else {
    die("An error occurred connecting to the database.\n");
}

pg_query($dbHandle, "DROP TABLE IF EXISTS reviews;");
pg_query($dbHandle, "DROP TABLE IF EXISTS users;");
pg_query($dbHandle, "DROP SEQUENCE IF EXISTS users_id_seq;");
pg_query($dbHandle, "DROP SEQUENCE IF EXISTS reviews_id_seq;");

// Create sequences for primary keys
pg_query($dbHandle, "CREATE SEQUENCE users_id_seq;");
pg_query($dbHandle, "CREATE SEQUENCE reviews_id_seq;");


$createUsersTable = "CREATE TABLE users (
    user_id INTEGER PRIMARY KEY DEFAULT nextval('users_id_seq'),
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);";

$createReviewsTable = "CREATE TABLE reviews (
    review_id INTEGER PRIMARY KEY DEFAULT nextval('reviews_id_seq'),
    user_id INTEGER REFERENCES users(user_id) ON DELETE CASCADE,
    dorm_name VARCHAR(100) NOT NULL,
    rating INTEGER CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);";


pg_query($dbHandle, $createUsersTable) or die('Error with createUsersTable query: ' . pg_last_error());
pg_query($dbHandle, $createReviewsTable) or die('Error with createReviewsTable query: ' . pg_last_error());

echo "Tables created successfully.\n";

?>