<?php
//Author: Drew Hollar
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Credentials
$host = "db";
$port = "5432";
$database = "example";
$user = "localuser";
$password = "cs4640LocalUser!";

$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if (!$dbHandle) {
    die("An error occurred connecting to the database.\n");
}
?>
