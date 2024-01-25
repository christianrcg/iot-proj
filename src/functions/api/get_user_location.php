<?php
require_once '../database/db_connect.php';
session_start();

include_once '../server/create_notif.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data sent from the client
    $jsonData = file_get_contents("php://input");

    // Decode JSON data into a PHP associative array
    $geocodingResult = json_decode($jsonData, true);

    // Extract relevant data from the geocoding result
    $longitude = $geocodingResult['geometry']['coordinates'][0];
    $latitude = $geocodingResult['geometry']['coordinates'][1];
    $placeName = $geocodingResult['place_name'];

    $sql = "INSERT INTO locations (user_id, latitude, longitude, place_name)
        VALUES ('$user_id', '$latitude', '$longitude', '$placeName')
        ON DUPLICATE KEY UPDATE
        latitude = VALUES(latitude), longitude = VALUES(longitude), place_name = VALUES(place_name)";
    $inserted_loc = mysqli_query($conn, $sql);
    if ($inserted_loc === true) {
        $notif_title = "User Location changed";
        $notif_details = "Location updated to: " . $placeName . "We use your location to provide weather data that can potentially affect electricity conosumption!";
        $notif_type = "success";
        create_notif($notif_title, $notif_details, $notif_type, $user_id);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
