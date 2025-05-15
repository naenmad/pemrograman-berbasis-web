<h2><i class="fas fa-paw"></i> Daftar Nama Hewan</h2>

<p>Program ini menggunakan <strong>array</strong> dan <strong>foreach</strong> untuk menampilkan daftar nama hewan.</p>

<div>
    <div class="result">
        <h3><i class="fas fa-check-circle"></i> Hasil:</h3>
        <?php
        // Membuat array daftar nama hewan
        $daftar_hewan = [
            "Kucing",
            "Anjing",
            "Kelinci",
            "Kuda",
            "Sapi",
            "Kambing",
            "Ayam",
            "Burung",
            "Ikan",
            "Hamster"
        ];

        // Definisi ikon untuk setiap hewan
        $icons = [
            "Kucing" => "fa-cat",
            "Anjing" => "fa-dog",
            "Kelinci" => "fa-rabbit",
            "Kuda" => "fa-horse",
            "Sapi" => "fa-cow",
            "Kambing" => "fa-goat",
            "Ayam" => "fa-kiwi-bird",
            "Burung" => "fa-dove",
            "Ikan" => "fa-fish",
            "Hamster" => "fa-paw"
        ];

        echo "<ol style='display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); grid-gap: 10px;'>";
        // Menampilkan daftar hewan menggunakan foreach
        foreach ($daftar_hewan as $hewan) {
            $icon = isset($icons[$hewan]) ? $icons[$hewan] : "fa-paw";
            echo "<li style='background-color: #e0f0ff; padding: 10px; border-radius: 5px;'><i class='fas {$icon}'></i> {$hewan}</li>";
        }
        echo "</ol>";
        ?>
    </div>

    <h3><i class="fas fa-code"></i> Kode Program:</h3>
    <pre>
$daftar_hewan = [
    "Kucing",
    "Anjing",
    "Kelinci",
    "Kuda",
    "Sapi",
    "Kambing",
    "Ayam",
    "Burung",
    "Ikan",
    "Hamster"
];

echo "&lt;ol&gt;";
foreach ($daftar_hewan as $hewan) {
    echo "&lt;li&gt;$hewan&lt;/li&gt;";
}
echo "&lt;/ol&gt;";
    </pre>

    <div
        style="margin-top: 20px; padding: 15px; background-color: #f9f7f7; border-left: 4px solid #2575fc; border-radius: 4px;">
        <h3><i class="fas fa-lightbulb"></i> Penjelasan:</h3>
        <p>Program di atas menggunakan:</p>
        <ul>
            <li><strong>Array</strong> untuk menyimpan daftar nama hewan</li>
            <li><strong>Foreach</strong> untuk mengiterasi melalui array dan menampilkan setiap elemen</li>
            <li>HTML &lt;ol&gt; dan &lt;li&gt; untuk menampilkan daftar terurut</li>
        </ul>
    </div>
</div>