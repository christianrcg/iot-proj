<?php
require_once('../../functions/database/db_connect.php');
session_start();
include_once '../../components/reg_sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_homepage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>HEO | Dashboard</title>
</head>

<body>
    <div class="content">
        <div class="dashboard">
            <div class="dashboard-text">
                <h1>Dashboard</h1>
            </div>

            <div class="container">

                <!-- HEADER -->

                <div class="header">
                    <h1>Hello User!</h1>
                    <p>welcome to your home electricity saver app</p>
                </div>

                <!-- GRAPH -->

                <div class="bar-graph"></div>


                <!-- ELECTRICITY RATE -->

                <div class="electricity-rate">
                    <div class="electricity-rate-content">
                        <i class="fa-solid fa-bolt-lightning fa-2xl" style="color: white;"></i>
                        <div class="electricity-rate-text">
                            <p>Meralco electricity Rate as of November</p>
                            <h1>₱12 kWh</h1>
                        </div>
                    </div>
                </div>


                <!-- MONTHLY CONSUMPTION -->

                <div class="monthly-consumption">

                    <div class="monthly-consumption-text">
                        <i class="fa-solid fa-circle-info fa-2xl" style="color: white;"></i>
                        <h3>Want to limit your monthly consumption?</h3>
                    </div>

                    <div class="monthly-consumption-input">
                        <h3>Set monthly budget:</h3>
                        <div class="input-group">
                            <input type="number" name="budget" placeholder="&#8369;">
                            <button class="edit-btn" type="submit">
                                <i class="fa-regular fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ADDRESS TEMPERATURE -->
                <?php
                //get location and weather
                include_once '../../functions/user/fetch_location.php';
                include_once '../../functions/api/get_weather.php';
                include_once '../../functions/server/hot_weather_warning.php';


                $location_data = getLocationData($_SESSION['user_id']);
                $latitude = isset($location_data['latitude']) ? $location_data['latitude'] : 'Not Set';
                $longitude = isset($location_data['longitude']) ? $location_data['longitude'] : 'Not Set';
                $place_local = isset($location_data['place_local']) ? $location_data['place_local'] : 'Not Set';
                $place_name = isset($location_data['place_name']) ? $location_data['place_name'] : 'Not Set';

                $weather_data = null;
                if ($latitude !== 'Not Set' && $longitude !== 'Not Set') {
                    $weather_data = getWeatherLocation($latitude, $longitude);

                    //will run if its hot weather and will create a warning notification that will displayed at notifications page.
                    checkForHotWeather($weather_data['temperature'], $_SESSION['user_id']);
                }

                ?>
                <div class="address-temperature">
                    <div class="address-temperature-location">
                        <i class="fa-solid fa-location-dot fa-2xl" style="color: #c80404;"></i>
                        <div class="address-location-text">
                            <h1><?php echo $location_data['place_local'] ?? 'Not Set'; ?></h1>
                            <p><?php echo $location_data['place_name'] ?? 'Not Set'; ?></p>
                        </div>
                    </div>

                    <div class="address-temperature-degree">
                        <div class="icon-container">
                            <?php if ($weather_data !== null && isset($weather_data['weather_icon'])) : ?>
                                <img src="http://openweathermap.org/img/w/<?php echo $weather_data['weather_icon']; ?>.png" alt="weather_icon" style="height: 2rem; width: 2rem;">
                            <?php else : ?>
                                <img src="../../assets/img/weatherlogo_32x32.png" alt="weather_icon" style="height: 2rem; width: 2rem;">
                            <?php endif; ?>
                            <h1><?php echo isset($weather_data['temperature']) ? round($weather_data['temperature']) . '°C' : 'Not Set'; ?></h1>
                        </div>

                        <div class="address-temperature-text">
                            <h1><?php echo isset($weather_data['weather_main']) ? $weather_data['weather_main'] : 'Not Set'; ?></h1>
                            <div class="address-temp">
                                <h1>feels like</h1>
                                <p><?php echo isset($weather_data['feels_like']) ? round($weather_data['feels_like']) . '°C' : 'Not Set'; ?></p>
                            </div>
                        </div>
                    </div>


                </div>


                <!-- ELECTRICITY CONSUMPTION -->

                <div class="electricity-consumption">
                    <div class="electricity-consumption-header">

                        <i class="fa-solid fa-chart-line fa-2xl" style="color: purple;"></i>

                        <div class="electricity-consumption-header-text">
                            <h2>Today's current electricity comsumption</h2>
                            <p>based on your listed appliances</p>
                        </div>
                    </div>

                    <div class="electricity-consumption-body">

                        <div class="per-minute">
                            <div class="minute-label">
                                <label>Per Minute</label>
                            </div>
                            <div class="per-minute-content">
                                <div class="watts">
                                    <h2>51 W</h2>
                                </div>
                                <div class="cost">
                                    <h2>Cost: </h2>
                                    <h2>0.612 PHP</h2>
                                </div>
                            </div>
                        </div>

                        <div class="per-hour">
                            <div class="hour-label">
                                <label>Per Hour</label>
                            </div>
                            <div class="per-hour-content">
                                <div class="watts">
                                    <h2>51 W</h2>
                                </div>
                                <div class="cost">
                                    <h2>Cost: </h2>
                                    <h2>0.612 PHP</h2>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="electricity-consumption-prediction">
                        <p>if continue in the following 24 hours</p>
                        <div class="cost-computed">
                            <h2>Cost: </h2>
                            <h2 style="margin-left: 5px; font-style:italic;">881 PHP</h2>
                        </div>
                    </div>

                </div>
            </div>

            <div class="not-available">
                <h1>"This Breakpoint is Under Development"</h1>
                <p>Please use the desktop mode for content availability!</p>
            </div>

        </div>
    </div>
</body>

</html>