<?php
require_once '../database/db_connect.php';
session_start();

include_once '../server/create_notif.php';

$user_id = $_SESSION['user_id'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

if ($new_password === $confirm_password) {
    $notif_title = "Password Updated";
    $notif_details = "You have updated for password";
    $notif_type = "success";
    create_notif($notif_title, $notif_details, $notif_type, $user_id);
    updatePassword($user_id, $new_password);
} else {
    echo '<script>
    alert("Password do not match");
    window.location.href = "reg_homepage.php";
    </script>';
}

function updatePassword($user_id, $new_password)
{
    global $conn;
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo  '<script>
        alert("Password Updated");
        window.location.href = "../../after_auth/regular/reg_settings.php"</script>';
    } else {
        echo "Error updating password: " . $conn->error;
    }
    $conn->close();
}
