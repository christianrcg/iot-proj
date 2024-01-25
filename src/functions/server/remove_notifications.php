<?php
require_once '../database/db_connect.php';

if (isset($_POST['submit'])) {
    $notif_id = $_POST['notif_id'];

    $sql = "DELETE FROM notifications WHERE notif_id = $notif_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: /src/after_auth/regular/reg_notification.php");
    } else {
        print_r($notif_id);
        var_dump($notif_id);
        echo "Error deleting notification: " . $conn->error;
    }

    exit();
}
