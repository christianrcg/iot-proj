<?php

function getElectrictyRate()
{
    global $conn;
    $config_id = 1;
    $sql = "SELECT 
                electricity_rate
            FROM 
                global_config
                WHERE 
                config_id='$config_id'";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $electricityRate = $row['electricity_rate'];
        return $electricityRate;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
