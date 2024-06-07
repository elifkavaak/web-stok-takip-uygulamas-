<?php
$link = mysqli_connect("localhost", "root", "", "homework");

if ($link === false) {
    $errorMessage = "ERROR: Could not connect. ";
}

// Tablo var mı kontrolü
$result = mysqli_query($link, "SHOW TABLES LIKE 'personeller'");
if (mysqli_num_rows($result) == 0) {
    $sql = "CREATE TABLE personeller (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ad VARCHAR(100) NOT NULL,
        soyad VARCHAR(100) NOT NULL,
        departman VARCHAR(50) NOT NULL,
        maas DECIMAL(10, 2) NOT NULL
    )";

    if (mysqli_query($link, $sql)) {
        $successMessage = "Staff table created successfully.";
    } else {
        $errorMessage = "ERROR: Could not able to execute";
    }
}

mysqli_close($link);
?>
