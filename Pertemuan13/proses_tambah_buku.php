<?php
include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang dikirim melalui form dengan method POST
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Validasi input
    if (empty($judul) || empty($penulis) || empty($tahun_terbit) || empty($harga) || empty($stok)) {
        echo "<script>
            alert('Semua field harus diisi!');
            window.location.href = 'tambah_buku.php';
        </script>";
        exit;
    }

    // Menyiapkan query SQL untuk menyisipkan data ke tabel 'Buku' menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO Buku (Judul, Penulis, Tahun_Terbit, Harga, stok) VALUES (?, ?, ?, ?, ?)");

    // Mengikat parameter ke statement SQL dengan format tipe data:
    // s = string, i = integer. Dalam hal ini: judul & penulis (string), lainnya integer
    $stmt->bind_param("ssiii", $judul, $penulis, $tahun_terbit, $harga, $stok);

    // Mengeksekusi statement, dan menyimpan pesan keberhasilan atau kesalahan
    if ($stmt->execute()) {
        echo "<script>
            alert('Buku berhasil ditambahkan!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan buku: " . addslashes($stmt->error) . "');
            window.location.href = 'tambah_buku.php';
        </script>";
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>