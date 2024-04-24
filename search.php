<?php
// Author: Yuina Barzdukas & Drew Hollar

require_once 'database/db_connect.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';
$response = array();

if (preg_match('/^[a-zA-Z0-9\s]+$/', $query)) {
    $sql = "SELECT dorms.dorm_id, dorms.dorm_name, 
                   AVG((reviews.location_rating + reviews.conditions_rating + reviews.utilities_rating) / 3.0) AS avg_rating
            FROM dorms
            LEFT JOIN reviews ON dorms.dorm_name = reviews.dorm_name
            WHERE dorms.dorm_name ILIKE '%' || $1 || '%'
            GROUP BY dorms.dorm_id, dorms.dorm_name";

    $result = pg_query_params($dbHandle, $sql, array($query));

    if ($result) {
        // check if any dorms are found
        if (pg_num_rows($result) > 0) {
            // adds dorm results to return later
            while ($row = pg_fetch_assoc($result)) {
                $response[] = array(
                    'dorm_id' => $row['dorm_id'],
                    'dorm_name' => $row['dorm_name'],
                    'avg_rating' => number_format((float)$row['avg_rating'], 2) // recalculates avg because I don't think we stored it earlier
                );
            }
        } else {
            // for when nothing is returned
            $response['message'] = 'No matching dorms found.';
        }
    } else {
        // for errors
        $response['error'] = pg_last_error($dbHandle);
    }
} else {
    // more error
    $response['message'] = 'Invalid search query.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
