<?php
require_once('../database/db_connect.php');

if (isset($_POST['app_status']) && isset($_POST['list_id'])) {
    $app_status = $conn->real_escape_string($_POST['app_status']);
    $list_id = $conn->real_escape_string($_POST['list_id']);
    $sql = "UPDATE app_list_of_users SET status= '$app_status' WHERE list_id = '$list_id'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating notification settings: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
