<?php
include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun_terbit'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Validasi input
    if (empty($judul) || empty($penulis) || empty($tahun) || empty($harga) || empty($stok)) {
        echo "<script>
            alert('Semua field harus diisi!');
            window.location.href = 'form_edit.php?id=" . $id . "';
        </script>";
        exit;
    }

    // Siapkan query UPDATE dengan prepared statement
    $stmt = $conn->prepare("UPDATE Buku SET Judul=?, Penulis=?, Tahun_Terbit=?, Harga=?, stok=? WHERE ID=?");
    $stmt->bind_param("ssiiii", $judul, $penulis, $tahun, $harga, $stok, $id);
    // ssiii = string, string, integer, integer, integer, integer

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "<script>
            alert('Data berhasil diperbarui!'); 
            window.location.href='index.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan: " . addslashes($stmt->error) . "'); 
            window.location.href='form_edit.php?id=" . $id . "';
        </script>";
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika bukan method POST, redirect ke index
    echo "<script>
        alert('Akses tidak valid!');
        window.location.href = 'index.php';
    </script>";
}

// Tutup koneksi
$conn->close();
?>