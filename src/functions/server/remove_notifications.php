<?php
require_once '../database/db_connect.php';

if (isset($_GET['remove_notif'])) {
    // Sanitize the input
    $notif_id = $_GET['remove_notif'];
    $notif_id = (int)$notif_id;
    // Validate and perform the deletion
    if (is_numeric($notif_id)) {
        // Prepare your SQL query to delete the notification
        $sql = "DELETE FROM notifications WHERE notif_id = $notif_id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the deletion was successful
        if ($result) {
            echo "<script> alert(Notification with ID" . $notif_id . " has been successfully deleted.)</script>";
            header("Location: /src/after_auth/regular/reg_notification.php");
            exit();
        } else {
            echo "Error deleting notification: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid notification ID provided.";
    }
} else {
    echo "Notification ID not provided.";
}
