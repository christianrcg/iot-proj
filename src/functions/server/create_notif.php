<?php

function create_notif($title, $details, $type, $user_id)
{
    global $conn;
    $sql = "INSERT INTO notifications (user_id, title, details, notif_type, notif_date)
    VALUES ('$user_id', '$title', '$details', '$type', CURRENT_TIMESTAMP)";
    $inserted = $conn->query($sql);

    if ($inserted) {
        return;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $conn->close();
}
