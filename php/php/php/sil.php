<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "veritabani.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    deleteProduct($conn, $id);

    // Silme işlemi tamamlandıktan sonra verileri yeniden çek
    $products = listProducts($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ürün Sil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ürün Sil</h1>
        <p>Ürün başarıyla silindi.</p>
        <a href="verileri_goruntule.php" class="btn btn-primary">Verilere Geri Dön</a>
    </div>
</body>
</html>
