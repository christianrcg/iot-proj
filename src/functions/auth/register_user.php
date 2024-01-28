<?php
require_once('../database/db_connect.php');

if (isset($_POST['register_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    //Hash Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //if the fields are not null, checks if the inputted username has a duplicate in existing table
    $checkUsernameQuery = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $sameUsernameExists = mysqli_fetch_assoc($checkUsernameQuery);

    if ($sameUsernameExists) {
        $res = [
            'status' => 409,
            'message' => 'Username already taken'
        ];
        echo json_encode($res);
        return;
    }

    //if the username is available -> proceeds to insert the username
    $registerUserQuery = mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email','$hashed_password')");
    if ($registerUserQuery) {
        $res = [
            'status' => 200,
            'message' => 'User Created'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        echo json_encode($res);
        return;
    }
}
