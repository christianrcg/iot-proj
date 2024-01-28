<?php
include_once 'create_notif.php';

function checkExceededBudget($user_id)
{
    global $conn;
    $monthlyCost = 0;
    $userBudget = 0;

    $budget_cost_sql = "SELECT budget, monthly_cost FROM consumption WHERE user_id='$user_id'";
    $bc_sql_run = mysqli_query($conn, $budget_cost_sql);

    if ($bc_sql_run) {
        $result_row = mysqli_fetch_assoc($bc_sql_run);
        $userBudget = $result_row['budget'];
        $monthlyCost = $result_row['monthly_cost'];
    } else {
        echo 'Error: ' . mysqli_error($conn);
        return null;
    }

    if ($monthlyCost >   $userBudget) {
        $notif_title = "You have exceeded your budget cost!";
        $notif_details = 'Your budget <b>₱' . $userBudget . '</b> has exceeded to your monthly appliances cost this month which is: <b>₱' . $monthlyCost . '</b>. Adjust your <a href="reg_myAppliancePage.php">appliance list</a>';
        $notif_type = "warning";
        create_notif($notif_title, $notif_details, $notif_type, $user_id);
    } else {
        return null;
    }

    // $conn->close();
}
