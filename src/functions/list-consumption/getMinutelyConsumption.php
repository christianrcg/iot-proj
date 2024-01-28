<?php

function getMinutelyConsumption($user_id)
{
    global $conn;
    $sql = "SELECT 
                minutely_consumption
            FROM 
                consumption
                WHERE 
                user_id='$user_id'";
    $result = $conn->query($sql);
    if ($result) {
        $minutelyConsumption = $result->fetch_assoc();
        $minutelyConsumption = (float)$minutelyConsumption['minutely_consumption'];
        return $minutelyConsumption;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
