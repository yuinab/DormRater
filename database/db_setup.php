<?php
// Author: Drew Hollar
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Credentials for CS Server:
/*
$host = "localhost";
$port = "5432";
$database = "mhc3cm";
$user = "mhc3cm";
$password = "noCCuhAXDBMC";
*/

// Credentials for local host

$host = "db";
$port = "5432";
$database = "example";
$user = "localuser";
$password = "cs4640LocalUser!";


$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if ($dbHandle) {
    /*
    echo "Success connecting to the database.\n";
    */
} else {
    die("An error occurred connecting to the database.\n");
}

// Function to check if table exists
function tableExists($dbh, $tableName) {
    $result = pg_query($dbh, "SELECT to_regclass('public.{$tableName}')");
    $line = pg_fetch_array($result);
    return $line[0] ? true : false;
}

// create sequences and tables if they don't exist
$tablesToCheck = ['dorms', 'users', 'reviews'];
$sequences = ['dorms_id_seq', 'users_id_seq', 'reviews_id_seq'];

foreach ($sequences as $sequence) {
    if (!tableExists($dbHandle, $sequence)) {
        pg_query($dbHandle, "CREATE SEQUENCE {$sequence};");
    }
}

foreach ($tablesToCheck as $table) {
    if (!tableExists($dbHandle, $table)) {
        switch ($table) {
            case 'dorms':
                $createQuery = "CREATE TABLE dorms (
                    dorm_id SERIAL PRIMARY KEY,
                    dorm_name VARCHAR(100) NOT NULL,
                    avg_rating INTEGER CHECK (avg_rating >= 1 AND avg_rating <= 5),
                    avg_location_rating INTEGER CHECK (avg_location_rating >= 1 AND avg_location_rating <= 5),
                    avg_conditions_rating INTEGER CHECK (avg_conditions_rating >= 1 AND avg_conditions_rating <= 5),
                    avg_utilities_rating INTEGER CHECK (avg_utilities_rating >= 1 AND avg_utilities_rating <= 5)
                )";
                break;
            case 'users':
                $createQuery = "CREATE TABLE users (
                    user_id SERIAL PRIMARY KEY,
                    username VARCHAR(50) UNIQUE NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    password_hash VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
                )";
                break;
            case 'reviews':
                $createQuery = "CREATE TABLE reviews (
                    review_id SERIAL PRIMARY KEY,
                    user_id INTEGER REFERENCES users(user_id) ON DELETE CASCADE,
                    dorm_name VARCHAR(100) NOT NULL,
                    location_rating INTEGER CHECK (location_rating >= 1 AND location_rating <= 5),
                    conditions_rating INTEGER CHECK (conditions_rating >= 1 AND conditions_rating <= 5),
                    utilities_rating INTEGER CHECK (utilities_rating >= 1 AND utilities_rating <= 5),
                    review_text TEXT,
                    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
                )";
                break;
        }
        pg_query($dbHandle, $createQuery) or die('Error creating table ' . $table . ': ' . pg_last_error());
        echo "Table {$table} created successfully.\n";
    }
}

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

// Insert dorms
foreach ($dorms as $dorm) {
    $insertQuery = "INSERT INTO dorms (dorm_name) VALUES ($1)";
    $result = pg_query_params($dbHandle, $insertQuery, array($dorm));
    if (!$result) {
        echo "Error inserting dorm $dorm: " . pg_last_error($dbHandle);
    }
}
pg_close($dbHandle);
?>