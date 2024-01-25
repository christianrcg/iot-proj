<?php
require_once('../database/db_connect.php');
session_start();

if (isset($_POST['notif_setting'])) {
    $notifSetting = $conn->real_escape_string($_POST['notif_setting']);
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE users SET notif_settings = '$notifSetting' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Notification settings updated successfully";
    } else {
        echo "Error updating notification settings: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
