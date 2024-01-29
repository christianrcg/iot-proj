<?php
require_once('../../functions/database/db_connect.php');
session_start();
include_once '../../components/reg_sidebar.php';

if (isset($_SESSION['username'])) {
    //do nothing
} else {
    header('Location: /src/before_auth/landingpage.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$name_search_filter = isset($_GET['name_filter']) ? $_GET['name_filter'] : '';
$app_type_filter = isset($_GET['type_filter']) ? $_GET['type_filter'] : '';

$sql = "SELECT 
            a.app_id, 
            a.app_type, 
            a.app_brand, 
            a.app_model, 
            a.consumption, 
            a.image, 
            a.image_filename,
            COALESCE(alu.list_id, NULL) as list_id,
            COALESCE(alu.quantity, 1) as quantity,
            COALESCE(alu.status, 'off') as status,
            COALESCE(alu.consumption_by_quantity, '0') as consumption_by_quantity
        FROM 
            appliances a
        LEFT JOIN 
            app_list_of_users alu ON a.app_id = alu.app_id
            WHERE 
            alu.user_id = $user_id";

if ($app_type_filter == 'all') {
    //used to display the default sql and not apply a filter
    $sql .= " ";
}

if ($app_type_filter !== null && $app_type_filter != 'all') {
    $sql .= " AND a.app_type LIKE '%$app_type_filter%'";
}

if ($name_search_filter !== null) {
    // If WHERE clause already exists, use AND, else start with WHERE
    $sql .= ($app_type_filter !== null || $app_type_filter != 'all') ? " AND" : " WHERE";
    $sql .= " (a.app_brand LIKE '%$name_search_filter%' OR a.app_model LIKE '%$name_search_filter%')";
}

// Add ORDER BY clause
$sql .= " ORDER BY alu.list_id DESC";

$sql_result = mysqli_query($conn, $sql);
if (!$sql_result) {
    die('Error: ' . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../regular/style/reg_myAppliancePage.css">

    <!-- FONT AWESOME ICONS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- alertifyJs css (for alerts) -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <title>HEO | My Appliances</title>

</head>

<body>
    <div class="cont">
        <div class="my-appliance">

            <div class="my-appliance-text">
                <h1>Appliances</h1>
            </div>

            <div class="my-appliance-table-container">
                <div class="header-utils">
                    <form class="form-cont" id="form-filter" method="get">
                        <div class="search-box">
                            <i class="fa-solid fa-magnifying-glass" style="color: white;"></i>
                            <input type="text" id="myInput" name="name_filter" placeholder="Search for appliances..">
                        </div>
                        <div class="type-filter">
                            <select name="type_filter" id="type_filter">
                                <?php
                                $sql_options = "SELECT DISTINCT app_type FROM appliances";
                                $result = mysqli_query($conn, $sql_options);

                                $typeOptions = array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $typeOptions[] = $row['app_type'];
                                }
                                mysqli_free_result($result);
                                echo '<option value="all">' . 'Choose Type' .  '</option>';

                                foreach ($typeOptions as $type_filter) {
                                    $selected = ($app_type_filter == $type_filter) ? 'selected' : '';
                                    echo '<option value="' . $type_filter . '" ' . $selected . '>' . $type_filter . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" form="form-filter" class="filter-btn"> Filter </button>
                    </form>

                    <button class="main-btn" id="add-app-btn">
                        <i class="fa-solid fa-plus fa-lg" style="color: #000000; margin-right: 5px;"></i>
                        Add Appliances
                    </button>
                </div>

                <table id="myTable">
                    <!-- TABLE HEADER -->
                    <thead>
                        <tr class="table-header">
                            <th style="width:5%;"> </th>
                            <th style="width:15%;">Appliances Type</th>
                            <th style="width:15%;">Brand</th>
                            <th style="width:15%;">Model</th>
                            <th style="width:10%;">Quantity</th>
                            <th style="width:10%;">Consumption/hour</th>
                            <th style="width:10%;">Status</th>
                            <th style="width:10%;">Actions</th>
                        </tr>
                    </thead>

                    <!-- TABLE BODY -->
                    <tbody>
                        <?php
                        if (mysqli_num_rows($sql_result) == 0) {
                            echo '<p class="emptyTable" id="emptyTable"> No record available </>';
                        } else {
                            while ($row = mysqli_fetch_assoc($sql_result)) {

                        ?>
                                <tr>
                                    <td>
                                        <?php
                                        if (!empty($row['image'])) {
                                            echo '<img src="data:image/jpeg;base64,' . $row['image'] . '" alt="Image" width="64" height="64">';
                                        } else {
                                            echo '<img src="/src/assets/def-img/def-1x1.jpg" alt="No Image">';
                                        }
                                        ?>
                                    </td>
                                    <td style="color: antiquewhite;"><?php echo $row['app_type']; ?></td>
                                    <td><?php echo $row['app_brand']; ?></td>
                                    <td><?php echo $row['app_model']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['consumption_by_quantity']; ?> Watts</td>
                                    <td>
                                        <label class="switch" for="checkbox_<?php echo $row['list_id']; ?>">
                                            <input type="checkbox" id="checkbox_<?php echo $row['list_id']; ?>" <?php echo ($row['status'] == 'on') ? 'checked' : ''; ?>>
                                            <div class="slider round"></div>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="action-container">
                                            <button class="edit-app-btn" value="<?php echo $row['list_id']; ?>">
                                                <i class="fa-solid fa-pen-to-square fa-xl" style="color: skyblue;"></i>
                                            </button>
                                            <button class="del-app-btn" data-list-id="<?php echo $row['list_id']; ?>">
                                                <i class="fa-solid fa-trash-can fa-xl" style="color: red;"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="not-available">
            <h1>"This Breakpoint is Under Development"</h1>
            <p>Please use the desktop mode for content availability!</p>
        </div>
    </div>


    <!-- ADD MODAL -->
    <div class="modal" id="add-modal">
        <div class="modal-cont">
            <form id="appForm" class="modal-body" action="submit.php" method="post">
                <span class="input-group">
                    <img src="/src/assets/img/logo-icon-only-1x1.png" id="image" name="image" width="128" height="128">
                </span>
                <span class="input-group">
                    <label for="app_type">App Type:</label>
                    <select id="app_type" name="app_type"></select>
                </span>
                <span class="input-group">
                    <label for="app_brand">App Brand:</label>
                    <select id="app_brand" name="app_brand"></select>
                </span>
                <span class="input-group">
                    <label for="app_model">App Model:</label>
                    <select id="app_model" name="app_model"></select>
                </span>
                <span class="input-group">

                </span>
                <span class="input-group fl-col">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="ig-inp" id="quantity" name="quantity" min="1" max="100" onchange="calculateConsumption()">
                </span>
                <span class="input-group fl-col">
                    <label for="consumption">Consumption:</label>
                    <input type="text" class="ig-inp" id="consumption" name="consumption" readonly>
                    <input type="hidden" class="ig-inp" id="orig-consumption" name="orig-consumption" readonly>
                </span>
                <!-- hidden input for posting app_id logged_in user-->
                <input type="hidden" id="app_id" name="app_id" readonly>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" readonly>

                <input type="submit" value="Add Appliance" class="submit-btn b-sdw">
            </form>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal" id="del-modal">
        <div class="modal-cont b-sdw">
            <form id="delForm" class="modal-body" method="post">
                <span class="input-group">
                    <div class="round-cont">
                        <i class="fa-solid fa-trash fa-5x" style="color: #8b0021;"></i>
                    </div>

                </span>
                <span class="input-group fl-col">
                    <label> Are you sure you want to delete this appliance? </label>
                </span>
                <!-- hidden input for posting app_id logged_in user-->
                <input type="hidden" id="del-input" name="list_id" readonly>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" readonly>
                <span class="input-group center-cont">
                    <input type="submit" value="Delete Appliance" class="submit-btn bg-red">
                    <input type="button" value="Cancel" class="cancel-btn" readonly>
                </span>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal" id="edit-modal">
        <div class="modal-cont">
            <form id="updateForm" class="modal-body" action="submit.php" method="post">
                <span class="input-group">
                    <img src="/src/assets/img/logo-icon-only-1x1.png" id="edit_image" name="image" width="128" height="128">
                </span>
                <span class="input-group">
                    <label for="edit_app_type">App Type:</label>
                    <input id="edit_app_type" name="app_type" readonly>
                </span>
                <span class="input-group">
                    <label for="edit_app_brand">App Brand:</label>
                    <input id="edit_app_brand" name="app_brand" readonly>
                </span>
                <span class="input-group">
                    <label for="edit_app_model">App Model:</label>
                    <input id="edit_app_model" name="app_model" readonly>
                </span>
                <span class="input-group">

                </span>
                <span class="input-group fl-col">
                    <label for="edit_quantity">Quantity:</label>
                    <input type="number" class="ig-inp" id="edit_quantity" name="quantity" min="1" max="100" onclick="edit_calculateConsumption()">
                </span>
                <span class="input-group fl-col">
                    <label for="edit_consumption">Consumption:</label>
                    <input type="text" class="ig-inp" id="edit_consumption" name="consumption" readonly>
                    <input type="hidden" class="ig-inp" id="edit_orig-consumption" name="orig-consumption" readonly>
                </span>
                <!-- hidden input for posting app_id logged_in user-->
                <input type="hidden" id="app_id_edit" name="app_id" readonly>
                <input type="hidden" id="list_id_edit" name="list_id_edit" value="">
                <input type="hidden" id="user_id_edit" name="user_id" value="<?php echo $user_id; ?>" readonly>

                <input type="submit" value="Edit Appliance" class="submit-btn b-sdw">
            </form>
        </div>
    </div>

    <style>
        /* Style for the modal container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(12px);
        }

        /* Style for the modal content */
        .modal-cont {
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            max-width: 500px;
            justify-content: center;
            align-items: center;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            margin: 10% auto;
            position: relative;
            padding: 1rem;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            width: 100%;
            gap: 10px;
        }

        .input-group {
            display: flex;
            width: 100%;
            justify-content: space-evenly;
            align-items: center;
        }

        .input-group select {
            width: 15rem;
            padding: 8px 1rem;
            border-radius: 8px;
            border: 1px solid #31507F;
        }

        .ig-inp {
            width: 4rem;
            padding: 8px 1rem;
            border-radius: 8px;
            border: 1px solid #31507F;
        }

        .fl-col {
            flex-direction: column;
        }

        .submit-btn {
            margin-top: 15px;
            padding: 1rem 2rem;
            background: #4f407a;
            color: aliceblue;
            border-radius: 12px;
            border-style: none;
            font-weight: 800;
        }

        .submit-btn:hover {
            background-color: #3a2f56;
        }

        .cancel-btn {
            margin-top: 15px;
            padding: 1rem 2rem;
            background: none;
            color: #8B0021;
            border: 2px solid #8B0021;
            border-radius: 12px;
            font-weight: 800;
        }

        .cancel-btn:hover {
            color: #AAAAAA;
            border: 2px solid #AAAAAA;
        }

        .bg-red {
            background: #8B0021;
        }

        .round-cont {
            background-color: #D6D6D6;
            padding: 2rem;
            border-radius: 64px;
            padding-inline: 2.5rem;
        }

        .input-group label {
            font-weight: 500;
        }

        .center-cont {
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
    </style>

    <script src="/src/assets/jquery/jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        //updating status
        var checkboxes = document.querySelectorAll('input[type="checkbox"][id^="checkbox_"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var newSetting = this.checked ? 'on' : 'off';
                var listId = this.id.replace('checkbox_', '');
                console.log(newSetting);
                console.log(listId);

                fetch('../../functions/appliance/update_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'app_status=' + newSetting + '&list_id=' + listId,
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        //add_modal popup
        var modal = document.getElementById('add-modal');
        var btn = document.getElementById('add-app-btn');

        btn.onclick = function() {
            modal.style.display = 'block';
        }

        //delete modal popup
        var delModal = document.getElementById('del-modal');
        var delButtons = document.querySelectorAll('.del-app-btn');

        delButtons.forEach(function(delBtn) {
            // Attach click event listener to each delete button
            delBtn.onclick = function() {
                delModal.style.display = 'block';
                // Retrieve the list ID associated with the clicked button
                var listId = delBtn.getAttribute('data-list-id');

                console.log('Clicked app list ID using del-btn: ' + listId);
                $('#del-input').val(listId);
            };
        });

        //edit btn
        var editModal = document.getElementById('edit-modal');

        //modals close on click
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                resetFormInputs();
            } else if (event.target === delModal) {
                delModal.style.display = 'none';
            } else if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        };

        //cancel btns
        var cancelBtns = document.getElementsByClassName('cancel-btn');

        // Attach click event listeners to each cancel button
        for (var i = 0; i < cancelBtns.length; i++) {
            cancelBtns[i].addEventListener('click', closeModal);
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = 'none';
            delModal.style.display = 'none';
            editModal.style.display = 'none';
        }

        function openEditModal() {
            editModal.style.display = 'block';
        }

        function resetFormInputs() {
            $('#appForm')[0].reset(); // Reset the form fields
            $('#image').attr('src', '/src/assets/img/logo-icon-only-1x1.png'); // Reset the image source
            $('#app_id').val('')
            $('#app_type').val('');
            $('#app_brand').val('');
            $('#app_model').val('');
            $('#del-input').val('');
        }

        //add modal form handler:
        $(document).ready(function() {
            populateAppType(); // Populate app_type select input on page load

            // Event listener for app_type change
            $(document).on('change', '#app_type', function() {
                var selectedAppType = $(this).val();
                populateAppBrand(selectedAppType);
            });

            // Event listener for app_brand change
            $(document).on('change', '#app_brand', function() {
                var selectedAppType = $('#app_type').val();
                var selectedAppBrand = $(this).val();
                populateAppModel(selectedAppType, selectedAppBrand);
            });

            // Event listener for app_model change
            $(document).on('click', '#app_model', function() {
                var selectedAppType = $('#app_type').val();
                var selectedAppBrand = $('#app_brand').val();
                var selectedAppModel = $(this).val();
                populateAdditionalInfo(selectedAppType, selectedAppBrand, selectedAppModel);
            });

            // Event listener for form submission
            $(document).on('submit', '#appForm', function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize();

                $.ajax({
                    url: '../../functions/appliance/add_appliance.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alertify.set('notifier', 'position', 'top-center');
                        let notif = alertify.success('<p><i class="fa-solid fa-circle-check fa-2xl" style="color: #fff;"></i> &nbsp Appliance added successfully</p>');
                        $('body').one('click', function() {
                            notif.dismiss();
                        });
                        modal.style.display = 'none';
                        resetFormInputs();
                        window.location.href = 'reg_myAppliancePage.php';
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors
                    }
                });
            });
        });

        // populates the forms and modals
        function populateAppType() {
            $.ajax({
                url: '../../functions/appliance/form-handlers/get_app_types.php',
                type: 'GET',
                success: function(response) {
                    $('#app_type').html(response); // Update app_type select input
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        }

        function populateAppBrand(selectedAppType) {
            $.ajax({
                url: '../../functions/appliance/form-handlers/get_app_brands.php', // PHP script to retrieve app_brand options
                type: 'POST',
                data: {
                    app_type: selectedAppType
                }, // Send selected app_type to the server
                success: function(response) {
                    $('#app_brand').html(response); // Update app_brand select input
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        }

        function populateAppModel(selectedAppType, selectedAppBrand) {
            $.ajax({
                url: '../../functions/appliance/form-handlers/get_app_models.php',
                type: 'POST',
                data: {
                    app_type: selectedAppType,
                    app_brand: selectedAppBrand
                },
                success: function(response) {
                    $('#app_model').html(response); // Update app_model select input
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        }

        function populateAdditionalInfo(selectedAppType, selectedAppBrand, selectedAppModel) {
            $.ajax({
                url: '../../functions/appliance/form-handlers/get_additional_info.php',
                type: 'POST',
                data: {
                    app_type: selectedAppType,
                    app_brand: selectedAppBrand,
                    app_model: selectedAppModel
                },
                success: function(response) {
                    // Parse the response JSON
                    var data = JSON.parse(response);

                    $('#consumption').val(data.consumption);
                    $('#orig-consumption').val(data.consumption);
                    $('#quantity').val(1);
                    $('#app_id').val(data.app_id);

                    if (data.image) {
                        $('#image').attr('src', 'data:image;base64,' + data.image); // Set image source
                    } else {
                        $('#image').attr('src', '/src/assets/img/logo-icon-only-1x1.png'); // Set a placeholder image source
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        }

        function calculateConsumption() {
            const quan = document.getElementById("quantity");
            const cons = document.getElementById("orig-consumption"); //from hidden input, ensures to use the consumption value from db
            const quan_value = quan.value;
            const cons_value = cons.value;

            const calculated = quan_value * cons_value;
            document.getElementById("consumption").value = calculated; //only updates the consumption input visible to users
        }

        function edit_calculateConsumption() {
            const quan1 = document.getElementById("edit_quantity");
            const cons1 = document.getElementById("edit_orig-consumption"); //from hidden input, ensures to use the consumption value from db
            const quan_value1 = quan1.value;
            const cons_value1 = cons1.value;

            const calculated1 = quan_value1 * cons_value1;
            document.getElementById("edit_consumption").value = calculated1; //only updates the consumption input visible to users
        }

        //delete form action:
        $(document).on('submit', '#delForm', function(event) {
            event.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize();

            $.ajax({
                url: '../../functions/appliance/delete_appliance.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alertify.set('notifier', 'position', 'top-center');
                    let notif = alertify.success('<p><i class="fa-solid fa-circle-check fa-2xl" style="color: #fff;"></i> &nbsp Delete successfully</p>');
                    $('body').one('click', function() {
                        notif.dismiss();
                    });
                    delModal.style.display = 'none';
                    resetFormInputs();
                    window.location.href = 'reg_myAppliancePage.php';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        });

        //edit

        $(document).on('click', '.edit-app-btn', function() {
            let list_id = $(this).val();

            $.ajax({
                type: 'GET',
                url: '../../functions/appliance/edit_app.php?list_id=' + list_id,
                success: function(response) {
                    let res = jQuery.parseJSON(response);
                    alertify.set('notifier', 'position', 'top-center');

                    if (res.status == 200) {
                        $('#list_id_edit').val(res.data.list_id);
                        $('#app_id_edit').val(res.data.app_id);
                        $('#edit_app_type').val(res.data.app_type);
                        $('#edit_app_brand').val(res.data.app_brand);
                        $('#edit_app_model').val(res.data._app_model);

                        $('#edit_consumption').val(res.data.consumption);
                        $('#edit_orig-consumption').val(res.data.consumption);
                        $('#edit_quantity').val(res.data.quantity);

                        if (res.data.image) {
                            $('#edit_image').attr('src', 'data:image;base64,' + res.data.image); // Set image source
                        } else {
                            $('#edit_image').attr('src', '/src/assets/img/logo-icon-only-1x1.png'); // Set a placeholder image source
                        }
                        console.log('List:', res.data.list_id);
                        console.log('id:', res.data.app_id);
                        console.log('type:', res.data.app_type);
                        console.log('brand:', res.data.app_brand);
                        console.log('model:', res.data.app_model);
                        console.log('consumption:', res.data.consumption);
                        console.log('quantity:', res.data.quantity);

                        openEditModal();


                    } else if (res.status == 404) {
                        let notif = alertify.error(res.message);
                        $('body').one('click', function() {
                            notif.dismiss();
                        });
                    }
                }
            });
        });
    </script>


</body>

</html>