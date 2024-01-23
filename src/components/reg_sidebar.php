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


  <!-- JQUERY -->
  <script src="../assets/jquery/jquery.js"></script>

  <!-- AJAX WITH JAVASCRIPT -->
  <script>
    $(document).ready(function() {
      $("#home").click(function() {
        event.preventDefault();
        $("#content").load("../after_auth/regular/reg_homepage.php")
      });
      $("#appliance").click(function() {
        event.preventDefault();
        $("#content").load("../after_auth/regular/reg_myAppliancePage.php")
      });
      $("#settings").click(function() {
        event.preventDefault();
        $("#content").load("../after_auth/regular/reg_settings.php")
      });
      $("#notification").click(function() {
        event.preventDefault();
        $("#content").load("../after_auth/regular/reg_notification.php")
      });
      $("#manual").click(function() {
        event.preventDefault();
        $("#content").load("../after_auth/regular/reg_userManual.php")
      });
    });
  </script>

  <title>HEO APP</title>

  <!-- debug -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

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