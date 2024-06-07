<?php
session_start();
require_once "veritabani.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $departman = $_POST["departman"];
    $maas = $_POST["maas"];

    // Personel güncelleme işlemi
    $updateQuery = "UPDATE personeller SET ad='$ad', soyad='$soyad', departman='$departman', maas=$maas WHERE id=$id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: personel_goruntule.php");
        exit;
    } else {
        $errorMessage = "Personel güncellenirken bir hata oluştu: " . mysqli_error($conn);
    }
} else {
    // Personel bilgilerini al
    $id = $_GET["id"];
    $personel = getPersonelById($conn, $id);
    if (!$personel) {
        header("Location: personelleri_goruntule.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Staff</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Staff</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $personel["id"]; ?>">
            <div class="form-group">
                <label for="ad">Name:</label>
                <input type="text" class="form-control" name="ad" value="<?php echo $personel["ad"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="soyad">Surname:</label>
                <input type="text" class="form-control" name="soyad" value="<?php echo $personel["soyad"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="departman">Department:</label>
                <input type="text" class="form-control" name="departman" value="<?php echo $personel["departman"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="maas">Salary:</label>
                <input type="number" class="form-control" name="maas" value="<?php echo $personel["maas"]; ?>" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="personel_goruntule.php" class="btn btn-secondary">Cancel</a>
        </form>
        <?php if (isset($errorMessage)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
        <?php } ?>
    </div>
</body>
</html>
