<?php

include 'db.php';

$url = "https://api.openaq.org/v1/locations?limit=".$_GET['limit']."&page=".$_GET['page']." ";

//  Initiate curl
$ch = curl_init();

// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the url
curl_setopt($ch, CURLOPT_URL, $url);

// Execute
$result = curl_exec($ch);

// Closing
curl_close($ch);

// Will dump a beauty json :3
$data = json_decode($result, true);

foreach ($data['results'] as $d) {
    $sql = "INSERT INTO openaq (id, country, city, cities, location, locations, sourceName, sourceNames, sourceType, sourceTypes, longitude, latitude, firstUpdated, lastUpdated, parameters, countsByMeasurement, count) VALUES ('" . $d['id'] . "', '" . $d['country'] . "', '" . $d['city'] . "', '" . json_encode($d['cities']) . "', '" . $d['location'] . "', '" . json_encode($d['locations']) . "', '" . $d['sourceName'] . "', '" . json_encode($d['sourceNames']) . "', '" . $d['sourceType'] . "', '" . json_encode($d['sourceTypes']) . "', '" . $d['coordinates']['longitude'] . "', '" . $d['coordinates']['latitude'] . "', '" . $d['firstUpdated'] . "', '" . $d['lastUpdated'] . "', '" . json_encode($d['parameters']) . "', '" . json_encode($d['countsByMeasurement']) . "', '" . $d['count'] . "')";
    if ($conn->query($sql) === true) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
echo "New record created successfully";

$conn->close();
