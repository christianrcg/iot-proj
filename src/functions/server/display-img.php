<?php
require_once('../database/db_connect.php');

// Retrieve app_id from the URL parameter
if (isset($_GET['app_id'])) {
    $app_id = $_GET['app_id'];

    // Retrieve image data and filename from the database
    $stmt = $conn->prepare("SELECT image, image_filename FROM appliances WHERE app_id = ?");
    $stmt->bind_param("i", $app_id);
    $stmt->execute();
    $stmt->bind_result($imageData, $filename);
    $stmt->fetch();
    $stmt->close();

    // Check if image data is available
    if ($imageData !== null) {
        // Output appropriate headers for image
        header("Content-type: image");
        header("Content-Disposition: inline; filename=$filename");

        // Output the image data
        echo base64_decode($imageData);
    } else {
        // Load and output a placeholder image
        $placeholderImagePath = '../../assets/img/def-img/def-1x1.jpg';
        $placeholderImageData = file_get_contents($placeholderImagePath);
        $placeholderImageMimeType = mime_content_type($placeholderImagePath);

        // Output appropriate headers for placeholder image
        header("Content-type: $placeholderImageMimeType");

        // Output the placeholder image data
        echo $placeholderImageData;
    }
} else {
    echo "Error: app_id not provided";
}

$conn->close();
