<?php
include 'koneksi_db.php';

// Ambil daftar buku dan pelanggan
$buku_result = $conn->query("SELECT ID, Judul, stok FROM Buku WHERE stok > 0 ORDER BY Judul");
$pelanggan_result = $conn->query("SELECT ID, Nama FROM Pelanggan ORDER BY Nama");
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
    <title>Buat Pesanan - Toko Buku Online</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card fade-in">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-shopping-cart"></i> Buat Pesanan Baru</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle"></i> <?= htmlspecialchars($_GET['message']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="proses_transaksi.php">
                            <div class="mb-3">
                                <label for="pelanggan_id" class="form-label">
                                    <i class="fas fa-user"></i> Pilih Pelanggan
                                </label>
                                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php if ($pelanggan_result && $pelanggan_result->num_rows > 0): ?>
                                        <?php while ($row = $pelanggan_result->fetch_assoc()): ?>
                                            <option value="<?= $row['ID'] ?>"><?= htmlspecialchars($row['Nama']) ?></option>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <option value="" disabled>Tidak ada data pelanggan</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <h4 class="mt-4"><i class="fas fa-book"></i> Pilih Buku</h4>
                            <div class="mb-3">
                                <label for="buku_id" class="form-label">Buku</label>
                                <select class="form-select" name="buku[1][id]" id="buku_id" required>
                                    <option value="">-- Pilih Buku --</option>
                                    <?php if ($buku_result && $buku_result->num_rows > 0): ?>
                                        <?php while ($row = $buku_result->fetch_assoc()): ?>
                                            <option value="<?= $row['ID'] ?>">
                                                <?= htmlspecialchars($row['Judul']) ?> (Stok: <?= $row['stok'] ?>)
                                            </option>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <option value="" disabled>Tidak ada buku tersedia</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kuantitas" class="form-label">
                                    <i class="fas fa-hashtag"></i> Jumlah Buku
                                </label>
                                <input type="number" class="form-control" id="kuantitas" name="buku[1][kuantitas]"
                                    min="1" required placeholder="Masukkan jumlah buku">
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-save"></i> Buat Pesanan
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