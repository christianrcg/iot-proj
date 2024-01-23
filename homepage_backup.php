<?php
include_once '../../components/reg_sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- browser site icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/browser-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/browser-icon/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/browser-icon/site.webmanifest">

    <link rel="stylesheet" href="../regular/style/reg_homepage.css">

    <title>Dashboard</title>
</head>

<body>
    <article class="content">
        <div class="dashboard">
            <div class="dashboard-text">
                <h1>Dashboard</h1>
            </div>

            <div class="container">
                <div class="header">
                    <h1>Hello User!</h1>
                    <p>welcome to your home electricity saver app</p>
                </div>
                <div class="bar-graph"></div>
                <div class="electricity-rate"></div>
                <div class="monthly-consumption"></div>
                <div class="address-temperature"></div>
                <div class="electricity-comsumption"></div>
            </div>

            <div class="not-available">
                <h1>"This Breakpoint is Under Development"</h1>
                <p>Please use the desktop mode for content availability!</p>
            </div>

        </div>
    </article>
</body>

</html>