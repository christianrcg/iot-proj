<?php
require_once('../../database/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['app_type']) && isset($_POST['app_brand']) && isset($_POST['app_model'])) {
    // Retrieve selected app_type, app_brand, and app_model from the POST data
    $selectedAppType = $_POST['app_type'];
    $selectedAppBrand = $_POST['app_brand'];
    $selectedAppModel = $_POST['app_model'];

    // Perform SQL query to retrieve additional info based on selected app_type, app_brand, and app_model
    $sql = "SELECT app_id, consumption, image FROM appliances WHERE app_type = '$selectedAppType' AND app_brand = '$selectedAppBrand' AND app_model = '$selectedAppModel'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $additionalInfo = array(
            'app_id' => $row['app_id'],
            'consumption' => $row['consumption'],
            'image' => $row['image']
        );
        echo json_encode($additionalInfo);
    } else {
        echo json_encode(array('error' => 'No additional info found'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request'));
}

// Close the database connection
mysqli_close($conn);
