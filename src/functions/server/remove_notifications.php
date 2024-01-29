<?php
require_once('../database/db_connect.php');

if (isset($_POST['delete_notif'])) {
    $notif_id = mysqli_real_escape_string($conn, $_POST['notif_id']);

    $deleteNotifQuery = "DELETE FROM notifications WHERE notif_id = '$notif_id'";
    $query_run = mysqli_query($conn, $deleteNotifQuery);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Deletion Failed'
        ];
        echo json_encode($res);
        return;
    }
}
