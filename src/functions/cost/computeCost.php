<?php
include_once '../../functions/server/getElectricityRate.php';

$electricityRate = getElectrictyRate();


function computeCost($kilowatts)
{
    global $electricityRate;
    $computedCost = (float) $kilowatts * $electricityRate;
    return $computedCost;
}

function setMonthlyCost($user_id, $monthlyKWH) //2nd parameter is cost of kWh per month.
{
    global $conn;
    $sql = "INSERT INTO consumption (user_id, monthly_cost) 
                VALUES ('$user_id', '$monthlyKWH')
                ON DUPLICATE KEY UPDATE
                monthly_cost = VALUES(monthly_cost)";
    $result = $conn->query($sql);
    if ($result) {
        return;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
