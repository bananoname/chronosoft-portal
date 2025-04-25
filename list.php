<?php
$dir = "upload/";
$files = scandir($dir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uploaded Files - ChronoSoft</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    ChronoSoft Document Viewer
</header>

<main class="main-content">
    <div class="container">
        <h1>Uploaded Documents</h1>
        <ul class="doc-list">
            <?php foreach ($files as $file): ?>
                <?php
                if ($file === '.' || $file === '..') continue;
                if (strpos($file, 'flag') !== false) continue; // Ẩn flag khỏi danh sách
                ?>
                <li>
                    📄 <a href="upload/<?= htmlspecialchars($file) ?>" target="_blank"><?= htmlspecialchars($file) ?></a>
                    &nbsp;[<a href="delete.php?file=<?= urlencode($file) ?>" onclick="return confirm('Delete this file?')">🗑 Delete</a>]
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a href="index.php">⬅ Back</a></p>
    </div>
</main>

<footer>
    © 2025 ChronoSoft Ltd. All rights reserved.
</footer>

</body>
</html>

