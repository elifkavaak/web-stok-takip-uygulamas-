<?php
require_once "createDB.php";
require_once "createLogin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
    
</head>
<body>
    <?php
    // Kullanıcının giriş yaptığını kontrol et
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kullanıcı adı ve şifre doğrulamasını gerçekleştir
        $enteredUsername = $_POST["username"];
        $enteredPassword = $_POST["password"];
    
        // Veritabanı bağlantısı
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "homework";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Veritabanına bağlanılamadı: " . $conn->connect_error);
        }
    
        // Kullanıcı adı ve şifreyi sorgula
        $sql = "SELECT * FROM login WHERE username='$enteredUsername' AND pass='$enteredPassword'";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            session_start();
            $_SESSION["username"] = $enteredUsername;
            header("Location: dashboard.php");
            exit;
        } else {
            $loginError = "Kullanıcı adı veya şifre yanlış";
        }
    
        // Bağlantıyı kapat
        $conn->close();
    }
    
    ?>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        // JavaScript ile alert gösterme
        function showAlert(message) {
            alert(message);
        }

        // PHP tarafından geçirilen başarı veya hata mesajlarını göster
        <?php
        if (isset($successMessage)) {
            echo "showAlert('$successMessage');";
        }
        if (isset($errorMessage)) {
            echo "showAlert('$errorMessage');";
        }
        ?>
    </script>
</body>
</html>
