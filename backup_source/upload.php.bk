<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ChronoSoft - Internal Upload Portal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>ChronoSoft Ltd.</h1>
    <div class="company-info">
        Internal HR Document Upload Portal<br>
        Contact: <a href="mailto:security@chronosoft.io">security@chronosoft.io</a>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $upload_dir = 'upload/';
        $upload_file = $upload_dir . basename($_FILES['file']['name']);

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
            echo "<p>✅ File uploaded successfully!</p>";
        } else {
            echo "<p>❌ Upload failed.</p>";
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required />
        <input type="submit" value="Upload Document" />
    </form>

    <p><a href="list.php">📁 View Uploaded Files</a></p>
</div>
</body>
</html>
