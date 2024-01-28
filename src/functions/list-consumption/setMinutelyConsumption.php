<?php

function setMinutelyConsumption($user_id, $hourlyConsumption)
{
    global $conn;
    $minutelyConsumption = $hourlyConsumption / 60;
    $sql = "INSERT INTO consumption (user_id, minutely_consumption) 
                VALUES ('$user_id', '$minutelyConsumption') 
                ON DUPLICATE KEY UPDATE
                minutely_consumption = VALUES(minutely_consumption) ";
    $result = $conn->query($sql);
    if ($result) {
        return;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
