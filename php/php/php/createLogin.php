<?php
$link = mysqli_connect("localhost", "root", "", "homework");

if ($link === false) {
    $errorMessage = "ERROR: Could not connect. ";
}

// Tablo var mı kontrolü
$result = mysqli_query($link, "SHOW TABLES LIKE 'login'");
if (mysqli_num_rows($result) == 0) {
    $sql = "CREATE TABLE login (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        pass VARCHAR(50) NOT NULL
    )";

    if (mysqli_query($link, $sql)) {
        $successMessage .= "Login table created successfully.";
        
        // Yeni tablo oluşturulduğunda varsayılan bir kullanıcı ekleyelim
        $defaultUsername = "root";
        $defaultPassword = "123";

        $insertQuery = "INSERT INTO login (username, pass) VALUES ('$defaultUsername', '$defaultPassword')";
        if (mysqli_query($link, $insertQuery)) {
            $successMessage .= " Default user added. Username : $defaultUsername Password : $defaultPassword";
           
        } else {
            $errorMessage = "ERROR: Could not add default user. " . mysqli_error($link);
        }
    } else {
        $errorMessage = "ERROR: Could not add default user. " . mysqli_error($link);
    }
}

mysqli_close($link);
?>
