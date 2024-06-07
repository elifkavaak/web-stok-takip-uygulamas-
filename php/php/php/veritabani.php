<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homework";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// Ürünleri listeleme
function listProducts($conn) {
    $sql = "SELECT * FROM stoklar";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function listPersoneller($conn) {
    $personeller = array();

    $sql = "SELECT * FROM personeller";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $personeller[] = $row;
        }
    }

    return $personeller;
}

// Yeni ürün ekleme
function insertProduct($conn, $urun_ad, $stok_miktar, $fiyat) {
    $sql = "INSERT INTO stoklar (urun_ad, stok_miktar, fiyat) VALUES ('$urun_ad', $stok_miktar, $fiyat)";
    header("Location: verileri_goruntule.php");
    return $conn->query($sql);
}

// ID'ye göre ürün bilgisini getirme
function getPersonelById($conn, $id) {
    $sql = "SELECT * FROM personeller WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function getProductById($conn, $id) {
    $sql = "SELECT * FROM stoklar WHERE id=$id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Ürün güncelleme
function updateProduct($conn, $id, $urun_ad, $stok_miktar, $fiyat) {
    $sql = "UPDATE stoklar SET urun_ad='$urun_ad', stok_miktar=$stok_miktar, fiyat=$fiyat WHERE id=$id";
    header("Location: verileri_goruntule.php");
    return $conn->query($sql);  
}


// Ürün silme
function deleteProduct($conn, $id) {
    $sql = "DELETE FROM stoklar WHERE id=$id";
    header("Location: verileri_goruntule.php");
    return $conn->query($sql);
}
// Bağlantıyı kapatma (Uygulamanın sonunda yapılmalı)
//$conn->close();
?>
