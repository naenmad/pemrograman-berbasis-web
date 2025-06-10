<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 9 - Kalkulator Pembelian</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-wrapper {
            padding: 20px 0;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 40px 0;
        }

        .product-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            text-align: center;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: var(--transition);
            border: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: var(--transition);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-card.selected {
            border-color: var(--primary);
            background: linear-gradient(135deg, rgba(37, 117, 252, 0.05), rgba(106, 17, 203, 0.05));
        }

        .product-card.selected::before {
            transform: scaleX(1);
        }

        .product-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--primary);
            transition: var(--transition);
        }

        .product-card:hover .product-icon {
            transform: scale(1.1);
            color: var(--secondary);
        }

        .product-name {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--gray-800);
        }

        .product-price {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .calculator-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--shadow);
            margin: 40px 0;
            position: relative;
        }

        .calculator-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        .qty-btn {
            background: var(--primary);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
        }

        .qty-btn:hover {
            background: var(--secondary);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 117, 252, 0.4);
        }

        .qty-btn:disabled {
            background: var(--gray-400);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .qty-display {
            background: var(--gray-100);
            border: 3px solid var(--primary);
            border-radius: 15px;
            padding: 15px 25px;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--gray-800);
            min-width: 80px;
            text-align: center;
        }

        .receipt-container {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 249, 250, 0.95));
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--shadow-lg);
            margin: 40px 0;
            border: 1px solid var(--gray-200);
            position: relative;
        }

        .receipt-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--success), var(--primary));
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px dashed var(--gray-300);
        }

        .receipt-header h2 {
            color: var(--gray-800);
            font-size: 2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .receipt-header p {
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1.1rem;
            padding: 10px 0;
        }

        .receipt-row:not(:last-child) {
            border-bottom: 1px solid var(--gray-200);
        }

        .receipt-label {
            color: var(--gray-700);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .receipt-value {
            font-weight: 600;
            color: var(--gray-800);
        }

        .receipt-total {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.3);
        }

        .error-message {
            background: linear-gradient(135deg, var(--danger), #c82333);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .success-animation {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .selected-item {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .calculator-section,
            .receipt-container {
                padding: 25px;
            }

            .qty-btn {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .qty-display {
                padding: 12px 20px;
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .receipt-row {
                font-size: 1rem;
            }

            .quantity-selector {
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <?php
    // Informasi harga barang dalam array dengan gambar
    $daftarHargaBarang = array(
        "Keyboard" => array("price" => 150000, "image" => "https://cdn-icons-png.flaticon.com/512/2786/2786886.png"),
        "Mouse" => array("price" => 50000, "image" => "https://cdn-icons-png.flaticon.com/512/2267/2267056.png"),
        "Monitor" => array("price" => 1500000, "image" => "https://cdn-icons-png.flaticon.com/512/2777/2777154.png"),
        "Headset" => array("price" => 250000, "image" => "https://cdn-icons-png.flaticon.com/512/2937/2937230.png"),
        "Webcam" => array("price" => 350000, "image" => "https://cdn-icons-png.flaticon.com/512/685/685681.png"),
        "Speaker" => array("price" => 200000, "image" => "https://cdn-icons-png.flaticon.com/512/1577/1577410.png")
    );

    // Pajak (dijadikan konstanta)
    define("PAJAK", 0.10);

    // Inisialisasi variabel
    $namaBarang = "";
    $jumlahBeli = 1; // Default to 1
    $hargaSatuan = 0;
    $totalHargaSebelumPajak = 0;
    $jumlahPajak = 0;
    $totalHargaAkhir = 0;
    $pesanError = "";
    $showResult = false;

    // Memproses form saat disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['namaBarang']) && isset($_POST['jumlahBeli'])) {
            $namaBarang = $_POST['namaBarang'];
            $jumlahBeli = intval($_POST['jumlahBeli']);

            if ($jumlahBeli <= 0) {
                $pesanError = "Jumlah pembelian harus lebih dari 0!";
            } else {
                // Ambil harga satuan barang dari array
                $hargaSatuan = $daftarHargaBarang[$namaBarang]["price"];

                // Hitung total harga sebelum pajak
                $totalHargaSebelumPajak = $hargaSatuan * $jumlahBeli;

                // Hitung pajak
                $jumlahPajak = $totalHargaSebelumPajak * PAJAK;

                // Hitung total harga akhir
                $totalHargaAkhir = $totalHargaSebelumPajak + $jumlahPajak;

                $showResult = true;
            }
        }
    }
    ?>

    <?php
    // Informasi produk dalam array dengan ikon Font Awesome
    $daftarHargaBarang = array(
        "Keyboard Mechanical" => array(
            "price" => 750000,
            "icon" => "fas fa-keyboard",
            "description" => "Gaming keyboard dengan switch mekanik"
        ),
        "Mouse Gaming" => array(
            "price" => 350000,
            "icon" => "fas fa-computer-mouse",
            "description" => "Mouse gaming dengan sensor presisi tinggi"
        ),
        "Monitor 4K" => array(
            "price" => 3500000,
            "icon" => "fas fa-desktop",
            "description" => "Monitor 27 inch resolusi 4K"
        ),
        "Headset Gaming" => array(
            "price" => 450000,
            "icon" => "fas fa-headphones",
            "description" => "Headset gaming dengan surround sound"
        ),
        "Webcam HD" => array(
            "price" => 650000,
            "icon" => "fas fa-video",
            "description" => "Webcam 1080p dengan autofocus"
        ),
        "Speaker Bluetooth" => array(
            "price" => 850000,
            "icon" => "fas fa-volume-up",
            "description" => "Speaker portabel dengan kualitas audio premium"
        ),
        "SSD 1TB" => array(
            "price" => 1200000,
            "icon" => "fas fa-hdd",
            "description" => "Solid State Drive kapasitas 1TB"
        ),
        "RAM 16GB" => array(
            "price" => 950000,
            "icon" => "fas fa-memory",
            "description" => "Memory DDR4 16GB untuk gaming"
        )
    );

    // Pajak (dijadikan konstanta)
    define("PAJAK", 0.11);

    // Inisialisasi variabel
    $namaBarang = "";
    $jumlahBeli = 1;
    $hargaSatuan = 0;
    $totalHargaSebelumPajak = 0;
    $jumlahPajak = 0;
    $totalHargaAkhir = 0;
    $pesanError = "";
    $showResult = false;

    // Memproses form saat disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['namaBarang']) && isset($_POST['jumlahBeli'])) {
            $namaBarang = $_POST['namaBarang'];
            $jumlahBeli = intval($_POST['jumlahBeli']);

            if ($jumlahBeli <= 0) {
                $pesanError = "Jumlah pembelian harus lebih dari 0!";
            } elseif ($jumlahBeli > 50) {
                $pesanError = "Maksimal pembelian adalah 50 unit!";
            } else {
                // Ambil harga satuan barang dari array
                $hargaSatuan = $daftarHargaBarang[$namaBarang]["price"];

                // Hitung total harga sebelum pajak
                $totalHargaSebelumPajak = $hargaSatuan * $jumlahBeli;

                // Hitung pajak
                $jumlahPajak = $totalHargaSebelumPajak * PAJAK;

                // Hitung total harga akhir
                $totalHargaAkhir = $totalHargaSebelumPajak + $jumlahPajak;

                $showResult = true;
            }
        }
    }
    ?>

    <header>
        <div class="container">
            <h1><i class="fas fa-calculator"></i> Kalkulator Pembelian</h1>
            <p>Sistem perhitungan harga dengan pajak otomatis untuk produk teknologi</p>
        </div>
    </header>

    <div class="page-wrapper">
        <div class="container">

            <!-- Tampilkan error jika ada -->
            <?php if ($pesanError): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $pesanError; ?>
                </div>
            <?php endif; ?>

            <!-- Grid Produk -->
            <h2 style="text-align: center; margin-bottom: 30px; color: var(--gray-800); font-size: 2rem;">
                <i class="fas fa-shopping-bag"></i> Pilih Produk
            </h2>

            <div class="product-grid">
                <?php foreach ($daftarHargaBarang as $nama => $data): ?>
                    <div class="product-card <?php echo ($namaBarang == $nama && $showResult) ? 'selected' : ''; ?>"
                        onclick="selectProduct('<?php echo $nama; ?>')">
                        <div class="product-icon">
                            <i class="<?php echo $data['icon']; ?>"></i>
                        </div>
                        <div class="product-name"><?php echo $nama; ?></div>
                        <div class="product-price">Rp <?php echo number_format($data["price"], 0, ',', '.'); ?></div>
                        <p style="color: var(--gray-600); font-size: 0.9rem; margin-top: 10px;">
                            <?php echo $data['description']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Form Kalkulator -->
            <div class="calculator-section">
                <h2 style="text-align: center; margin-bottom: 30px; color: var(--gray-800);">
                    <i class="fas fa-cogs"></i> Konfigurasi Pembelian
                </h2>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="calculatorForm">

                    <?php if ($namaBarang): ?>
                        <div class="selected-item">
                            <i class="<?php echo $daftarHargaBarang[$namaBarang]['icon']; ?>"></i>
                            <span><?php echo $namaBarang; ?></span>
                            <span>Rp
                                <?php echo number_format($daftarHargaBarang[$namaBarang]["price"], 0, ',', '.'); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="namaBarang"
                            style="text-align: center; display: block; font-size: 1.2rem; margin-bottom: 15px;">
                            <i class="fas fa-box"></i> Pilih Produk
                        </label>
                        <select id="namaBarang" name="namaBarang" required onchange="updateSelection()">
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach ($daftarHargaBarang as $nama => $data): ?>
                                <option value="<?php echo $nama; ?>" <?php echo ($namaBarang == $nama) ? 'selected' : ''; ?>>
                                    <?php echo $nama; ?> - Rp <?php echo number_format($data["price"], 0, ',', '.'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label style="font-size: 1.2rem; margin-bottom: 15px; display: block;">
                            <i class="fas fa-sort-numeric-up"></i> Jumlah Pembelian
                        </label>

                        <div class="quantity-selector">
                            <button type="button" class="qty-btn" onclick="changeQuantity(-1)">
                                <i class="fas fa-minus"></i>
                            </button>

                            <input type="number" id="jumlahBeli" name="jumlahBeli" class="qty-display" min="1" max="50"
                                value="<?php echo $jumlahBeli; ?>" readonly required>

                            <button type="button" class="qty-btn" onclick="changeQuantity(1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-large" style="margin-top: 30px;">
                        <i class="fas fa-calculator"></i> Hitung Total Belanja
                    </button>
                </form>
            </div>

            <!-- Hasil Perhitungan -->
            <?php if ($showResult): ?>
                <div class="receipt-container success-animation">
                    <div class="receipt-header">
                        <h2>
                            <i class="fas fa-receipt"></i>
                            Invoice Pembelian
                        </h2>
                        <p>Tanggal: <?php echo date('d F Y, H:i'); ?> WIB</p>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">
                            <i class="fas fa-tag"></i>
                            Nama Produk
                        </span>
                        <span class="receipt-value"><?php echo $namaBarang; ?></span>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">
                            <i class="fas fa-dollar-sign"></i>
                            Harga Satuan
                        </span>
                        <span class="receipt-value">Rp <?php echo number_format($hargaSatuan, 0, ',', '.'); ?></span>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">
                            <i class="fas fa-cubes"></i>
                            Jumlah
                        </span>
                        <span class="receipt-value"><?php echo $jumlahBeli; ?> unit</span>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">
                            <i class="fas fa-calculator"></i>
                            Subtotal
                        </span>
                        <span class="receipt-value">Rp
                            <?php echo number_format($totalHargaSebelumPajak, 0, ',', '.'); ?></span>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">
                            <i class="fas fa-percentage"></i>
                            Pajak (<?php echo (PAJAK * 100); ?>%)
                        </span>
                        <span class="receipt-value">Rp <?php echo number_format($jumlahPajak, 0, ',', '.'); ?></span>
                    </div>

                    <div class="receipt-total">
                        <i class="fas fa-credit-card"></i>
                        Total Pembayaran: Rp <?php echo number_format($totalHargaAkhir, 0, ',', '.'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back Link -->
            <div class="back-link">
                <a href="../index.html">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
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

    <script>
        function selectProduct(productName) {
            document.getElementById('namaBarang').value = productName;
            updateSelection();
        }

        function updateSelection() {
            const selectedProduct = document.getElementById('namaBarang').value;
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                card.classList.remove('selected');
            });

            if (selectedProduct) {
                const productNames = <?php echo json_encode(array_keys($daftarHargaBarang)); ?>;
                const index = productNames.indexOf(selectedProduct);
                if (index !== -1) {
                    productCards[index].classList.add('selected');
                }
            }
        }

        function changeQuantity(change) {
            const input = document.getElementById('jumlahBeli');
            let currentValue = parseInt(input.value);
            let newValue = currentValue + change;

            if (newValue >= 1 && newValue <= 50) {
                input.value = newValue;
            }
        }

        // Update selection on page load
        document.addEventListener('DOMContentLoaded', function () {
            updateSelection();
        });
    </script>

</body>

</html>