<?php

function getAppDetails($list_id)
{
    global $conn;
    $sql = "SELECT 
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
                alu.user_id = $list_id";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
        return $data;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return null;
    }
}
