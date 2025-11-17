<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #b2f7ef, #cffffe);
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* BAGIAN NAMA USER DI ATAS */
        .header {
            margin-top: 50px;   /* JARAK DARI ATAS, BIKIN MIRIP GAMBAR */
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #1e7f8c;     /* warna sama kayak Polgan Mart */
        }

        .subrole {
            margin-top: 5px;
            font-size: 16px;
            color: #2f5f63;
            font-weight: normal;
        }

        .card {
            background: #ffffffdd;
            padding: 20px 30px;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.15);
            text-align: center;
        }

        .btn-logout {
            padding: 10px 25px;
            background: #ff6b6b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #e85a5a;
        }
    </style>

</head>
<body>

    <!-- NAMA USER POSISI ATAS, TENGAH -->
    <div class="header">
        Selamat datang, <?= $_SESSION['username']; ?>!
        <div class="subrole">Role: Mahasiswa</div> <!-- opsional, bisa hapus -->
    </div>

    <!-- CARD LOGOUT -->
    <div class="card">
        <a href="logout.php">
            <button class="btn-logout">Logout</button>
        </a>
    </div>

</body>
</html>
