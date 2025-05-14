<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2 - Diskon UKT Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .result-container {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            border-left: 4px solid #4CAF50;
        }

        .result-item {
            margin-bottom: 8px;
        }

        .result-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Latihan 2</h1>
            <p>Perhitungan Diskon UKT Mahasiswa</p>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-calculator"></i> Form Pembayaran UKT</h2>

            <form method="post" action="">
                <div class="form-group">
                    <label for="npm">NPM:</label>
                    <input type="text" id="npm" name="npm" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="prodi">Program Studi:</label>
                    <input type="text" id="prodi" name="prodi" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <input type="number" id="semester" name="semester" min="1" required>
                </div>

                <div class="form-group">
                    <label for="ukt">Biaya UKT (Rp):</label>
                    <input type="number" id="ukt" name="ukt" min="0" required>
                </div>

                <button type="submit" class="submit-btn">Hitung Diskon</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $npm = $_POST["npm"];
                $nama = $_POST["nama"];
                $prodi = $_POST["prodi"];
                $semester = (int) $_POST["semester"];
                $ukt = (int) $_POST["ukt"];

                // Calculate discount percentage based on rules
                $diskon_persen = 0;
                if ($ukt >= 5000000) {
                    $diskon_persen = 10;

                    // Additional 5% discount for semester > 8
                    if ($semester > 8) {
                        $diskon_persen += 5;
                    }
                }

                // Calculate amount to pay after discount
                $diskon_amount = $ukt * ($diskon_persen / 100);
                $amount_to_pay = $ukt - $diskon_amount;

                // Format numbers with Indonesian format
                $formatted_ukt = 'Rp. ' . number_format($ukt, 0, ',', '.') . ',-';
                $formatted_amount_to_pay = 'Rp. ' . number_format($amount_to_pay, 0, ',', '.') . ',-';

                // Display results
                echo '<div class="result-container">';
                echo '<div class="result-item"><span class="result-label">NPM</span>: ' . $npm . '</div>';
                echo '<div class="result-item"><span class="result-label">NAMA</span>: ' . $nama . '</div>';
                echo '<div class="result-item"><span class="result-label">PRODI</span>: ' . $prodi . '</div>';
                echo '<div class="result-item"><span class="result-label">SEMESTER</span>: ' . $semester . '</div>';
                echo '<div class="result-item"><span class="result-label">BIAYA UKT</span>: ' . $formatted_ukt . '</div>';
                echo '<div class="result-item"><span class="result-label">DISKON</span>: ' . $diskon_persen . '%</div>';
                echo '<div class="result-item"><span class="result-label">YANG HARUS DIBAYAR</span>: ' . $formatted_amount_to_pay . '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="back-link">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Latihan</a>
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