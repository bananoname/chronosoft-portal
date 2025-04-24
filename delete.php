<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $filepath = "upload/" . $file;

    if (file_exists($filepath)) {
        unlink($filepath);
    }
}
header("Location: list.php");
exit;
?>