<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .tick, .cross {
            width: 700px;
            height: 500px;
            margin-bottom: 20px;
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }

        .retry-button {
            background-color: #f44336;
        }

        .retry-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php
    $showMessage = false;
    $status = "";
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["yourImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $n = $_POST["yourName"];

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["yourImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        // if ($_FILES["yourImage"]["size"] > 500000) {
        //     $message = "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message = $message ?? "Sorry, your file was not uploaded.";
            $status = 'error';
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["yourImage"]["tmp_name"], $targetFile)) {
                // Database connection
                $conn = new mysqli("localhost", "root", "", "myntra");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $filePath = addslashes($targetFile);

                // Insert image path into database
                $sql = "INSERT INTO photos (image_path, names) VALUES ('$filePath','$n')";

                if ($conn->query($sql) === TRUE) {
                    $message = "The Photo has been uploaded for the contest.";
                    $status = 'success';
                } else {
                    $message = "Error: " . $sql . "<br>" . $conn->error;
                    $status = 'error';
                }

                $conn->close();
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $status = 'error';
            }
        }
        $showMessage = true;
    }
    ?>

    <?php if ($showMessage): ?>
        <?php if ($status == 'success'): ?>
            <img src="tick.gif" alt="Success" class="tick">
            <div class="message"><?php echo $message; ?></div>
            <a href="vote.html" class="button">Go to Voting Page</a>
        <?php else: ?>
            <img src="error-img.gif" alt="Error" class="cross">
            <div class="message"><?php echo $message; ?></div>
            <a href="participation_upload.php" class="button retry-button">Retry</a>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
