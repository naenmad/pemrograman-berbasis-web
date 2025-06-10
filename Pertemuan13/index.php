<?php include 'proses_index.php'; ?>
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
    <title>Daftar Buku - Toko Buku Online</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card fade-in">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-book"></i> Daftar Buku</h2>
                    </div>
                    <div class="card-body">
                        <!-- Form Pencarian -->
                        <div class="glass-effect p-4 rounded mb-4">
                            <form method="get" class="row g-3">
                                <div class="col-md-5">
                                    <label for="judul" class="form-label">
                                        <i class="fas fa-search"></i> Cari Berdasarkan Judul
                                    </label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Masukkan judul buku"
                                        value="<?php echo htmlspecialchars($search_judul); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="tahun_terbit" class="form-label">
                                        <i class="fas fa-calendar"></i> Cari Berdasarkan Tahun Terbit
                                    </label>
                                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                                        placeholder="Masukkan tahun terbit"
                                        value="<?php echo htmlspecialchars($search_tahun); ?>">
                                </div>
                                <div class="col-md-2 align-self-end"> <button type="submit"
                                        class="btn btn-primary w-100">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                                <div class="col-md-2 align-self-end">
                                    <a href="index.php" class="btn btn-secondary w-100">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- Tabel Daftar Buku -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Tahun Terbit</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row['ID']; ?></td>
                                                <td><?php echo htmlspecialchars($row['Judul']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Penulis']); ?></td>
                                                <td><?php echo $row['Tahun_Terbit']; ?></td>
                                                <td>Rp<?php echo number_format($row['Harga'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <span
                                                        class="badge <?php echo $row['stok'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
                                                        <?php echo $row['stok']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="form_edit.php?id=<?php echo $row['ID']; ?>"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="proses_hapus.php?id=<?php echo $row['ID']; ?>"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <i class="fas fa-inbox"></i> Tidak ada data buku yang ditemukan
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>