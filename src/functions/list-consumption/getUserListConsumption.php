<?php

function getUserAppListConsumption($user_id)
{
    $currentAppListConsumption = 0; //initialize a number variable
    global $conn;
    $sql = "SELECT 
                COALESCE(consumption_by_quantity, 0) as consumption_by_quantity
            FROM 
                app_list_of_users
                WHERE 
                user_id='$user_id' && status='on'";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Add each consumption value to the total
            $currentAppListConsumption += $row['consumption_by_quantity'];
        }
        // Return the total consumption
        return $currentAppListConsumption;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
