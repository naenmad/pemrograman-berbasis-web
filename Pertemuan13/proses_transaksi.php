<?php
include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mulai transaksi database
    $conn->begin_transaction();

    try {
        $pelanggan_id = $_POST['pelanggan_id'];
        $tanggal_pesanan = date('Y-m-d');
        $total_harga = 0;

        // Validasi pelanggan
        if (empty($pelanggan_id)) {
            throw new Exception("Pelanggan harus dipilih.");
        }

        // Insert ke tabel Pesanan
        $stmt = $conn->prepare("INSERT INTO Pesanan (Tanggal_Pesanan, Pelanggan_ID, Total_Harga) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $tanggal_pesanan, $pelanggan_id, $total_harga);
        $stmt->execute();
        $pesanan_id = $conn->insert_id;

        // Loop buku yang dipilih
        foreach ($_POST['buku'] as $buku) {
            $buku_id = $buku['id'];
            $kuantitas = $buku['kuantitas'];

            // Validasi input
            if (empty($buku_id) || empty($kuantitas) || $kuantitas <= 0) {
                throw new Exception("Buku dan kuantitas harus diisi dengan benar.");
            }

            // Ambil harga dan stok buku
            $stmt = $conn->prepare("SELECT Harga, stok FROM Buku WHERE ID = ?");
            $stmt->bind_param("i", $buku_id);
            $stmt->execute();
            $stmt->bind_result($harga_per_satuan, $stok);
            $stmt->fetch();
            $stmt->close();

            // Cek apakah stok mencukupi
            if ($stok < $kuantitas) {
                throw new Exception("Stok buku tidak mencukupi. Stok tersedia: $stok");
            }

            // Insert detail pesanan
            $stmt = $conn->prepare("INSERT INTO Detail_Pesanan (Pesanan_ID, Buku_ID, Kuantitas, Harga_Per_Satuan) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $pesanan_id, $buku_id, $kuantitas, $harga_per_satuan);
            $stmt->execute();

            // Hitung total harga
            $total_harga += $kuantitas * $harga_per_satuan;

            // Update stok buku
            $stmt = $conn->prepare("UPDATE Buku SET stok = stok - ? WHERE ID = ?");
            $stmt->bind_param("ii", $kuantitas, $buku_id);
            $stmt->execute();
        }

        // Update total harga di tabel pesanan
        $stmt = $conn->prepare("UPDATE Pesanan SET Total_Harga = ? WHERE ID = ?");
        $stmt->bind_param("di", $total_harga, $pesanan_id);
        $stmt->execute();

        // Commit transaksi
        $conn->commit();

        echo "<script>
            alert('Pesanan berhasil dibuat! Total: Rp " . number_format($total_harga, 2, ',', '.') . "');
            window.location.href = 'lihat_transaksi.php';
        </script>";
        exit;

    } catch (Exception $e) {
        // Rollback jika terjadi error
        $conn->rollback();

        echo "<script>
            alert('Gagal membuat pesanan: " . addslashes($e->getMessage()) . "');
            window.location.href = 'transaksi.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('Akses tidak valid!');
        window.location.href = 'transaksi.php';
    </script>";
}
?>