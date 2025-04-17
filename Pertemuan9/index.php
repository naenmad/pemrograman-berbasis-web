<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Pembelian</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* Custom styles for this page */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .product-item {
            background-color: white;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            border: 2px solid transparent;
        }
        
        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .product-item.selected {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(42, 109, 244, 0.2);
        }
        
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin: 0 auto 15px;
            display: block;
        }
        
        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .product-price {
            color: var(--primary);
            font-weight: bold;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }
        
        .quantity-btn {
            background-color: var(--light);
            color: var(--dark);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-btn:hover {
            background-color: var(--primary);
            color: white;
        }
        
        #qtyDisplay {
            width: 40px;
            text-align: center;
            font-weight: bold;
            margin: 0 10px;
            border: none;
            background: transparent;
        }
        
        .receipt-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        
        .receipt-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
        }
        
        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 1.1em;
        }
        
        .receipt-divider {
            border-top: 1px dashed #ddd;
            margin: 15px 0;
        }
        
        .receipt-total {
            font-size: 1.3em;
            font-weight: bold;
            color: var(--primary);
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            opacity: 0.03;
            pointer-events: none;
            font-weight: bold;
            color: var(--primary);
        }
        
        .product-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--accent);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .actions-row {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .actions-row .btn {
            flex: 1;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
        }
        
        .btn-secondary:hover {
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        /* Styling for mobile */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .receipt-row {
                font-size: 0.95em;
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
    if(isset($_POST['namaBarang']) && isset($_POST['jumlahBeli'])) {
        $namaBarang = $_POST['namaBarang'];
        $jumlahBeli = intval($_POST['jumlahBeli']);
        
        if($jumlahBeli <= 0) {
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

<header>
    <div class="container">
        <h1><i class="fas fa-shopping-cart"></i> Kalkulator Pembelian</h1>
        <p>Hitung total pembelian dengan mudah dan cepat</p>
    </div>
</header>

<div class="container" style="margin-top: 30px;">
    <div class="meeting-cards">
        <!-- Form Input -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3>Pilih Produk</h3>
            </div>
            <div class="card-body">
                <?php if($pesanError): ?>
                    <div style="background-color: var(--accent); color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <?php echo $pesanError; ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="namaBarang">Nama Barang:</label>
                    <select id="namaBarang" name="namaBarang" required>
                        <?php foreach($daftarHargaBarang as $nama => $data): ?>
                            <option value="<?php echo $nama; ?>" <?php echo ($namaBarang == $nama) ? 'selected' : ''; ?>>
                                <?php echo $nama; ?> - Rp <?php echo number_format($data["price"], 0, ',', '.'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="jumlahBeli">Jumlah:</label>
                    <input type="number" id="jumlahBeli" name="jumlahBeli" min="1" required value="<?php echo $jumlahBeli; ?>">
                    
                    <button type="submit">Hitung</button>
                </form>
            </div>
        </div>

        <!-- Hasil Perhitungan -->
        <?php if($showResult): ?>
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <h3>Hasil Perhitungan</h3>
            </div>
            <div class="card-body">
                <p>Nama Barang: <?php echo $namaBarang; ?></p>
                <p>Harga Satuan: Rp <?php echo number_format($hargaSatuan, 0, ',', '.'); ?></p>
                <p>Jumlah Beli: <?php echo $jumlahBeli; ?></p>
                <p>Total Harga (Sebelum Pajak): Rp <?php echo number_format($totalHargaSebelumPajak, 0, ',', '.'); ?></p>
                <p>Pajak (<?php echo (PAJAK * 100); ?>%): Rp <?php echo number_format($jumlahPajak, 0, ',', '.'); ?></p>
                <p><b>Total Bayar: Rp <?php echo number_format($totalHargaAkhir, 0, ',', '.'); ?></b></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>