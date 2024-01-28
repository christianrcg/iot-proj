<?php

// require_once('../database/db_connect.php');

include 'getUserListConsumption.php';
include_once 'setHourlyConsumption.php';
include_once 'getHourlyConsumption.php';
include_once 'setMinutelyConsumption.php';
include_once 'getMinutelyConsumption.php';
include_once 'setDailyConsumption.php';
include_once 'getDailyConsumption.php';
include_once 'setMonthlyConsumption.php';
include_once 'getMonthlyConsumption.php';

include_once 'convertToKWH.php';


//pipeline logic
$UserListConsumption = getUserAppListConsumption($user_id); //get user list consumption summation

setHourlyConsumption($user_id, $UserListConsumption);  //sets hourly consumption based on user list

$hourlyConsumption = getHourlyConsumption($user_id);


setMinutelyConsumption($user_id, $hourlyConsumption);
$minutelyConsumption = getMinutelyConsumption($user_id);


setDailyConsumption($user_id, $hourlyConsumption);

$dailyConsumption = getDailyConsumption($user_id);
setMonthlyConsumption($user_id, $dailyConsumption);
$monthlyConsumption = getDailyConsumption($user_id);


function getAllConsumptionDetails($user_id)
{
    global $conn;
    $sql = "SELECT 
                minutely_consumption,
                hourly_consumption,
                daily_consumption,
                monthly_consumption
            FROM 
                consumption
            WHERE 
                user_id='$user_id'";

    $result = $conn->query($sql);
    if ($result) {
        $allConsumptionDetails = array();
        while ($row = $result->fetch_assoc()) {
            // Construct an associative array where keys are the column names
            // and values are the corresponding values from the database
            $allConsumptionDetails[] = array(
                'minutely_consumption' => $row['minutely_consumption'],
                'hourly_consumption' => $row['hourly_consumption'],
                'daily_consumption' => $row['daily_consumption'],
                'monthly_consumption' => $row['monthly_consumption']
            );
        }
        return $allConsumptionDetails;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return array(); // Return an empty array if there's an error
    }
}

function convertDetailsToKWH($allConsumptionDetails)
{
    if (is_array($allConsumptionDetails)) {
        foreach ($allConsumptionDetails as &$detail) {
            // Convert each element of the array to KWH
            foreach ($detail as $key => $value) {
                $detail[$key] = convertTOKWH($value);
            }
        }
        unset($detail); // Unset reference variable to avoid conflicts
    } else {
        echo "Error: The input is not an array";
    }
    return $allConsumptionDetails;
}
