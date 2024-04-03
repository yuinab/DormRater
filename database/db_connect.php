<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection credentials
$host = "db";
$port = "5432";
$database = "example";
$user = "localuser";
$password = "cs4640LocalUser!";

// Establish a connection to the database
$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if (!$dbHandle) {
    die("An error occurred connecting to the database.\n");
}
?>
