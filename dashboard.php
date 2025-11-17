<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #b2f7ef, #cffffe);
            margin: 0;
        }

        /* HEADER ATAS */
        .topbar {
            width: 100%;
            background: #ffffffdd;
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* LOGO DAN POLGAN MART SEBELAH KIRI */
        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-area img {
            width: 45px;
            height: 45px;
        }

        .polgan-text {
            font-size: 24px;
            font-weight: bold;
            color: #1e7f8c;
        }

        /* WELCOME TEXT SEBELAH KANAN */
        .right-area {
            text-align: right;
            padding-right: 60px; /* ✔️ GESER KE KIRI BIAR GAK MELETET KE UJUNG */
        }

        .welcome-text {
            font-size: 20px;
            font-weight: bold;
            color: #1e7f8c;
        }

        .role-text {
            font-size: 15px;
            color: #2f5f63;
            margin-bottom: 5px;
        }

        .btn-logout {
            padding: 8px 20px;
            background: #ff6b6b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        /* TABEL PRODUK */
        .table-container {
            margin: 40px auto;
            width: 80%;
            background: #ffffffdd;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            color: #2f5f63;
        }

        th {
            background: #4ecdc4;
            color: white;
            padding: 12px;
            border-radius: 6px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f3ffff;
        }
    </style>

</head>
<body>

    <!-- HEADER -->
    <div class="topbar">

        <!-- KIRI -->
        <div class="logo-area">
            <img src="img/logomart.jfif" alt="logo">
            <div class="polgan-text">POLGAN MART</div>
        </div>

        <!-- KANAN -->
        <div class="right-area">
            <div class="welcome-text">Selamat Datang, <?= $_SESSION['username']; ?>!</div>
            <div class="role-text">Role: Mahasiswa</div>
            <button class="btn-logout" onclick="location.href='logout.php'">Logout</button>
        </div>

    </div>

    <!-- TABEL PRODUK -->
    <div class="table-container">
        <table>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
            </tr>

            <?php
            $kode_barang  = ["B001", "B002", "B003", "B004", "B005"];
            $nama_barang  = ["Sabun", "Shampoo", "Susu", "Teh Kotak", "Kopi"];
            $harga_barang = [3000, 5000, 12000, 4000, 3000];

            for ($i = 0; $i < 5; $i++) {
                echo "<tr>";
                echo "<td>{$kode_barang[$i]}</td>";
                echo "<td>{$nama_barang[$i]}</td>";
                echo "<td>Rp " . number_format($harga_barang[$i], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
