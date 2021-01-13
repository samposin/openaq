<?php 

include('db.php');

// init empty array
$arr = [];

$sql_level = "SELECT * FROM openaq";

$result = $conn->query($sql_level);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $arr[] = array(
            'lat' => $row['latitude'],
            'lng' => $row['longitude'],
            'countsByMeasurement' => json_decode($row['countsByMeasurement']),
        );
    }
}

echo json_encode($arr);