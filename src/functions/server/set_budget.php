<?php
include_once 'create_notif.php';
$budget = $_POST['set_budget'];
$user_id = $_SESSION['user_id'];

function setBudget($user_id, $budget)
{
    global $conn;
    $sql = "INSERT INTO consumption (user_id, budget)
    VALUES ('$user_id', '$budget')
    ON DUPLICATE KEY UPDATE
    budget = VALUES(budget)";
    $result = $conn->query($sql);
    if ($result) {
        $notif_title = "Budget updated!";
        $notif_details = "You have updated your monthly budget with" . $budget . " pesos. We will notify you again if you exceeded this budget.";
        $notif_type = "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
