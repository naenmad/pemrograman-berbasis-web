<?php
include 'koneksi_db.php';

$pesanan_id = $_GET['id'] ?? 0;

// Validasi ID pesanan
if (!is_numeric($pesanan_id) || $pesanan_id <= 0) {
    echo "<script>
        alert('ID pesanan tidak valid!');
        window.location.href = 'lihat_transaksi.php';
    </script>";
    exit;
}

// Query untuk mengambil detail pesanan
$query_pesanan = "
    SELECT Pesanan.ID, Pesanan.Tanggal_Pesanan, Pesanan.Total_Harga, Pelanggan.Nama
    FROM Pesanan 
    JOIN Pelanggan ON Pesanan.Pelanggan_ID = Pelanggan.ID 
    WHERE Pesanan.ID = ?
";
$stmt = $conn->prepare($query_pesanan);
$stmt->bind_param("i", $pesanan_id);
$stmt->execute();
$pesanan = $stmt->get_result()->fetch_assoc();

if (!$pesanan) {
    echo "<script>
        alert('Pesanan tidak ditemukan!');
        window.location.href = 'lihat_transaksi.php';
    </script>";
    exit;
}

// Query untuk mengambil detail item pesanan
$query_detail = "
    SELECT Detail_Pesanan.*, Buku.Judul, Buku.Penulis
    FROM Detail_Pesanan 
    JOIN Buku ON Detail_Pesanan.Buku_ID = Buku.ID 
    WHERE Detail_Pesanan.Pesanan_ID = ?
";
$stmt = $conn->prepare($query_detail);
$stmt->bind_param("i", $pesanan_id);
$stmt->execute();
$detail_result = $stmt->get_result();
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
    <title>Detail Pesanan #<?= $pesanan['ID'] ?> - Toko Buku Online</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card fade-in glass-effect">
                    <div class="card-header">
                        <h2 class="mb-0">
                            <i class="fas fa-file-invoice"></i> Detail Pesanan #<?= $pesanan['ID'] ?>
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- Info Pesanan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5><i class="fas fa-user"></i> Informasi Pelanggan</h5>
                                <p><strong>Nama:</strong> <?= htmlspecialchars($pesanan['Nama']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="fas fa-calendar"></i> Informasi Pesanan</h5>
                                <p><strong>Tanggal:</strong>
                                    <?= date('d/m/Y', strtotime($pesanan['Tanggal_Pesanan'])) ?></p>
                                <p><strong>Total Harga:</strong>
                                    <span class="text-success fw-bold">
                                        Rp<?= number_format($pesanan['Total_Harga'], 2, ',', '.') ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <!-- Detail Items -->
                        <h5><i class="fas fa-list"></i> Detail Item Pesanan</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Penulis</th>
                                        <th>Harga Satuan</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($detail = $detail_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($detail['Judul']) ?></td>
                                            <td><?= htmlspecialchars($detail['Penulis']) ?></td>
                                            <td>Rp<?= number_format($detail['Harga_Per_Satuan'], 2, ',', '.') ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $detail['Kuantitas'] ?></span>
                                            </td>
                                            <td>
                                                <strong>
                                                    Rp<?= number_format($detail['Harga_Per_Satuan'] * $detail['Kuantitas'], 2, ',', '.') ?>
                                                </strong>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th colspan="4" class="text-end">Total Keseluruhan:</th>
                                        <th>Rp<?= number_format($pesanan['Total_Harga'], 2, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="lihat_transaksi.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
                            </a>
                            <button onclick="window.print()" class="btn btn-success">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>