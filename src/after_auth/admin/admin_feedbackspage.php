<?php
require_once('../../functions/database/db_connect.php');
session_start();
include_once '../../components/admin_sidebar.php';

// Fetch user feedback data from the user_feedback table
$selectSql = "SELECT
    feedback_id,
    username,
    email,
    message,
    CONCAT(
        DATE_FORMAT(feedback_date, '%d %M %Y'), ' - ',
        DATE_FORMAT(feedback_date, '%W %l:%i %p')
    ) AS formatted_feedback_date
FROM
    user_feedback
ORDER BY
    feedback_date DESC";
// Execute the query
$result = mysqli_query($conn, $selectSql);

// Check for errors
if (!$result) {
    die('Error in the query: ' . mysqli_error($conn) . '<br>Query: ' . $selectSql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../admin/style/admin_feedbackspage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../../assets/jquery/jquery.js"></script>

    <title>HEO | User Feedbacks</title>
</head>

<body>
    <div class="content">
        <div class="feedback">
            <div class="feedback-text">
                <h1>Feedbacks</h1>
            </div>

            <div class="users-feedback">

                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $feedbackId = $row['feedback_id'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $message = $row['message'];
                    $formattedFeedbackDate = $row['formatted_feedback_date'];
                ?>

                    <div class="feedback-card">
                        <span class="feedback-header">
                            <p class="feedback-title"> From user <b><?php echo $username; ?></b> with an email <b style="text-decoration:underline;"><?php echo $email; ?></b> </p>
                            <button class="view_btn" data-id="<?php echo $feedbackId; ?>" style="height: 40px; width: 16vh;">
                                View Message
                            </button>
                            <p>|</p>
                            <form id="removeForm<?php echo $feedbackId; ?>" action="../../functions/server/remove_feedback.php" method="POST" class="rm_form">
                                <input type="hidden" name="remove_feedback" value="<?php echo $feedbackId; ?>">
                                <button type="button" class="close-icon delete-icon" data-id="<?php echo $feedbackId; ?>">
                                    <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff; cursor: pointer;"></i>
                                </button>
                            </form>

                        </span>
                        <span class="feed-message" id="feedbackContainer<?php echo $feedbackId; ?>">
                            <p> <?php echo $message; ?></p>
                            <p> <small style="color: wheat"><?php echo $formattedFeedbackDate; ?></small></p>
                        </span>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>

        <div class="not-available">
            <h1>"This Breakpoint is Under Development"</h1>
            <p>Please use the desktop mode for content availability!</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteIcons = document.querySelectorAll('.delete-icon');

            deleteIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    var feedbackId = icon.getAttribute('data-id');

                    if (!/^\d+$/.test(feedbackId)) {
                        console.error('Invalid feedback ID');
                        return;
                    }

                    var confirmDelete = confirm('Are you sure you want to delete this feedback?');
                    if (!confirmDelete) {
                        return;
                    }

                    // Trigger the form submission
                    var form = document.getElementById('removeForm' + feedbackId);
                    form.submit();
                });
            });

            var viewButtons = document.querySelectorAll('.view_btn');

            viewButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var feedbackId = button.getAttribute('data-id');

                    // Check if data-id attribute is present and is a valid number
                    if (feedbackId && /^\d+$/.test(feedbackId)) {
                        // Add your logic to handle the view details functionality here
                        console.log('View details for feedback ID: ' + feedbackId);
                    } else {
                        console.error('Invalid or missing feedback ID');
                        console.log(button); // Log the button to inspect its attributes
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Hide notif-details on page load
            $(".feedback-message").hide();

            // Handle click event for each "View Details" button
            $(".view_btn").click(function() {
                // Toggle visibility of notif-details
                var feedbackId = $(this).data('id');
                $("#feedbackContainer" + feedbackId).slideToggle();
            });

            // Prevent duplicate form submissions
            $(".rm_form").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                var confirmed = confirm("Are you sure you want to remove this notification?");
                if (confirmed) {
                    $(this).unbind('submit').submit(); // Submit the form if confirmed
                }
            });
        });
    </script>

</body>

</html>