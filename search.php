<?php
//Author: Yuina Barzdukas & Drew Hollar

require_once 'database/db_connect.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';

$response = array();

if (preg_match('/^[a-zA-Z0-9\s]+$/', $query)) {

    $sql = "SELECT * FROM dorms WHERE dorm_name ILIKE '%' || $1 || '%'";

    $result = pg_query_params($dbHandle, $sql, array($query));

    // Check if any matching dorms were found
    if (pg_num_rows($result) > 0) {
        // Loop through the results and add dorm information to the response array
        while ($row = pg_fetch_assoc($result)) {
            $response[] = array(
                'dorm_id' => isset($row['dorm_id']) ? $row['dorm_id'] : null,
                'dorm_name' => isset($row['dorm_name']) ? $row['dorm_name'] : null,
                'avg_rating' => isset($row['avg_rating']) ? $row['avg_rating'] : null,
                'avg_location_rating' => isset($row['avg_location_rating']) ? $row['avg_location_rating'] : null,
                'avg_conditions_rating' => isset($row['avg_conditions_rating']) ? $row['avg_conditions_rating'] : null,
                'avg_utilities_rating' => isset($row['avg_utilities_rating']) ? $row['avg_utilities_rating'] : null
            );
        }
    } else {
        // If no matching dorms were found, set a message in the response array
        $response['message'] = 'No matching dorms found.';
    }
}

echo json_encode($response);
?>
