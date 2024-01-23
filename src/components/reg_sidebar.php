<?php
require_once('../functions/database/db_connect.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/style/reg_sidebar.css">

  <!-- browser site icon -->
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/browser-icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/browser-icon/favicon-16x16.png">
  <link rel="manifest" href="../assets/img/browser-icon/site.webmanifest">

  <!-- PAGES CSS -->
  <link rel="stylesheet" href="../after_auth/regular/style/reg_homepage.css">
  <link rel="stylesheet" href="../after_auth/regular/style/reg_myAppliancePage.css">
  <link rel="stylesheet" href="../after_auth/regular/style/reg_notification.css">
  <link rel="stylesheet" href="../after_auth/regular/style/reg_settings.css">
  <link rel="stylesheet" href="../after_auth/regular/style/reg_userManual.css">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>



  <!-- AJAX WITH JAVASCRIPT -->
  <script>
    $(document).ready(function() {
      $("#home").click(function() {
        $("#content").load("../after_auth/regular/reg_homepage.php")
      });
      $("#appliance").click(function() {
        $("#content").load("../after_auth/regular/reg_myAppliancePage.php")
      });
      $("#settings").click(function() {
        $("#content").load("../after_auth/regular/reg_settings.php")
      });
      $("#notification").click(function() {
        $("#content").load("../after_auth/regular/reg_notification.php")
      });
      $("#manual").click(function() {
        $("#content").load("../after_auth/regular/reg_userManual.php")
      });
    });
  </script>

</head>

<body>

  <div class="sidebar">

    <div class="sidebar-content">
      <div class="logo-container">
        <img src="../assets/img/logo.png" alt="">
      </div>

      <div class="links">
        <a id="home">Home</a>

        <span class="separator">/</span>
        <p></p>

        <a id="appliance">My Appliances</a>

        <span class="separator">/</span>
        <p></p>

        <a id="settings">Settings</a>

        <span class="separator">/</span>
        <p></p>

        <a id="notification">Notification</a>

        <span class="separator">/</span>
        <p></p>

        <a id="manual">User Manual</a>

        <p></p>
      </div>
    </div>

  </div>

  <div class="content" id="content">
    <?php
    include("../after_auth/regular/reg_homepage.php");
    ?>
  </div>

</body>

</html>