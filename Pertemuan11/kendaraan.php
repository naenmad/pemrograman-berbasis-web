<h2><i class="fas fa-car"></i> Menentukan Jenis Kendaraan Berdasarkan Jumlah Roda</h2>

<p>Program ini menggunakan struktur kontrol <strong>switch</strong> untuk menentukan jenis kendaraan berdasarkan jumlah
    rodanya.</p>

<form method="post">
    <label for="jumlah_roda">Masukkan jumlah roda:</label>
    <input type="number" name="jumlah_roda" id="jumlah_roda" min="1" required>
    <button type="submit"><i class="fas fa-search"></i> Cek Kendaraan</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_roda = $_POST["jumlah_roda"];

    echo "<div class='result'>";
    echo "<h3><i class='fas fa-check-circle'></i> Hasil:</h3>";

    switch ($jumlah_roda) {
        case 1:
            echo "Kendaraan dengan 1 roda: <strong>Monocycle</strong>";
            break;
        case 2:
            echo "Kendaraan dengan 2 roda: <strong>Sepeda motor, Sepeda</strong>";
            break;
        case 3:
            echo "Kendaraan dengan 3 roda: <strong>Becak, Bajaj</strong>";
            break;
        case 4:
            echo "Kendaraan dengan 4 roda: <strong>Mobil, Truk kecil</strong>";
            break;
        case 6:
            echo "Kendaraan dengan 6 roda: <strong>Truk sedang</strong>";
            break;
        case 8:
        case 10:
        case 12:
            echo "Kendaraan dengan {$jumlah_roda} roda: <strong>Truk besar</strong>";
            break;
        default:
            echo "Tidak ada kategori kendaraan untuk <strong>{$jumlah_roda} roda</strong>";
    }
    echo "</div>";

    echo "<h3><i class='fas fa-code'></i> Kode Program:</h3>";
    echo "<pre>
switch (\$jumlah_roda) {
    case 1:
        echo \"Kendaraan dengan 1 roda: Monocycle\";
        break;
    case 2:
        echo \"Kendaraan dengan 2 roda: Sepeda motor, Sepeda\";
        break;
    case 3:
        echo \"Kendaraan dengan 3 roda: Becak, Bajaj\";
        break;
    case 4:
        echo \"Kendaraan dengan 4 roda: Mobil, Truk kecil\";
        break;
    case 6:
        echo \"Kendaraan dengan 6 roda: Truk sedang\";
        break;
    case 8:
    case 10:
    case 12:
        echo \"Kendaraan dengan {\$jumlah_roda} roda: Truk besar\";
        break;
    default:
        echo \"Tidak ada kategori kendaraan untuk {\$jumlah_roda} roda\";
}
</pre>";
}
?>