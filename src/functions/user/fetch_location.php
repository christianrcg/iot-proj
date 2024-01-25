<?php

function getLocationData($user_id)
{
    global $conn;
    $sql = "SELECT * FROM `locations` WHERE user_id=$user_id";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
        return $data;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
