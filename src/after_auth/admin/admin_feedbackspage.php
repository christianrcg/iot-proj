<?php
require_once('../../functions/database/db_connect.php');
session_start();
include_once '../../components/admin_sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../admin/style/admin_feedbackspage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>HEO | User Feedbacks</title>
</head>

<body>
    <div class="content">
        <div class="feedback">
            <div class="feedback-text">
                <h1>Feedbacks</h1>
            </div>


            <div class="users-feedback">

                <table id="myTable">

                    <!-- TABLE HEADER -->

                    <tr class="table-header">
                        <th style="width:10%;">Name</th>
                        <th style="width:20%;">Email</th>
                        <th style="width:40%;">Message</th>
                        <th style="width:10%;">Action</th>
                    </tr>

                    <!-- TABLE BODY -->

                    <tr>
                        <td>Stanley123</td>
                        <td>BevAbi@gmail.com</td>
                        <td>Bruhhhhhhhhhhhhh!</td>
                        <td>
                            <div class="action-container">

                                <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Gabbbbbbbbb</td>
                        <td>bruhh@gmail.com</td>
                        <td>Genggggg Genggggg!</td>
                        <td>
                            <div class="action-container">

                                <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                            </div>
                        </td>
                    </tr>

                </table>

            </div>
        </div>

        <div class="not-available">
            <h1>"This Breakpoint is Under Development"</h1>
            <p>Please use the desktop mode for content availability!</p>
        </div>

    </div>


    </div>
</body>

</html>