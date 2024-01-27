<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/style/admin_sidebar.css">

  <!-- browser site icon -->
  <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/browser-icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/browser-icon/favicon-16x16.png">
  <link rel="manifest" href="../../assets/img/browser-icon/site.webmanifest">

</head>

<body>

  <div class="sidebar">

    <div class="sidebar-content">
      <div class="logo-container">
        <img src="../../assets/img/logo.png" alt="">
      </div>

      <div class="links">
        <a href="../admin/admin_homepage.php">Dashboard</a>

        <span class="separator">/</span>
        <p></p>

        <a href="../admin/admin_feedbackspage.php">
          Feedbacks
          <?php
            // Query to get feedback count
          $countQuery = "SELECT COUNT(*) AS feedback_count FROM user_feedback";
          $countResult = mysqli_query($conn, $countQuery);

          // Fetch the count
          $feedbackCount = mysqli_fetch_assoc($countResult)['feedback_count'];
          ?>

          <!-- Display the feedback count badge -->
          <?php echo ($feedbackCount > 0) ? "<span class='badge' style='border: solid 1px red; border-radius: 10px; margin-left: 20px; padding: 10px; color: white; background-color: red;'>$feedbackCount</span>" : ""; ?>
        </a>

        <span class="separator">/</span>
        <p></p>

      </div>
    </div>

  </div>

  <!-- <div class="content" id="content">

  </div> -->

</body>

</html>
