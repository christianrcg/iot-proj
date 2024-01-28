<?php
include '../../functions/server/getCurrentMonth.php';

function setMonthlyConsumption($user_id, $dailyConsumption)
{
    global $conn;
    $monthlyConsumption = $dailyConsumption * 30;
    $sql = "INSERT INTO consumption (user_id, monthly_consumption) 
                VALUES ('$user_id', '$monthlyConsumption') 
                ON DUPLICATE KEY UPDATE
                monthly_consumption = VALUES(monthly_consumption) ";
    $result = $conn->query($sql);
    if ($result) {
        $currentMonthName = getCurrentMonthName();
        $currentYear = getCurrentYear();

        $monthly_record_sql = "INSERT INTO user_records_monthly (user_id, $currentMonthName, year) 
                    VALUES ('$user_id', '$monthlyConsumption', '$currentYear') 
                    ON DUPLICATE KEY UPDATE $currentMonthName = VALUES($currentMonthName), year = VALUES(year)";
        $monthly_record_sql_result = $conn->query($monthly_record_sql);
        if ($monthly_record_sql_result) {
            return;
        } else {
            "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
