<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require_once "veritabani.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $personelId = $_GET["id"];

    // Personeli silme işlemi
    $sql = "DELETE FROM personeller WHERE id=$personelId";
    if (mysqli_query($conn, $sql)) {
        header("Location: personel_goruntule.php");
        exit;
    } else {
        echo "Personel silinirken bir hata oluştu: " . mysqli_error($conn);
    }
} else {
    echo "Geçersiz istek.";
}
?>
