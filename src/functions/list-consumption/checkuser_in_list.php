<?php
function check_user_in_list($user_id)
{
    global $conn;
    $sql = "SELECT user_id FROM app_list_of_users WHERE user_id=$user_id";
    $result = $conn->query($sql);
    if ($result) {
        return 1;
    } else {
        return 0;
    }
}
