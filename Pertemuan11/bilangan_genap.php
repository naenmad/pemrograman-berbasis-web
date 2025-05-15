<h2><i class="fas fa-list-ol"></i> Mencetak Bilangan Genap dari 2 sampai 10</h2>

<p>Program ini menggunakan perulangan <strong>for</strong> untuk mencetak bilangan genap mulai dari 2 sampai 10.</p>

<div class="result">
    <h3><i class="fas fa-check-circle"></i> Hasil:</h3>
    <p style="font-size: 1.2rem; font-weight: 500;">
        <?php
        for ($i = 2; $i <= 10; $i += 2) {
            echo "<span style='display: inline-block; background-color: #e0f0ff; padding: 5px 12px; margin: 3px; border-radius: 50%;'>{$i}</span>";
            if ($i < 10) {
                echo " ";
            }
        }
        ?>
    </p>
</div>

<h3><i class="fas fa-code"></i> Kode Program:</h3>
<pre>
for ($i = 2; $i <= 10; $i += 2) {
    echo $i;
    if ($i < 10) {
        echo ", ";
    }
}
</pre>

<div
    style="margin-top: 20px; padding: 15px; background-color: #f9f7f7; border-left: 4px solid #2575fc; border-radius: 4px;">
    <h3><i class="fas fa-lightbulb"></i> Penjelasan:</h3>
    <p>Loop <code>for</code> digunakan dengan kondisi:</p>
    <ul>
        <li><strong>Inisialisasi:</strong> $i = 2 (mulai dari 2)</li>
        <li><strong>Kondisi:</strong> $i <= 10 (lanjutkan selama $i kurang dari atau sama dengan 10)</li>
        <li><strong>Iterasi:</strong> $i += 2 (tambahkan 2 pada setiap iterasi untuk mendapatkan bilangan genap)</li>
    </ul>
</div>