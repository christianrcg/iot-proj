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
    <link rel="stylesheet" href="../regular/style/reg_notification.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>HEO | Notifications</title>

</head>

<body>
    <div class="content">
        <div class="notification">
            <div class="notification-text">
                <h1>Notification</h1>
            </div>

            <div class="card-container">

                <div class="notification-appliance-card">

                    <div class="notification-message">
                        <h3>An appliance is Successsfully added</h3>
                    </div>

                    <div class="close-icon">
                        <h1>|</h1>
                        <i class="fa-solid fa-xmark fa-lg" style="color: #ffffff;"></i>
                    </div>

                </div>

                <div class="notification-exceed-card">

                    <div class="notification-message">
                        <h3>Electricity consumption Exceed the set monthly budget!</h3>
                    </div>

                    <div class="close-icon">
                        <h1>|</h1>
                        <i class="fa-solid fa-xmark fa-lg" style="color: #ffffff;"></i>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>