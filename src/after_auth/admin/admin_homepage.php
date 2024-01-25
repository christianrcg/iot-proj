<?php
require_once("../../functions/database/db_connect.php");
session_start();
include_once("../../components/admin_sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../admin/style/admin_homepage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>HEO | Dashboard</title>
</head>

<body>
    <div class="content">
        <div class="admin-dashboard">
            <div class="dashboard-text">
                <h1>Dashboard</h1>
            </div>

            <div class="container">

                <div class="Meralco-rate">
                    <div class="meralco-rate-content">
                        <div class="meralco-rate-text">
                            <h2>Change Rate for kWh</h2>
                        </div>

                        <div class="meralco-rate-input">
                            <form id="editableForm">
                                <input type="text" id="editableInput" placeholder="Add kWh rate (₱)" oninput="validateNumber()">
                                <button type="button" onclick="toggleEdit()">Edit</button>
                            </form>

                            <div class="reminder">
                                <i class="fa-solid fa-circle-info fa-2xl" style="color: orange;"></i>
                                <p>Only accepting numerical value!</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="Users-number">
                    <div class="user-number-content">
                        <i class="fa-solid fa-user fa-2xl" style="color: yellow;"></i>
                        <span>|</span>
                        <h1>23 Users</h1>
                    </div>
                </div>

                <div class="message-all">

                    <div class="form-container">

                        <div class="form-container-text">
                            <i class="fa-solid fa-envelope fa-2xl" style="color: #ffffff;"></i>
                            <h1>Send Email to all Users!</h1>
                        </div>

                        <form class="email-form" id="emailForm" >

                            <label for="subject">Email Subject:</label>
                            <input type="text" id="subject" name="subject" placeholder="Enter a Subject..." required>

                            <label for="message">Email Message:</label>
                            <textarea id="message" name="message" rows="4" placeholder="Type you message here..." required></textarea>

                            <button type="button" onclick="sendEmails()">Send</button>
                        </form>

                    </div>   

                </div>

            </div>

        </div>

        <div class="not-available">
            <h1>"This Breakpoint is Under Development"</h1>
            <p>Please use the desktop mode for content availability!</p>
        </div>


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // This function will be executed when the DOM is fully loaded
            var inputField = document.getElementById("editableInput");
            var button = document.querySelector("button");

            // Disable the input field initially
            inputField.setAttribute("readonly", "true");
            button.textContent = "Edit";
        });

        function toggleEdit() {
            var inputField = document.getElementById("editableInput");
            var button = document.querySelector("button");

            if (button.textContent === "Edit") {
                // Enable the input field for editing
                inputField.removeAttribute("readonly");
                button.textContent = "Save";
            } else {
                // Save the input value and disable the input field
                inputField.setAttribute("readonly", "true");
                button.textContent = "Edit";
            }
        }

        function validateNumber() {
            var inputField = document.getElementById("editableInput");
            inputField.value = inputField.value.replace(/\D/g, ''); // Remove non-numeric characters
        }
    </script>

</body>

</html>