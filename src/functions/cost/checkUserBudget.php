<?php

function checkUserBudget($user_id)
{
    global $conn;
    $sql_for_budget = "SELECT budget FROM consumption WHERE user_id='$user_id'";
    $budget_record = mysqli_query($conn, $sql_for_budget);
    $budget = 0;
    if ($budget_record) {
        if (mysqli_num_rows($budget_record) > 0) {
            $row = mysqli_fetch_assoc($budget_record);
            return $budget = $row['budget'];
        } else {
            return $budget = 0;
        }
        mysqli_free_result($budget_record);
    } else {
        return $budget = 0;
    }
}
