<?php
require_once('../functions/database/db_connect.php');
include_once '../functions/server/create_notif.php';

$new_user_sql = "SELECT user_id, username FROM users ORDER BY user_id DESC LIMIT 1";

$sql_fetch_run = mysqli_query($conn, $new_user_sql);

if ($sql_fetch_run) {
    $data = $sql_fetch_run->fetch_assoc();
    $user_id = $data['user_id'];
    $username = $data['username'];

    $notif_title = 'Welcome to Home Electricity Optimization App! <b>' . $username . '</b>';
    $notif_details = 'The HEO App optimizes home electricity. Track usage, analyze patterns, save on bills. Welcome to efficient energy management!
     <p> Want to know where to start? See the<b><a href="reg_userManual.php"> User Manual Page </a></b></p>
    ';
    $notif_type = 'success';
    create_notif($notif_title, $notif_details, $notif_type, $user_id);
    header('Location: loginpage.php');
} else {
    echo 'Error' . mysqli_error($conn);
}
