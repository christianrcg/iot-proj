<?php
require_once('../../functions/database/db_connect.php');
session_start();
include_once '../../components/reg_sidebar.php';

$user_id = $_SESSION['user_id'];

//query to see status notifaction setting of the user:

$notif_sql = "SELECT notif_settings FROM users WHERE user_id = $user_id";
$notif_stat = ''; // initialize a global variable
$notif_status = mysqli_query($conn, $notif_sql);

if ($notif_status) {
    $notif_row = mysqli_fetch_assoc($notif_status);
    $notif_stat = $notif_row['notif_settings'];
} else {
    echo 'Error: ' . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_notification.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <title>HEO | Notifications</title>

</head>

<body>
    <div class="content">
        <div class="notification">
            <div class="notification-text">
                <h1>Notification</h1>
            </div>
            <div class="notifs-cont">

                <?php

                if ($notif_stat == 'off') {
                    echo '<p> The notifications is disabled. Turn it on on the <b><a href="reg_settings.php">settings page </a> </b> to view notifications. </a></p>';
                } else {
                    $sql = "SELECT notif_id, user_id, title, details, notif_type, DATE_FORMAT(notif_date, '%l:%i %p %M %e') AS formatted_notif_date FROM notifications WHERE user_id=$user_id ORDER BY notif_date DESC";
                    $notif_data = mysqli_query($conn, $sql) or die('error');

                    if (mysqli_num_rows($notif_data) > 0) {
                        while ($row = mysqli_fetch_assoc($notif_data)) {
                            $notif_id = $row['notif_id'];
                            $title = $row['title'];
                            $details = $row['details'];
                            $notif_type = $row['notif_type'];
                            $date = $row['formatted_notif_date'];

                            if ($notif_type == 'success') {
                                $bg_color = '#286e28';
                            } else if ($notif_type == 'warning') {
                                $bg_color = '#8B0021';
                            } else {
                                $bg_color = '#3D3D3D';
                            }

                ?>
                            <div class="notif-card" style="background: <?php echo $bg_color; ?>;">
                                <span class="notif-header">
                                    <p class="notif-title"><?php echo $title; ?> </p>
                                    <button class="view_btn" data-id="<?php echo $notif_id; ?>" style=" height: 40px; width: 16vh;">
                                        View Details
                                    </button>
                                    <p>|</p>
                                    <form action="../../functions/server/remove_notifications.php" method="POST" class="rm_form">
                                        <button type="submit" name="remove_notif" class="deletePostButton close-icon" value="<?php echo $notif_id; ?>">
                                            <i class="fa-solid fa-xmark fa-2xl" style="color: #ffffff; cursor: pointer;"></i>
                                        </button>
                                    </form>
                                </span>
                                <span class="notif-details" id="detailsContainer<?php echo $notif_id; ?>">
                                    <p> <?php echo $details; ?></p>
                                    <p> <small style="color:darkgray"><?php echo $date; ?></small></p>
                                </span>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../../assets/jquery/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).ready(function() {
            // Hide notif-details on page load
            $(".notif-details").hide();

            // Handle click event for each "View Details" button
            $(".view_btn").click(function() {
                // Toggle visibility of notif-details
                var notifId = $(this).data('id');
                $("#detailsContainer" + notifId).slideToggle();
            });
        });


        $(document).on('click', '.deletePostButton', function(e) {
            e.preventDefault();

            let notif_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../../functions/server/remove_notifications.php',
                data: {
                    'delete_notif': true,
                    'notif_id': notif_id
                },
                success: function(response) {
                    let res = jQuery.parseJSON(response);
                    alertify.set('notifier', 'position', 'top-center');
                    if (res.status == 200) {
                        let notif = alertify.success(res.message);
                        $('body').one('click', function() {
                            notif.dismiss();
                        });
                        window.location.reload();

                    } else if (res.status == 500) {
                        let notif = alertify.error(res.message);
                        $('body').one('click', function() {
                            notif.dismiss();
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>