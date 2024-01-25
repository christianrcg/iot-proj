<?php

function getWeatherLocation($latitude, $longitude)
{
    $api_key = "70da97a868306e040a1b6a86b793891d";
    $api_endpoint = "https://api.openweathermap.org/data/2.5/weather?lat="
        . $latitude . "&lon=" . $longitude .
        "&lang=en&units=metric&appid=" . $api_key;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $api_endpoint);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    curl_close($ch);
    $response_data = json_decode($response);

    // filter only wanted results
    if (is_object($response_data) && property_exists($response_data, 'main') && property_exists($response_data, 'weather')) {
        $weather_data = array(
            'temperature' => $response_data->main->temp,
            'feels_like' => $response_data->main->feels_like,
            'weather_main' => $response_data->weather[0]->main,
            'weather_icon' => $response_data->weather[0]->icon
        );

        return $weather_data;
    } else {
        return null;
    }
}
