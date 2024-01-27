<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        body>* {
            color: white;
        }

        .header {
            display: flex;
            align-items: center;
        }
        .header h1 {
            margin-left: 20px;
            font-weight: bold;
        }
        header{
            display: flex;
            align-items: center;
        }
        header i{
            margin-right: 20px;
        }

        article{
            margin-top: 30px;
        }
        section p, details{
            margin-left: 50px;
        }
        details summary{
            color: plum;
            cursor: pointer;
        }
        p a{
            text-decoration: none;
            color: plum;
            font-style: italic;
        }
    </style>

</head>

<body>

    <div class="header" style="color:#FFD43B; font-style:italic;">
        <h1>Guide on How to use HEO App</h1>
    </div>

    <article>
        <header>
            <i class="fa-solid fa-circle-info fa-2xl" style="color: #ffffff;"></i>
            <h1>CORE</h1>
        </header>
        <section>
            <div class="header">
                <i class="fa-solid fa-bolt fa-2xl" style="color: #FFD43B;"></i>
                <h1>Assign/Change Your Location</h1>
            </div>
            <p>To change your location, you can go to the <a href="../regular/reg_settings.php" target="_self">settings</a> and find App settings.
                Under app settings their is an input with a Location label. Just click the
                small edit icon and type your house location.
            </p>
        </section>
        <section>
            <div class="header">
                <i class="fa-solid fa-bolt fa-2xl" style="color: #FFD43B;"></i>
                <h1>Setting Monthly Budget</h1>
            </div>
            <p>You can change your Monthly budget in the bottom part of the <a href="../regular/reg_homepage.php">dashboard</a>. This is an important input that you must provide a value
                since this is going to be a basis to measure optimization.
            </p>
        </section>
        <section>
            <div class="header">
                <i class="fa-solid fa-bolt fa-2xl" style="color: #FFD43B;"></i>
                <h1>Adding Aplliances</h1>
            </div>
            <p>Adding Appliances that you are using inside your house is one of the core actions that
                users must do. To do that, you can go 
                to the <a href="../regular/reg_myAppliancePage.php">Appliances page</a> where you can find the add appliances button. Upon clicking the button,
                it will show modal that allows you to input the image of the appliances you want to add, Appliance type,
                Appliance Brand, Appliance Model, Quantity (or the number of that appliance inside your house) and also its 
                Electrical Consumption (kwh)
            </p>
            <details>
                <summary>Activate / Deactivate Appliance</summary>
                <p>To Activate appliance, you can simply toggle the switch in the status column.</p>
                <p><i class="fa-solid fa-bell fa-lg" style="color: #f5f5f5; margin-right: 5px;"></i> <b>REMINDER:  </b>You must turn off or deactivate the 
                toggle when you stop using the appliance or update it and change the quantity according to the number of turned off of the same appliance</p>
            </details>
            <details>
                <summary>Remove Appliance</summary>
                <p>To remove appliance, you can click the delete icon on the Action column.</p>
                <p><i class="fa-solid fa-bell fa-lg" style="color: #f5f5f5; margin-right: 5px;"></i> <b>REMINDER:  </b>
                    When you remove your appliance, always remember that no matter how many quantity you inputted, it will all be deleted.
                </p>
        
            </details>
            <details>
                <summary>Update Appliance</summary>
                <p>To update your appliance, just click the update icon located on the Action column.</p>
            </details>
        </section>
    </article>

</body>

</html>