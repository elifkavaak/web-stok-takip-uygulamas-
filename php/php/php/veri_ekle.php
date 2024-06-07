<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "veritabani.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urun_ad = $_POST["urun_ad"];
    $stok_miktar = $_POST["stok_miktar"];
    $fiyat = $_POST["fiyat"];

    insertProduct($conn, $urun_ad, $stok_miktar, $fiyat);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Add Data</h1>
        <form method="post" action="">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="urun_ad" class="form-control">
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stok_miktar" class="form-control">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="fiyat" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <a href="verileri_goruntule.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</body>
</html>
