<?php
require_once '../database/db_connect.php';
session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update_email'])) {
        $new_email = $conn->real_escape_string($_POST['email']);
        $sql = "UPDATE users SET email = '$new_email' WHERE user_id = $user_id";
        $query_run = mysqli_query($conn, $sql);
        if ($query_run === true) {
            echo '<script> window.location.href = "../../after_auth/regular/reg_settings.php";</script>';
        } else {
            echo '<script>alert("Update Failed"); window.location.href = "../../after_auth/regular/reg_settings.php";</scripwindow.location.href>';
        }
        mysqli_close($conn);
    } else if (isset($_POST['update_username'])) {
        $new_username = $conn->real_escape_string($_POST['username']);
        $sql = "UPDATE users SET username = '$new_username' WHERE user_id = $user_id";
        $query_run = mysqli_query($conn, $sql);
        if ($query_run === true) {
            echo '<script>alert("Update Successfully"); window.location.href = "../../after_auth/regular/reg_settings.php";</script>';
        } else {
            echo '<script>alert("Update Failed"); window.location.href = "../../after_auth/regular/reg_settings.php";</script>';
        }
        mysqli_close($conn);
    }
}
