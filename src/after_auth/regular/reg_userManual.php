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
    <link rel="stylesheet" href="../regular/style/reg_userManual.css">
    <title>HEO | User Manual</title>

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AJAX -->
    <script src="../../assets/jquery/jquery.js"></script>

</head>

<body>
    <div class="content">
        <div class="manual">
            <div class="manual-text">
                <h1>User Manual & Feedback</h1>
            </div>

            <div class="manual-content">
                <div class="manual-content-header">

                    <h1>How to use HEO App?</h1>

                    <div class="header-btn">

                        <button id="toggle-content1-btn">
                            <i class="fa-solid fa-video" style="color: #ffffff;"></i>
                            Video
                        </button>

                        <button id="toggle-content2-btn">
                            <i class="fa-solid fa-file" style="color: #ffffff;"></i>
                            Text
                        </button>

                    </div>

                </div>

                <div class="docs-vid-container">
                    <div class="ajax-container-content" id="ajax-container">
                        <?php
                        include_once '../../after_auth/regular/reg_userManualVid.php';
                        ?>
                    </div>
                </div>

                <div class="feedback-container">

                    <div class="feedback-container-text">
                        <h1>Your Feedback matters to us!</h1>
                    </div>

                    <form>
                        <div class="message-box">
                             <i class="fa-solid fa-message" style="color: #ffffff; margin: 0px 5px 0px 10px"></i> 
                            <input type="text" placeholder="Send us your message...">
                        </div>
                        <div class="submit-btn">
                            <input type="submit" value="Submit">
                        </div>
                    </form>

                </div>

            </div>

        </div>

        <div class="not-available">
            <h1>"This Breakpoint is Under Development"</h1>
            <p>Please use the desktop mode for content availability!</p>
        </div>

    </div>


    <script>
        $(document).ready(function() {

            // Function to load content using AJAX
            function loadContent(endpoint) {
                $.ajax({
                    url: endpoint,
                    method: 'GET',
                    success: function(data) {
                        // Update the content container with the new content
                        $('#ajax-container').html(data);
                    },
                    error: function(error) {
                        console.error('Error loading content:', error);
                    }
                });
            }

            // Button click event to toggle content set 1
            $('#toggle-content1-btn').click(function() {
                var endpoint = '../regular/reg_userManualVid.php';
                loadContent(endpoint);
            });

            // Button click event to toggle content set 2
            $('#toggle-content2-btn').click(function() {
                var endpoint = '../regular/reg_userManualDocs.php';
                loadContent(endpoint);
            });

        });
    </script>


</body>

</html>