<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/style/sidebar.css">
  <link rel="stylesheet" href="../after_auth/regular/style/reg_homepage.css">

</head>

<body>

  <div class="sidebar">

    <div class="sidebar-content">
      <div class="logo-container">
        <img src="../assets/img/logo.png" alt="">
      </div>

      <div class="links">
        <a href="#home">Home</a>

        <span class="separator">/</span>
        <p></p>

        <a href="#news">My Appliances</a>

        <span class="separator">/</span>
        <p></p>

        <a href="#contact">Settings</a>

        <span class="separator">/</span>
        <p></p>
        
        <a href="#about">Notification</a>

        <span class="separator">/</span>
        <p></p>
        
        <a href="#about">User Manual</a>

        <p></p>
      </div>
    </div>

  </div>

  <div class="content">
    <?php
      include("../after_auth/regular/reg_homepage.php");
    ?>
  </div>

</body>

</html>