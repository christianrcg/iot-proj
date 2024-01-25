<?php
require_once('../functions/database/db_connect.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEO | Login</title>
    <link rel="stylesheet" href="../assets/style/register-login.css">
    <!-- browser site icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/browser-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/browser-icon/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/browser-icon/site.webmanifest">
    <!-- additional css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main class="main-cont">
        <section class="section-cont">
            <img src="../assets/img/LOGO-removebg-preview.png">
        </section>
        <section class="section-cont">
            <div class="section-content box-shadow">
                <form id="loginUserForm">
                    <div class="input-cont">
                        <label for="username"> Username </label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="input-cont mb-zero">
                        <label for="password"> Password </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-cont forgot-password">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=gabrielarcega01@gmail.com" target="_blank">Forgot Password?</a>
                    </div>
                    <div class="input-cont center mb-s">
                        <button class="btn-main box-shadow" type="submit">Login</button>
                    </div>
                    <div class="input-cont center mb-zero">
                        <p>Don't have an account? <a href="registerpage.php" id="register_link">Register</a></p>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="../assets/jquery-3.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#loginUserForm', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("login_user", true);

            $.ajax({
                type: 'POST',
                url: '../functions/auth/login_user.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let res = jQuery.parseJSON(response);
                    alertify.set('notifier', 'position', 'top-center');

                    if (res.status == 200) {
                        let alertModal = alertify.alert()
                            .setting({
                                'label': 'OK',
                                'message': res.message + ' Go to Homepage?',
                                'onok': function() {
                                    alertify.success(res.message + ' Redirecting to Homepage');

                                    setTimeout(function() {
                                        if (res.user_role == 'admin') {
                                            window.location.href = '../after_auth/admin/admin_homepage.php'
                                        } else {
                                            window.location.href = '../after_auth/regular/reg_homepage.php'
                                        }
                                    }, 1500);
                                }
                            });
                        alertModal.setHeader('<p><i class="fa-regular fa-circle-check" style="color: #009439;"></i> &nbsp Login Successful</p>');
                        alertModal.show();

                    } else if (res.status == 500 || 401 || 404) {
                        let errorNotif = alertify.error(res.message);
                        errorNotif.setHeader('<p><i class="fa-regular fa-circle-xmark" style="color: #c83c3c;"></i> &nbsp Error</p>');
                        errorNotif.show();
                    }
                }
            });
        });
    </script>
</body>

</html>