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
            <div class="notifs-cont">
                <div class="notif-card">
                    <span class="notif-header">
                        <p class="notif-title">An appliance is Successsfully added</p>
                        <button class="view_btn">
                            View
                        </button>
                        <p>|</p>
                        <button>
                            <i class="fa-solid fa-xmark fa-lg" style="color: #ffffff;"></i>
                        </button>
                    </span>
                    <span class="notif-details">
                        <p>details</p>
                    </span>
                </div>
                <div class="notif-card">
                    <span class="notif-header">
                        <p class="notif-title">An appliance is Successsfully added</p>
                        <button class="view_btn">
                            View
                        </button>
                        <p>|</p>
                        <button>
                            <i class="fa-solid fa-xmark fa-lg" style="color: #ffffff;"></i>
                        </button>
                    </span>
                    <span class="notif-details">
                        <p>details</p>
                    </span>
                </div>
            </div>

        </div>
    </div>
</body>

</html>