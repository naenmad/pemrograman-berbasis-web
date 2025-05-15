<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Praktikum PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        nav {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #e0e0e0;
            border-radius: 3px;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Latihan Praktikum PHP</h1>

    <nav>
        <a href="?page=kendaraan">Jenis Kendaraan</a>
        <a href="?page=bilangan_genap">Bilangan Genap</a>
        <a href="?page=daftar_hewan">Daftar Hewan</a>
        <a href="?page=genap_ganjil">Genap Ganjil</a>
    </nav>

    <div class="content">
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
                echo "<h2>Selamat Datang</h2>";
                echo "<p>Silakan pilih menu navigasi di atas untuk melihat hasil latihan praktikum.</p>";
        }
        ?>
    </div>
</body>

</html>