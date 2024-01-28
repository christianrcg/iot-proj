<?php
require_once('../../database/db_connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['app_type'])) {
    // Retrieve selected app_type from the POST data
    $selectedAppType = $_POST['app_type'];

    // Perform SQL query to retrieve distinct app_brand options based on selected app_type
    $sql = "SELECT DISTINCT app_brand FROM appliances WHERE app_type = '$selectedAppType'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Output data of each row as options for app_brand select input
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['app_brand'] . "'>" . $row['app_brand'] . "</option>";
        }
    } else {
        echo "<option value=''>No app brands found</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}

// Close the database connection
mysqli_close($conn);
