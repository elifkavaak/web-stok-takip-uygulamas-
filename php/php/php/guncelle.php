<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "veritabani.php";

// Eğer form gönderildiyse güncelleme işlemini yap
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $urun_ad = $_POST["urun_ad"];
    $stok_miktar = $_POST["stok_miktar"];
    $fiyat = $_POST["fiyat"];

    // Ürünü güncelle
    updateProduct($conn, $id, $urun_ad, $stok_miktar, $fiyat);

    // Güncelleme yapıldıktan sonra verileri yeniden çek
    $products = listProducts($conn);
} else {
    // Sayfa ilk kez yüklendiğinde ürün bilgilerini al
    $id = $_GET["id"];
    $product = getProductById($conn, $id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <br>
        <h1>Update Product</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="urun_ad" class="form-control" value="<?php echo $product["urun_ad"]; ?>">
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stok_miktar" class="form-control" value="<?php echo $product["stok_miktar"]; ?>">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="fiyat" class="form-control" value="<?php echo $product["fiyat"]; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="verileri_goruntule.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
