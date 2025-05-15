<h2><i class="fas fa-check-circle"></i> Menentukan Angka Genap atau Ganjil dengan Ternary Operator</h2>

<p>Program ini menggunakan <strong>ternary operator</strong> untuk menentukan apakah sebuah angka termasuk genap atau
    ganjil.</p>

<form method="post">
    <label for="angka">Masukkan angka:</label>
    <input type="number" name="angka" id="angka" required>
    <button type="submit"><i class="fas fa-calculator"></i> Cek Angka</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $angka = $_POST["angka"];

    // Menggunakan ternary operator untuk menentukan genap atau ganjil
    $hasil = ($angka % 2 == 0) ? "genap" : "ganjil";
    $warna = ($hasil == "genap") ? "#e0f0ff" : "#ffe0e0";
    $icon = ($hasil == "genap") ? "fa-check-circle" : "fa-times-circle";

    echo "<div class='result' style='background-color: {$warna};'>";
    echo "<h3><i class='fas fa-calculator'></i> Hasil:</h3>";
    echo "Angka <strong>{$angka}</strong> adalah bilangan <strong>{$hasil}</strong> <i class='fas {$icon}'></i>";
    echo "</div>";

    echo "<h3><i class='fas fa-code'></i> Kode Program:</h3>";
    echo "<pre>\$hasil = (\$angka % 2 == 0) ? \"genap\" : \"ganjil\";</pre>";

    echo "<div style='margin-top: 20px; padding: 15px; background-color: #f9f7f7; border-left: 4px solid #2575fc; border-radius: 4px;'>";
    echo "<h3><i class='fas fa-lightbulb'></i> Penjelasan Ternary Operator:</h3>";
    echo "<p>Ternary operator adalah alternatif singkat untuk pernyataan if-else:</p>";
    echo "<pre>// Format ternary: condition ? value_if_true : value_if_false
    
// Sama dengan kode berikut:
if (\$angka % 2 == 0) {
    \$hasil = \"genap\";
} else {
    \$hasil = \"ganjil\";
}
</pre>";
    echo "</div>";
}
?>