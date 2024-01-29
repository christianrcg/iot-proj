<?php
require_once('../database/db_connect.php');

if (isset($_POST['edit-rate'])) {
    global $conn;
    $rateString = mysqli_escape_string($conn, $_POST['edit-rate']);
    $rate = (float)$rateString;

    $config_id = 1;
    $sql = "INSERT INTO global_config (config_id, electricity_rate) VALUES ('$config_id','$rate') 
    ON DUPLICATE KEY UPDATE electricity_rate=VALUES(electricity_rate)";

    $query_run  = mysqli_query($conn, $sql);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Electricity Rate updated successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
        echo json_encode($res);
        return;
    }
}
