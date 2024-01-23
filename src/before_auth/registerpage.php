<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEO | Register</title>
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
            <div class="section-content">
                <form id="registerUserForm">
                    <div class="input-cont">
                        <label for="email"> Email </label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input-cont">
                        <label for="username"> Username </label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="input-cont mb-s">
                        <label for="password"> Password </label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-cont center mb-s">
                        <button class="btn-main" type="submit">Register</button>
                    </div>
                    <div class="input-cont center">
                        <p>Have an account? <a href="loginpage.php">Login</a></p>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="../assets/jquery-3.7.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#registerUserForm', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append("register_user", true);

            $.ajax({
                type: 'POST',
                url: '../functions/auth/register_user.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    let res = jQuery.parseJSON(response);
                    alertify.set('notifier', 'position', 'top-center');

                    if (res.status == 200) {
                        let alertModal = alertify.alert()
                            .setting({
                                'label': 'Redirect',
                                'message': res.message + ' Redirect to Login Page?',
                                'onok': function() {
                                    alertify.success(res.message + ' Redirecting to Login Page');
                                    setTimeout(function() {
                                        window.location.href = 'loginpage.php';
                                    }, 1500);
                                }
                            });
                        alertModal.setHeader('<p><i class="fa-regular fa-circle-check" style="color: #009439;"></i> &nbsp Success</p>');
                        alertModal.show();

                    } else if (res.status == 409 || res.status == 500) {
                        let alertModal = alertify.alert()
                            .setting({
                                'label': 'Retry',
                                'message': res.message,
                            });
                        alertModal.setHeader('<p><i class="fa-regular fa-circle-xmark" style="color: #c83c3c;"></i> &nbsp Error</p>');
                        alertModal.show();
                    }
                }
            });
        });
    </script>
</body>

</html>