<?php
require_once '../database/db_connect.php';

$app_id = $_POST['app_id'];
$targetDir = "uploads/";  // Create a directory named "uploads" to store images
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the image file is a real image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if the file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow only certain file formats
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

// If everything is okay, try to upload file
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";

        // Update the database with the file information
        $imageData = file_get_contents($targetFile);
        $imageData = base64_encode($imageData);

        $stmt = $conn->prepare("UPDATE appliances SET image = ?, image_filename = ? WHERE app_id = ?");
        $stmt->bind_param("ssi", $imageData, basename($_FILES["image"]["name"]), $app_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: /src/after_auth/admin/img_uploadpage.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
