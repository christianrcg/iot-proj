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

    <script src="../../assets/jquery/jquery.js"></script>

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
                        <p class="notif-title">An appliance is Successsfully added!</p>
                        <button class="view_btn" id="toggleButton" style="height: 40px; width: 16vh;">
                            View Details
                        </button>
                        <p>|</p>
                        <button class="close-icon">
                            <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff; cursor: pointer;"></i>
                        </button>
                    </span>
                    <span class="notif-details" id="detailsContainer">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus quae odit, repellendus at, obcaecati accusantium, suscipit tempore sunt non facilis eum distinctio? Numquam quisquam reprehenderit quam aliquam, libero debitis hic.</p>
                    </span>
                </div>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Hide details container on page load
            var detailsVisible = false;
            $("#detailsContainer").hide();

            $("#toggleButton").click(function() {
                // Toggle visibility of details container
                $("#detailsContainer").slideToggle();

                // Update button text based on the new visibility state
                detailsVisible = !detailsVisible;
                var buttonText = detailsVisible ? "Close Details" : "View Details";
                $("#toggleButton").text(buttonText);

                // Check if details are visible and load content using AJAX if necessary
                if (detailsVisible) {
                    // Use AJAX to load content if needed
                    // Example: $.ajax({ url: 'your_details_endpoint', method: 'GET', success: function(data) { /* handle success */ } });
                    // For simplicity, we'll just log a message here
                    console.log("Details are visible");
                }
            });
        });
    </script>


</body>

</html>