<?php
require_once('../../functions/database/db_connect.php');
session_start();
include '../../components/reg_sidebar.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$user_info = $conn->query($sql);

if ($user_info->num_rows > 0) {
    // Fetch the data
    $row = $user_info->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $notif_settings = $row['notif_settings'];
}

$loc_sql = "SELECT COALESCE(l.place_name, ' ') AS place_name,  
        COALESCE(l.place_local, 'Not Set') AS place_local
        FROM users u
        LEFT JOIN locations l ON u.user_id = l.user_id
        WHERE u.user_id = $user_id";

$loc_sql_res = $conn->query($loc_sql);

if ($loc_sql_res->num_rows > 0) {
    $row = $loc_sql_res->fetch_assoc();
    $place_name = $row['place_name'];
    $place_local = $row['place_local'];
} else {
    $place_name = ' ';
    $place_local = 'Not Set';
}

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
        #geocoder {
            z-index: 1;
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
                            <button class="btn-header" id="switchAcc">
                                Switch Account
                                <i class="fa-solid fa-circle-user fa-sm icons" style="color: #efc135;"></i>
                            </button>
                            <button class="btn-header" id="logoutBtn">
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
                                    <form action="../../functions/user/update_info.php" method="POST">
                                        <i class="fa-regular fa-user fa-sm icons" style="color: #646464;"></i>
                                        <input type="text" name="username" placeholder="<?php echo $username; ?>">
                                        <button class="edit-btn" type="submit" name="update_username">
                                            <i class="fa-regular fa-pen-to-square fa-sm icons" style="color: #ffffff;"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <div class="input-cont">
                                <label for=""> Email:</label>
                                <div class="input-group">
                                    <form action="../../functions/user/update_info.php" method="POST">
                                        <i class="fa-regular fa-envelope fa-sm" style="color: #646464;"></i>
                                        <input type="email" name="email" placeholder="<?php echo $email; ?>">
                                        <button class="edit-btn" type="submit" name="update_email">
                                            <i class="fa-regular fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </span>
                        <div class="divider"></div>
                        <form action="../../functions/user/update_pasword.php" method="POST">
                            <span class="input-span-col">
                                <div class="input-cont space-bw">
                                    <label for=""> Change Password:</label>
                                    <div class="input-group">
                                        <input type="password" name="new_password" placeholder="" required>
                                    </div>
                                </div>
                                <div class="input-cont space-bw">
                                    <label for=""> Retype Password:</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" placeholder="" required>
                                    </div>
                                </div>
                                <div class="input-cont flex-end">
                                    <button input type="submit" id="save-pass-btn" class="b-sdw"> Save Changes</button>
                                </div>
                            </span>
                        </form>
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
                                    <input type="text" id="selected-location" name="location" placeholder="<?php echo $place_local . ", " . $place_name; ?>" readonly>
                                    <button class="edit-btn" id="popup-btn">
                                        <i class="fa-solid fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="input-cont flex-start">
                                <label> Notifications:</label>
                                <div class="notif-group">
                                    <i class="fa-regular fa-bell fa-lg" style="color: #ffffff;"></i>
                                    <label class="switch" for="checkbox">
                                        <input type="checkbox" id="checkbox" <?php echo ($notif_settings == 'on') ? 'checked' : ''; ?>>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                            </div>
                        </span>
                    </div>
                </section>
            </main>
        </div>
        <div class="modal" id="geocoderModal">
            <div class="modal-content">
                <!-- <div class="modal-body"> -->
                <div id="geocoder" class="geocoder-container"></div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <style>
        /* Style for the modal container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(12px);

        }

        /* Style for the modal content */
        .modal-content {
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            margin: 20% auto;
            width: 50%;
            max-width: 250px;
            position: relative;
            padding: 2rem;
        }

        /* Style for the close button */

        .modal-body {
            display: flex;
            justify-content: center;
            border: 2px solid blue;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <!-- mapbox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

    <script src="../../assets/jquery/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXN0aWFucmNnIiwiYSI6ImNscnB0cm4zcjAyNGsyaW82azE2enRzNnIifQ.1tslu_DCtxUEfkfsvDLj5w';
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            types: 'region,place,locality,neighborhood',
            language: 'en',
            country: 'PH',
        });

        geocoder.addTo('#geocoder');

        geocoder.on('result', (e) => {
            // Display the selected location in the input
            console.log('Geocoding result:', e.result);
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
                .then(data => {
                    console.log(data);
                    modal.style.display = 'none';
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('checkbox').addEventListener('change', function() {
            var newSetting = this.checked ? 'on' : 'off';

            fetch('../../functions/user/update_notif_setting.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'notif_setting=' + newSetting,
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        var modal = document.getElementById('geocoderModal');
        var btn = document.getElementById('popup-btn');
        var closeModal = document.getElementById('closeModal');

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = 'block';
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };

        document.getElementById('logoutBtn').addEventListener('click', function() {
            alert("Confirm Logout?");
            window.location.href = '../../functions/server/logout.php';
        });

        document.getElementById('switchAcc').addEventListener('click', function() {
            alert("Switch Account?");
            window.location.href = '../../functions/server/switch_account.php';
        });
    </script>

</body>

</html>