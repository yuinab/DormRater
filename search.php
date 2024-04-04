<?php
// Include your database connection
require_once 'database/db_connect.php';

// Get the query parameter from the URL
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare a SQL query to fetch dorm names from the database
$sql = "SELECT * FROM dorms WHERE dorm_name ILIKE '%' || $1 || '%'";

// Execute the SQL query with the query parameter
$result = pg_query_params($dbHandle, $sql, array($query));

// Prepare response array
$response = array();

// Check if any matching dorms were found
if (pg_num_rows($result) > 0) {
    // Loop through the results and add dorm information to the response array
    while ($row = pg_fetch_assoc($result)) {
        // Check if all keys exist before accessing them
        $response[] = array(
            'dorm_id' => isset($row['dorm_id']) ? $row['dorm_id'] : null,
            'dorm_name' => isset($row['dorm_name']) ? $row['dorm_name'] : null,
            'avg_rating' => isset($row['avg_rating']) ? $row['avg_rating'] : null,
            'avg_location_rating' => isset($row['avg_location_rating']) ? $row['avg_location_rating'] : null,
            'avg_conditions_rating' => isset($row['avg_conditions_rating']) ? $row['avg_conditions_rating'] : null,
            'avg_utilities_rating' => isset($row['avg_utilities_rating']) ? $row['avg_utilities_rating'] : null
        );
    }
}  else {
    // If no matching dorms were found, set a message in the response array
    $response['message'] = 'No matching dorms found.';
}

// Encode the response array to JSON format
echo json_encode($response);
?>