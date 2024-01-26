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
            COALESCE(alu.quantity, 0) as quantity,
            COALESCE(alu.status, 'off') as status
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
$sql .= " ORDER BY a.app_id";

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

    <title>HEO | My Appliances</title>
</head>

<body>
    <div class="content">
        <div class="my-appliance">

            <div class="my-appliance-text">
                <h1>Appliances</h1>
            </div>


            <div class="my-appliance-table-container">
                <div class="header-utils">
                    <form class="form-container" id="form-filter" method="get">
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

                    <button class="main-btn">
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
                                    <td><?php echo $row['consumption']; ?> Watts</td>
                                    <td>
                                        <label class="switch" for="checkbox_<?php echo $row['list_id']; ?>">
                                            <input type="checkbox" id="checkbox_<?php echo $row['list_id']; ?>" <?php echo ($row['status'] == 'on') ? 'checked' : ''; ?>>
                                            <div class="slider round"></div>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="action-container">
                                            <button>
                                                <i class="fa-solid fa-pen-to-square fa-xl" style="color: skyblue;"></i>
                                            </button>
                                            <button>
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

        <script src="/src/assets/jquery/jquery.js"></script>

        <script>
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
        </script>

    </div>
</body>

</html>