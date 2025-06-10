<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Praktikum PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-code"></i> Latihan Praktikum PHP</h1>
            <p>Pertemuan 11 - Struktur Kontrol dan Pengulangan PHP</p>
        </div>
    </header>

    <div class="container">
        <nav class="fade-in">
            <a href="?page=kendaraan"><i class="fas fa-car"></i> Jenis Kendaraan</a>
            <a href="?page=bilangan_genap"><i class="fas fa-list-ol"></i> Bilangan Genap</a>
            <a href="?page=daftar_hewan"><i class="fas fa-paw"></i> Daftar Hewan</a>
            <a href="?page=genap_ganjil"><i class="fas fa-check-circle"></i> Genap Ganjil</a>
            <a href="../index.html"><i class="fas fa-home"></i> Kembali ke Beranda</a>
        </nav>

        <div class="content slide-up">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            switch ($page) {
                case 'kendaraan':
                    include 'kendaraan.php';
                    break;
                case 'bilangan_genap':
                    include 'bilangan_genap.php';
                    break;
                case 'daftar_hewan':
                    include 'daftar_hewan.php';
                    break;
                case 'genap_ganjil':
                    include 'genap_ganjil.php';
                    break;
                default:
                    echo "<h2><i class='fas fa-info-circle'></i> Selamat Datang di Praktikum PHP</h2>";
                    echo "<p>Silakan pilih menu navigasi di atas untuk melihat hasil latihan praktikum.</p>";
                    echo "<div class='result'>";
                    echo "<h3><i class='fas fa-lightbulb'></i> Materi Pembelajaran</h3>";
                    echo "<p>Pada praktikum ini, Anda akan mempelajari:</p>";
                    echo "<ul>";
                    echo "<li><strong>Switch Statement</strong> - Untuk menentukan jenis kendaraan berdasarkan jumlah roda</li>";
                    echo "<li><strong>For Loop</strong> - Untuk mencetak bilangan genap dari 2 sampai 10</li>";
                    echo "<li><strong>Array & Foreach</strong> - Untuk menampilkan daftar nama hewan</li>";
                    echo "<li><strong>Ternary Operator</strong> - Untuk menentukan angka genap atau ganjil</li>";
                    echo "</ul>";
                    echo "</div>";
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="social-icons">
                <a href="https://github.com/naenmad" class="social-icon" target="_blank" title="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://linkedin.com/in/naen" class="social-icon" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <p>&copy; 2025 Ahmad Zulkarnaen. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>