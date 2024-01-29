<?php

function getHourlyConsumption($user_id)
{
    global $conn;
    $sql = "SELECT 
                hourly_consumption
            FROM 
                consumption
                WHERE 
                user_id='$user_id'";
    $result = $conn->query($sql);
    if ($result) {
        $hourlyConsumption = $result->fetch_assoc();
        $hourlyConsumption = (float) $hourlyConsumption['hourly_consumption'];
        return $hourlyConsumption;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
