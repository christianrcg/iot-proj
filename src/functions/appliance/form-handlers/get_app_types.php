<?php
require_once('../../database/db_connect.php');
$sql = "SELECT DISTINCT app_type FROM appliances";
$result = mysqli_query($conn, $sql);

$blank = '';
if (mysqli_num_rows($result) > 0) {
    echo "<option value='" . $blank . "'>" . $blank . "</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['app_type'] . "'>" . $row['app_type'] . "</option>";
    }
} else {
    echo "<option value=''>No app types found</option>";
}

mysqli_close($conn);
