<?php
require_once('../database/db_connect.php');
session_start();

include_once('../server/create_notif.php');

if (isset($_POST['notif_setting'])) {
    $notifSetting = $conn->real_escape_string($_POST['notif_setting']);
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE users SET notif_settings = '$notifSetting' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $notif_title = "Notification Enabled";
        $notif_details = "You have enabled notification for the HEO APP";
        $notif_type = "success";
        create_notif($notif_title, $notif_details, $tnotif_type, $user_id);
    } else {
        echo "Error updating notification settings: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
