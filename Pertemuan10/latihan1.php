<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Nilai - Pertemuan 10</title>
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
            width: 80px;
        }

        .status-lulus {
            color: #4CAF50;
            font-weight: bold;
        }

        .status-gagal {
            color: #f44336;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Latihan Nilai</h1>
            <p>Pertemuan 10 - Pemrograman Berbasis Web</p>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-graduation-cap"></i> Perhitungan Nilai Mahasiswa</h2>

            <form method="post" action="">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="nilai">Nilai:</label>
                    <input type="number" id="nilai" name="nilai" min="0" max="100" required>
                </div>

                <button type="submit" class="submit-btn">Proses</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = $_POST["nama"];
                $nilai = (int) $_POST["nilai"];

                // Tentukan predikat berdasarkan nilai
                if ($nilai >= 90) {
                    $predikat = "A";
                } elseif ($nilai >= 80) {
                    $predikat = "B";
                } elseif ($nilai >= 70) {
                    $predikat = "C";
                } elseif ($nilai >= 60) {
                    $predikat = "D";
                } else {
                    $predikat = "E";
                }

                // Tentukan status kelulusan
                $status = ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
                $statusClass = ($nilai >= 60) ? "status-lulus" : "status-gagal";

                // Tampilkan hasil
                echo '<div class="result-container">';
                echo '<div class="result-item"><span class="result-label">Nama</span>: ' . $nama . '</div>';
                echo '<div class="result-item"><span class="result-label">Nilai</span>: ' . $nilai . '</div>';
                echo '<div class="result-item"><span class="result-label">Predikat</span>: ' . $predikat . '</div>';
                echo '<div class="result-item"><span class="result-label">Status</span>: <span class="' . $statusClass . '">' . $status . '</span></div>';
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