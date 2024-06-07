<?php
$link = mysqli_connect("localhost", "root", "", "homework");

if ($link === false) {
    $errorMessage = "ERROR: Could not connect. ";
}

// Tablo var mı kontrolü
$result = mysqli_query($link, "SHOW TABLES LIKE 'stoklar'");
if (mysqli_num_rows($result) == 0) {
    $sql = "CREATE TABLE stoklar (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        urun_ad VARCHAR(100) NOT NULL,
        stok_miktar INT NOT NULL,
        fiyat DECIMAL(10, 2) NOT NULL
    )";

    if (mysqli_query($link, $sql)) {
        $successMessage = "Products table created successfully.";
    } else {
        $errorMessage = "ERROR: Could not able to execute";
    }
} else {
    
}

mysqli_close($link);
?>
