<?php
include 'koneksi_db.php';

$id = $_GET['id'] ?? 0;

// Validasi ID
if (!is_numeric($id) || $id <= 0) {
    echo "<script>
        alert('ID tidak valid!');
        window.location.href = 'index.php';
    </script>";
    exit;
}

// Ambil data buku berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM Buku WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Jika data tidak ditemukan
if (!$row) {
    echo "<script>
        alert('Data buku tidak ditemukan!');
        window.location.href = 'index.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Buku - Toko Buku Online</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card fade-in pulse">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-edit"></i> Edit Data Buku</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="proses_edit.php" class="slide-up">
                            <input type="hidden" name="id" value="<?= $row['ID'] ?>">

                            <div class="mb-3">
                                <label for="judul" class="form-label">
                                    <i class="fas fa-book"></i> Judul Buku
                                </label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="<?= htmlspecialchars($row['Judul']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="penulis" class="form-label">
                                    <i class="fas fa-user"></i> Penulis
                                </label>
                                <input type="text" class="form-control" id="penulis" name="penulis"
                                    value="<?= htmlspecialchars($row['Penulis']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">
                                    <i class="fas fa-calendar"></i> Tahun Terbit
                                </label>
                                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                                    value="<?= $row['Tahun_Terbit'] ?>" required min="1900"
                                    max="<?php echo date('Y'); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">
                                    <i class="fas fa-money-bill"></i> Harga (Rp)
                                </label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    value="<?= $row['Harga'] ?>" step="1000" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">
                                    <i class="fas fa-boxes"></i> Stok
                                </label>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    value="<?= $row['stok'] ?>" required min="0">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>