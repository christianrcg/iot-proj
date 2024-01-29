<?php
require_once('../database/db_connect.php');

if (isset($_GET['list_id'])) {
    $list_id = mysqli_real_escape_string($conn, $_GET['list_id']);
    $getAppQuery = "SELECT 
        a.app_id, 
        a.app_type, 
        a.app_brand, 
        a.app_model, 
        a.consumption, 
        a.image, 
        a.image_filename,
        COALESCE(alu.list_id, NULL) as list_id,
        COALESCE(alu.quantity, 1) as quantity,
        COALESCE(alu.status, 'off') as status,
        COALESCE(alu.consumption_by_quantity, '0') as consumption_by_quantity
    FROM 
        appliances a
    LEFT JOIN 
        app_list_of_users alu ON a.app_id = alu.app_id
        WHERE 
        alu.list_id = '$list_id'";

    $query_run = mysqli_query($conn, $getAppQuery);

    if (mysqli_num_rows($query_run) == 1) {
        $app = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'App list Fetch Successfully by id',
            'data' => $app
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'List Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
