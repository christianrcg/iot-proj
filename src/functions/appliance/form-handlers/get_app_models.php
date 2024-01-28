<?php
require_once('../../database/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['app_type']) && isset($_POST['app_brand'])) {
    // Retrieve selected app_type and app_brand from the POST data
    $selectedAppType = $_POST['app_type'];
    $selectedAppBrand = $_POST['app_brand'];

    // Perform SQL query to retrieve distinct app_model options based on selected app_brand
    $sql = "SELECT DISTINCT app_model FROM appliances WHERE app_type = '$selectedAppType' AND app_brand = '$selectedAppBrand'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Output data of each row as options for app_model select input
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['app_model'] . "'>" . $row['app_model'] . "</option>";
        }
    } else {
        echo "<option value=''>No app models found</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}

// Close the database connection
mysqli_close($conn);
