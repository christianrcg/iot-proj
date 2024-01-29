<?php
require_once('../database/db_connect.php');

if (isset($_POST['update_app'])) {
    $list_id = mysqli_escape_string($conn, $_POST['list_id_edit']);
    $app_id = mysqli_escape_string($conn, $_POST['app_id']);
    $quantity = mysqli_escape_string($conn, $_POST['quantity']);
    $consumption = mysqli_escape_string($conn, $_POST['consumption']);
    $user_id =  mysqli_escape_string($conn, $_POST['user_id']);

    $update_sql = "UPDATE app_list_of_users AS alu
                        JOIN appliances AS a ON a.app_id = alu.app_id
                        SET 
                        alu.quantity = '$quantity',
                         alu.consumption_by_quantity = '$consumption',
                         alu.app_id = '$app_id'
                            WHERE alu.list_id = '$list_id';
    ";

    $query_run = mysqli_query($conn, $update_sql);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'List Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Post Update Failed'
        ];
        echo json_encode($res);
        return;
    }
}
