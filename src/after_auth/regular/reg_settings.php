<?php
require_once('../../functions/database/db_connect.php');
session_start();
include '../../components/reg_sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_settings.css">
    <title>HEO | Settings</title>

    <!-- browser site icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/browser-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/browser-icon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/browser-icon/site.webmanifest">

    <!-- mapbox libraries -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.1.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.1.0/mapbox-gl.js"></script>

    <!-- additional css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        #geocoder {
            z-index: 1;
            margin: 10px;
        }

        .mapboxgl-ctrl-geocoder {
            min-width: 100%;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="settings">
            <div class="settings-text">
                <h1>Settings</h1>
            </div>

            <main class="content-cont">
                <section class="section-cont mb-m">
                    <div class="section-header">
                        <p> Account Settings</p>
                        <span class="btn-cont">
                            <button class="btn-header" id="">
                                <a href="../../before_auth/landingpage.php"> Switch Account</a>
                                <i class="fa-solid fa-circle-user fa-sm icons" style="color: #efc135;"></i>
                            </button>
                            <button class="btn-header" id="">
                                Logout
                                <i class="fa-solid fa-right-from-bracket fa-sm icons" style="color: #8b0021;"></i>
                            </button>
                        </span>
                    </div>
                    <div class="section-body">
                        <span class="input-span">
                            <div class="input-cont">
                                <label for=""> Username:</label>
                                <div class="input-group">
                                    <i class="fa-regular fa-user fa-sm icons" style="color: #646464;"></i>
                                    <input type="text" name="username" placeholder="username">
                                    <button class="edit-btn" type="submit">
                                        <i class="fa-regular fa-pen-to-square fa-sm icons" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="input-cont">
                                <label for=""> Email:</label>
                                <div class="input-group">
                                    <i class="fa-regular fa-envelope fa-sm" style="color: #646464;"></i>
                                    <input type="email" name="email" placeholder="username">
                                    <button class="edit-btn" type="submit">
                                        <i class="fa-regular fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                        </span>
                        <div class="divider"></div>
                        <span class="input-span-col">
                            <div class="input-cont space-bw">
                                <label for=""> Change Password:</label>
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="">
                                </div>
                            </div>
                            <div class="input-cont space-bw">
                                <label for=""> Retype Password:</label>
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="">
                                </div>
                            </div>
                            <div class="input-cont flex-end">
                                <button input type="submit" id="save-pass-btn" class="b-sdw"> Save Changes</button>
                            </div>
                        </span>
                    </div>
                </section>
                <section class="section-cont mb-m">
                    <div class="section-header">
                        <p> App Settings</p>
                    </div>
                    <div class="section-body">
                        <span class="input-span-col">
                            <div class="input-cont flex-start">
                                <label for=""> Location:</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-location-dot fa-sm" style="color: #A598F6;"></i>
                                    <div id="geocoder" class="geocoder-container"></div>
                                    <input type="text" id="selected-location" name="location" placeholder="" readonly>
                                    <button class="edit-btn" type="submit">
                                        <i class="fa-solid fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="input-cont flex-start">
                                <label> Notifications:</label>
                                <div class="notif-group">
                                    <i class="fa-regular fa-bell fa-lg" style="color: #ffffff;"></i>
                                    <label class="switch" for="checkbox">
                                        <input type="checkbox" id="checkbox" />
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                            </div>
                        </span>
                    </div>
                </section>

                <!-- <div id="geocoderModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    
                    <div id="geocoder-container" class="geocoder-container"></div>
                </div>
            </div> -->

            </main>
        </div>
    </div>

    <!-- <div id="geocoderModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="geocoder" class="geocoder-container"></div>
            </div>
        </div> -->

    <!-- mapbox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

    <script src="../../assets/jquery/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXN0aWFucmNnIiwiYSI6ImNscnB0cm4zcjAyNGsyaW82azE2enRzNnIifQ.1tslu_DCtxUEfkfsvDLj5w';
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            types: 'country,region,place,postcode,locality,neighborhood',
        });

        geocoder.addTo('#geocoder');

        geocoder.on('result', (e) => {
            // Display the selected location in the input
            document.getElementById('selected-location').value = e.result.place_name;
            //send the geocoding result to your PHP script using AJAX
            fetch('../../functions/api/get_user_location.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(e.result),
                })
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>