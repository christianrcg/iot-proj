<?php

function fetchRecords($user_id)
{
    global $conn;
    $record = array();
    $sql = "SELECT  ROUND(COALESCE(january, 0) / 1000, 2) as Jan, 
    ROUND(COALESCE(february, 0) / 1000, 2) as Feb, 
    ROUND(COALESCE(march, 0) / 1000, 2) as Mar, 
    ROUND(COALESCE(april, 0) / 1000, 2) as Apr, 
    ROUND(COALESCE(may, 0) / 1000, 2) as May,
    ROUND(COALESCE(june, 0) / 1000, 2) as Jun,
    ROUND(COALESCE(july, 0) / 1000, 2) as Jul,
    ROUND(COALESCE(august, 0) / 1000, 2) as Aug, 
    ROUND(COALESCE(september, 0) / 1000, 2) as Sept, 
    ROUND(COALESCE(october, 0) / 1000, 2) as Oct, 
    ROUND(COALESCE(november, 0) / 1000, 2) as Nov,
    ROUND(COALESCE(december, 0) / 1000, 2) as Decm
    FROM user_records_monthly
                    WHERE user_id='$user_id'
                    ";
    $res = mysqli_query($conn, $sql);

    if ($row = $res->fetch_assoc()) {
        $jan = $row['Jan'];
        $feb = $row['Feb'];
        $mar = $row['Mar'];
        $apr = $row['Apr'];
        $may = $row['May'];
        $jun = $row['Jun'];
        $jul = $row['Jul'];
        $aug = $row['Aug'];
        $sept = $row['Sept'];
        $oct = $row['Oct'];
        $nov = $row['Nov'];
        $dec = $row['Decm'];

        $record = [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sept, $oct, $nov, $dec];
        return $record;
    }

    return $record;
}
