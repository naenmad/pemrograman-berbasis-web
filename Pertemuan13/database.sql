-- Membuat database
CREATE DATABASE IF NOT EXISTS pemrograman_web_contoh;
USE pemrograman_web_contoh;

-- Tabel Buku
CREATE TABLE IF NOT EXISTS Buku (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(255) NOT NULL,
    Penulis VARCHAR(255) NOT NULL,
    Tahun_Terbit INT NOT NULL,
    Harga DECIMAL(10,2) NOT NULL,
    stok INT DEFAULT 0
);

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS Pelanggan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nama VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE,
    Alamat TEXT,
    Telepon VARCHAR(20)
);

-- Tabel Pesanan
CREATE TABLE IF NOT EXISTS Pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Tanggal_Pesanan DATE NOT NULL,
    Pelanggan_ID INT NOT NULL,
    Total_Harga DECIMAL(10,2) DEFAULT 0,
    FOREIGN KEY (Pelanggan_ID) REFERENCES Pelanggan(ID) ON DELETE CASCADE
);

-- Tabel Detail Pesanan
CREATE TABLE IF NOT EXISTS Detail_Pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pesanan_ID INT NOT NULL,
    Buku_ID INT NOT NULL,
    Kuantitas INT NOT NULL,
    Harga_Per_Satuan DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (Pesanan_ID) REFERENCES Pesanan(ID) ON DELETE CASCADE,
    FOREIGN KEY (Buku_ID) REFERENCES Buku(ID) ON DELETE CASCADE
);

-- Insert data contoh untuk tabel Buku
INSERT INTO Buku (Judul, Penulis, Tahun_Terbit, Harga, stok) VALUES
('Laskar Pelangi', 'Andrea Hirata', 2005, 75000, 25),
('Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 2004, 65000, 18),
('Negeri 5 Menara', 'Ahmad Fuadi', 2009, 70000, 22),
('Dilan 1990', 'Pidi Baiq', 2014, 55000, 30),
('Sang Pemimpi', 'Andrea Hirata', 2006, 68000, 20),
('Ronggeng Dukuh Paruk', 'Ahmad Tohari', 1982, 72000, 15),
('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 80000, 12),
('Cantik Itu Luka', 'Eka Kurniawan', 2002, 85000, 10),
('Perahu Kertas', 'Dee Lestari', 2009, 62000, 28),
('Hujan Bulan Juni', 'Sapardi Djoko Damono', 1994, 58000, 35);

-- Insert data contoh untuk tabel Pelanggan
INSERT INTO Pelanggan (Nama, Email, Alamat, Telepon) VALUES
('Ahmad Zulkarnaen', 'ahmad@email.com', 'Jl. Raya No. 123, Jakarta', '081234567890'),
('Siti Nurhaliza', 'siti@email.com', 'Jl. Merdeka No. 45, Bandung', '081234567891'),
('Budi Santoso', 'budi@email.com', 'Jl. Sudirman No. 67, Surabaya', '081234567892'),
('Dewi Sartika', 'dewi@email.com', 'Jl. Diponegoro No. 89, Yogyakarta', '081234567893'),
('Rina Kusuma', 'rina@email.com', 'Jl. Gajah Mada No. 12, Semarang', '081234567894');

-- Insert data contoh pesanan
INSERT INTO Pesanan (Tanggal_Pesanan, Pelanggan_ID, Total_Harga) VALUES
('2024-01-15', 1, 140000),
('2024-01-16', 2, 195000),
('2024-01-17', 3, 110000);

-- Insert data contoh detail pesanan
INSERT INTO Detail_Pesanan (Pesanan_ID, Buku_ID, Kuantitas, Harga_Per_Satuan) VALUES
(1, 1, 1, 75000),
(1, 2, 1, 65000),
(2, 3, 1, 70000),
(2, 4, 2, 55000),
(2, 5, 1, 68000),
(3, 6, 1, 72000),
(3, 9, 1, 62000);