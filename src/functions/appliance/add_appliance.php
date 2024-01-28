<?php
require_once('../database/db_connect.php');
include_once '../server/create_notif.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data

    $user_id = $_POST['user_id'];
    $app_id = $_POST['app_id'];
    $quantity = $_POST['quantity'];
    $consumption = $_POST['consumption'];
    $status = 'on';

    $app_brand = $_POST['app_brand'];
    $app_model = $_POST['app_model'];

    // You may need additional validation and sanitization here

    // Perform database insertion
    $sql = "INSERT INTO app_list_of_users (user_id, app_id, status, quantity, consumption_by_quantity) 
            VALUES ('$user_id', '$app_id', '$status', '$quantity', '$consumption')";

    if (mysqli_query($conn, $sql)) {
        $notif_title = "Successfully added a new appliance to your list";
        $notif_details = 'The appliance included in your appliances list is: <b> ' . $app_brand . ', ' . $app_model . '</b>. Based on the quantity: ' . $quantity . ' the electricty consumption is: ' . $consumption . 'watts. See your updated list in the <a href="reg_myAppliancePage.php"><b> My Appliance Page. </b></a>';
        $notif_type = "success";
        create_notif($notif_title, $notif_details, $notif_type, $user_id);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
