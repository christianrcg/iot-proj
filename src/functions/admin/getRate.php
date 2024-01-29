<?php

function getRateConfig()
{
    global $conn;

    $sql_config = "SELECT electricity_rate FROM global_config WHERE config_id=1";

    $query_run = $conn->query($sql_config);

    if ($query_run) {
        $data = $query_run->fetch_assoc();
        $rate = $data['electricity_rate'];
        return $rate;
    } else {
        echo 'Error' . mysqli_error($conn);
        return null;
    }
}
