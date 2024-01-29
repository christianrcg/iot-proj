<?php
// Include the database connection file
require_once('../../functions/database/db_connect.php');

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $feedbackMessage = mysqli_real_escape_string($conn, $_POST['feedback_message']);

    // Retrieve user information from the session or another source
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    // Insert feedback into the user_feedback table
    $insertSql = "INSERT INTO user_feedback (username, email, message) VALUES ('$username', '$email', '$feedbackMessage')";
    $insertResult = mysqli_query($conn, $insertSql);

    if (!$insertResult) {
        die("Error inserting feedback: " . mysqli_error($conn));
    } else {
        echo "Feedback inserted successfully!"; // Debug output
        // Redirect or show a success message
        header("Location: ../../after_auth/regular/reg_userManual.php"); // Redirect to the user dashboard
        exit();
    }
} else {
    // Handle invalid request method
    echo "Invalid request method";
}
