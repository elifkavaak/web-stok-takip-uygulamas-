<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// createDB.php ve createPersonel.php dosyalarını çağırarak veritabanını ve tabloyu oluşturun
require_once "createPersonel.php";

// veritabani.php dosyasını dahil et
require_once "veritabani.php";

// Ürünleri listele
$products = listProducts($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Staff</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>View Staff</h1>
            <a href="dashboard.php" class="btn btn-secondary">Back to Main Menu</a>
            <a href="personel_ekle.php" class="btn btn-success ml-2">Add Staff</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Transactions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // veritabani.php dosyasını dahil et
                require_once "veritabani.php";

                // Personelleri listele
                $personeller = listPersoneller($conn);

                foreach ($personeller as $personel) {
                ?>
                    <tr>
                        <td><?php echo $personel["ad"]; ?></td>
                        <td><?php echo $personel["soyad"]; ?></td>
                        <td><?php echo $personel["departman"]; ?></td>
                        <td><?php echo $personel["maas"]; ?> ₺</td>
                        <td>
                            <a href="personel_guncelle.php?id=<?php echo $personel["id"]; ?>" class="btn btn-primary">Update</a>
                            <a href="personel_sil.php?id=<?php echo $personel["id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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
