<?php
$link = mysqli_connect("localhost", "root", "");

if ($link === false) {
    $errorMessage = "ERROR: Could not connect. ";
}

// Veritabanı var mı kontrolü
$result = mysqli_query($link, "SHOW DATABASES LIKE 'homework'");
if (mysqli_num_rows($result) == 0) {
    $sql = "CREATE DATABASE homework";

    if (mysqli_query($link, $sql)) {
        $successMessage = "Databased created successfully.";
    } else {
        $errorMessage = "ERROR: Could not able to execute";
    }
} else {
}

mysqli_close($link);
?>
