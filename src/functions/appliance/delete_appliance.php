<?php
require_once('../database/db_connect.php');
include_once '../server/create_notif.php';
include_once 'get_app_by_list_id.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $list_id = $_POST['list_id'];

    //retrieve app details by
    $app_details = getAppDetails($list_id);
    $app_brand = $app_details['app_brand'];
    $app_model = $app_details['app_model'];

    $delete_sql = "DELETE FROM app_list_of_users WHERE list_id='$list_id'";

    if (mysqli_query($conn, $delete_sql)) {
        $notif_title = "Appliance removed from the list";
        $notif_details = 'The appliance <b>removed</b> in your appliances list is: <b> ' . $app_brand . ', ' . $app_model . '</b>. See your list in the <a href="reg_myAppliancePage.php"><b> My Appliance Page. </b></a>';
        $notif_type = "info";
        create_notif($notif_title, $notif_details, $notif_type, $user_id);
    } else {
        echo "Error: " . $delete_sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
