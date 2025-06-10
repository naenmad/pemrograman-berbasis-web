<?php
include 'koneksi_db.php'; // Koneksi database

// Query untuk menampilkan data pesanan beserta nama pelanggan dan total harga
$query = "
    SELECT Pesanan.ID AS Pesanan_ID, Pelanggan.Nama AS Nama_Pelanggan, 
           Pesanan.Tanggal_Pesanan, Pesanan.Total_Harga
    FROM Pesanan
    JOIN Pelanggan ON Pesanan.Pelanggan_ID = Pelanggan.ID
    ORDER BY Pesanan.ID DESC
";
$result = $conn->query($query);
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
    <title>Daftar Pesanan - Toko Buku Online</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card fade-in">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-receipt"></i> Daftar Pesanan</h2>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Daftar Pesanan -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result && $result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td>
                                                    <span class="badge bg-info">#<?= $row['Pesanan_ID'] ?></span>
                                                </td>
                                                <td><?= htmlspecialchars($row['Nama_Pelanggan']) ?></td>
                                                <td>
                                                    <i class="fas fa-calendar"></i>
                                                    <?= date('d/m/Y', strtotime($row['Tanggal_Pesanan'])) ?>
                                                </td>
                                                <td>
                                                    <strong class="text-success">
                                                        Rp<?= number_format($row['Total_Harga'], 2, ',', '.') ?>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <a href="detail_pesanan.php?id=<?= $row['Pesanan_ID'] ?>"
                                                        class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <i class="fas fa-inbox"></i> Belum ada pesanan yang dibuat
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <a href="transaksi.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buat Pesanan Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>