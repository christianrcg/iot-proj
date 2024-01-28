<?php

function setDailyConsumption($user_id, $hourlyConsumption)
{
    global $conn;
    $dailyConsumption = $hourlyConsumption * 24;
    $sql = "INSERT INTO consumption (user_id, daily_consumption) 
                VALUES ('$user_id', '$dailyConsumption') 
                ON DUPLICATE KEY UPDATE
                daily_consumption = VALUES(daily_consumption) ";
    $result = $conn->query($sql);
    if ($result) {
        // do nothing
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
