<?php
session_start();
require_once "veritabani.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $departman = $_POST["departman"];
    $maas = $_POST["maas"];

    // Personel ekleme işlemi
    $insertQuery = "INSERT INTO personeller (ad, soyad, departman, maas) VALUES ('$ad', '$soyad', '$departman', $maas)";
    if (mysqli_query($conn, $insertQuery)) {
        header("Location: personel_goruntule.php");
        exit;
    } else {
        $errorMessage = "Personel eklenirken bir hata oluştu: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Staff</h1>
        <form method="POST">
            <div class="form-group">
                <label for="ad">Name:</label>
                <input type="text" class="form-control" name="ad" required>
            </div>
            <div class="form-group">
                <label for="soyad">Surname:</label>
                <input type="text" class="form-control" name="soyad" required>
            </div>
            <div class="form-group">
                <label for="departman">Department:</label>
                <input type="text" class="form-control" name="departman" required>
            </div>
            <div class="form-group">
                <label for="maas">Salary:</label>
                <input type="number" class="form-control" name="maas" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="personel_goruntule.php" class="btn btn-secondary">Cancel</a>
        </form>
        <?php if (isset($errorMessage)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
        <?php } ?>
    </div>
</body>
</html>
