<?php

function setHourlyConsumption($user_id, $userListConsumption)
{
    global $conn;
    $sql = "INSERT INTO consumption (user_id, hourly_consumption) 
                VALUES ('$user_id', '$userListConsumption') 
                ON DUPLICATE KEY UPDATE
                hourly_consumption = VALUES(hourly_consumption) ";
    $result = $conn->query($sql);
    if ($result) {
        return;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
