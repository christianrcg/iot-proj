<?php

function getMonthlyConsumption($user_id)
{
    global $conn;
    $sql = "SELECT 
                monthly_consumption
            FROM 
                consumption
                WHERE 
                user_id='$user_id'";
    $result = $conn->query($sql);
    if ($result) {
        $monthlyConsumption = $result->fetch_assoc();
        $monthlyConsumption = (float)$monthlyConsumption['monthly_consumption'];
        return $monthlyConsumption;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
