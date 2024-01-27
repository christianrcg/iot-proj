<?php
require_once '../database/db_connect.php';

if (isset($_POST['remove_feedback'])) {
    // Sanitize the input
    $feedback_id = $_POST['remove_feedback'];
    $feedback_id = (int)$feedback_id;

    // Validate and perform the deletion
    if (is_numeric($feedback_id)) {
        // Prepare your SQL query to delete the feedback using a parameterized query
        $sql = "DELETE FROM user_feedback WHERE feedback_id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $feedback_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if ($result) {
            echo "<script> alert('Feedback with ID " . $feedback_id . " has been successfully deleted.')</script>";
            header("Location: /iot-proj/src/after_auth/admin/admin_feedbackspage.php");
            exit();
        } else {
            echo "Error deleting Message: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid Feedback ID provided.";
    }
} else {
    echo "Feedback ID not provided.";
}
?>
