<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>

    <style>
        body {
            background: #1C1F34;
            color: aliceblue;
        }

        form-cont {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="cont">
        <section class="form-cont">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="input-cont">
                    <label for="app_id">APP ID:</label>
                    <input type="number" name="app_id">
                </div>
                <div class="input-cont">
                    <label for="image">Select Image:</label>
                    <input type="file" name="image" id="image">
                    <input type="submit" value="Upload Image" name="submit">
                </div>
            </form>
        </section>
    </div>
</body>

</html>