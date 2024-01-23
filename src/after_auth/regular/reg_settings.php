<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_notification.css">
    <title>HEO | Settings</title>
    <!-- browser site icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/browser-icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/browser-icon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/browser-icon/site.webmanifest">
    <!-- additional css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="settings">
        <div class="settings-text">
            <h1>Settings</h1>
        </div>

        <main class="content-cont">
            <section class="section-cont mb-m">
                <div class="section-header">
                    <p> Account Settings</p>
                    <span class="btn-cont">
                        <button class="btn-header" id="">
                            <a href="../../before_auth/landingpage.php"> Switch Account</a>
                            <i class="fa-solid fa-circle-user fa-sm icons" style="color: #efc135;"></i>
                        </button>
                        <button class="btn-header" id="">
                            Logout
                            <i class="fa-solid fa-right-from-bracket fa-sm icons" style="color: #8b0021;"></i>
                        </button>
                    </span>
                </div>
                <div class="section-body">
                    <span class="input-span">
                        <div class="input-cont">
                            <label for=""> Username:</label>
                            <div class="input-group">
                                <i class="fa-regular fa-user fa-sm icons" style="color: #646464;"></i>
                                <input type="text" name="username" placeholder="username">
                                <button class="edit-btn" type="submit">
                                    <i class="fa-regular fa-pen-to-square fa-sm icons" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-cont">
                            <label for=""> Email:</label>
                            <div class="input-group">
                                <i class="fa-regular fa-envelope fa-sm" style="color: #646464;"></i>
                                <input type="email" name="email" placeholder="username">
                                <button class="edit-btn" type="submit">
                                    <i class="fa-regular fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>
                    </span>
                    <div class="divider"></div>
                    <span class="input-span-col">
                        <div class="input-cont space-bw">
                            <label for=""> Change Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" placeholder="">
                            </div>
                        </div>
                        <div class="input-cont space-bw">
                            <label for=""> Retype Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" placeholder="">
                            </div>
                        </div>
                        <div class="input-cont flex-end">
                            <button input type="submit" id="save-pass-btn" class="b-sdw"> Save Changes</button>
                        </div>
                    </span>
                </div>
            </section>
            <section class="section-cont">
                <div class="section-header">
                    <p> Account Settings</p>
                </div>
                <div class="section-body">
                    <span class="input-span-col">
                        <div class="input-cont flex-start">
                            <label for=""> Location:</label>
                            <div class="input-group">
                                <i class="fa-solid fa-location-dot fa-sm" style="color: #A598F6;"></i>
                                <input type="text" name="text" placeholder="">
                                <button class="edit-btn" type="submit">
                                    <i class="fa-solid fa-pen-to-square fa-sm" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-cont flex-start">
                            <label> Notifications:</label>
                            <div class="notif-group">
                                <i class="fa-regular fa-bell fa-lg" style="color: #ffffff;"></i>
                                <label class="switch" for="checkbox">
                                    <input type="checkbox" id="checkbox" />
                                    <div class="slider round"></div>
                                </label>
                            </div>
                        </div>
                    </span>
                </div>
            </section>
        </main>
    </div>

    <script src="../../assets/jquery/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>