<?php

function getDailyConsumption($user_id)
{
    global $conn;
    $sql = "SELECT 
                daily_consumption
            FROM 
                consumption
                WHERE 
                user_id='$user_id'";
    $result = $conn->query($sql);
    if ($result) {
        $dailyConsumption = $result->fetch_assoc();
        $dailyConsumption = (float)$dailyConsumption['daily_consumption'];
        return $dailyConsumption;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
