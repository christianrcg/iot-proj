<?php
include_once 'create_notif.php';

function checkForHotWeather($weather_temperature, $user_id)
{
    global $conn;
    $hot_weather_temp = '';
    $check_config_sql = "SELECT hot_weather_temp FROM global_config";
    $check_sql_run = mysqli_query($conn, $check_config_sql);

    if ($check_sql_run) {
        $result_row = mysqli_fetch_assoc($check_sql_run);
        $hot_weather_temp = $result_row['hot_weather_temp'];
    } else {
        echo 'Error: ' . mysqli_error($conn);
        return null;
    }

    if ($weather_temperature >   $hot_weather_temp) {
        //create a warning notif
        $notif_title = "Hot Weather Temperature!";
        $notif_details = 'Current weather temperature is:<b> ' . $weather_temperature . ' °C</b>. This can possibly increase the electricity consumption due to hot temperatures! See more info about the current weather <b><a href="reg_homepage.php"> here </a></b>';
        $notif_type = "warning";
        create_notif($notif_title, $notif_details, $notif_type, $user_id);
    } else {
        return null;
    }

    $conn->close();
}
