<?php

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

require_once '../database/db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];
include_once '../server/create_notif.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['budget'])) {
        $new_budget = $conn->real_escape_string($_POST['budget']);
        $sql = "INSERT INTO consumption (user_id, budget) VALUES ('$user_id', '$new_budget') ON DUPLICATE KEY UPDATE budget= VALUES(budget)";
        $query_run = mysqli_query($conn, $sql);
        if ($query_run === true) {
            $notif_title = "Budget updated!";
            $notif_details = 'Budget is set to: <b>₱' . $new_budget . '</b>. We will notify you if you have exceeded your set budget. For now see your updated <a href="reg_homepage.php"><b> Dashboard. </b></a>';
            $notif_type = "success";
            create_notif($notif_title, $notif_details, $notif_type, $user_id);
            echo '<script> window.location.href = "../../after_auth/regular/reg_homepage.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
