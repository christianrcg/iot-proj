<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_myAppliancePage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Regular Homepage</title>
</head>

<body>
    <div class="my-appliance">

        <div class="my-appliance-text">
            <h1>Appliances</h1>
        </div>


        <div class="my-appliance-table-container">

            <div class="header-utils">

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass" style="color: white;"></i>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for appliances.." title="Type in an appliance">
                </div>

                <button>
                    <i class="fa-solid fa-plus fa-lg" style="color: #000000; margin-right: 5px;"></i>
                    Add Appliances
                </button>

            </div>

            <table id="myTable">

                <!-- TABLE HEADER -->

                <tr class="table-header">
                    <th style="width:20%;">Appliances Type</th>
                    <th style="width:20%;">Model</th>
                    <th style="width:10%;">Quantity</th>
                    <th style="width:10%;">Consumption per hour</th>
                    <th style="width:10%;">Status</th>
                    <th style="width:10%;">Actions</th>
                </tr>

                <!-- TABLE BODY -->

                <tr>
                    <td>Oven</td>
                    <td>Hanabishi</td>
                    <td>1</td>
                    <td>25 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="0">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Regrigerator</td>
                    <td>Samsung</td>
                    <td>1</td>
                    <td>65 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Television</td>
                    <td>Devant</td>
                    <td>1</td>
                    <td>80 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="2">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Electric Fan</td>
                    <td>Standard</td>
                    <td>3</td>
                    <td>45 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="3">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Laptop</td>
                    <td>Asus</td>
                    <td>2</td>
                    <td>30 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="4">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Speaker</td>
                    <td>Samsung</td>
                    <td>2</td>
                    <td>20 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="5">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Rice Cooker</td>
                    <td>Standard</td>
                    <td>1</td>
                    <td>25 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="6">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Electric Stove</td>
                    <td>Honda</td>
                    <td>1</td>
                    <td>45 watts</td>
                    <td>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" id="7">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">

                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: skyblue;"></i>
                            <i class="fa-solid fa-trash-can fa-lg" style="color: red;"></i>

                        </div>
                    </td>
                </tr>


            </table>

        </div>

        <script>
            const toggleSwitch_0 = document.getElementById('0');

            toggleSwitch_0.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_1 = document.getElementById('1');

            toggleSwitch_1.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_2 = document.getElementById('2');

            toggleSwitch_2.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_3 = document.getElementById('3');

            toggleSwitch_3.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_4 = document.getElementById('4');

            toggleSwitch_4.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_5 = document.getElementById('5');

            toggleSwitch_5.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });


            const toggleSwitch_6 = document.getElementById('6');

            toggleSwitch_6.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });

            const toggleSwitch_7 = document.getElementById('7');

            toggleSwitch_7.addEventListener('change', function() {
                if (this.checked) {
                    alert('Switch is ON');
                } else {
                    alert('Switch is OFF');
                }
            });
        </script>

    </div>
</body>

</html>