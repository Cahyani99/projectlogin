<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// ========================
// ARRAY DATA BARANG
// ========================
$barang_list = [
    "BRG001" => ["nama" => "Jas Hujan", "harga" => 50000],
    "BRG002" => ["nama" => "Sikat Gigi", "harga" => 3000],
    "BRG003" => ["nama" => "Pasta Gigi", "harga" => 7000],
    "BRG004" => ["nama" => "Sabun Detol", "harga" => 12000],
    "BRG005" => ["nama" => "Kaos Kaki", "harga" => 25000]
];

// SESSION CART
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tambah barang
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = intval($_POST['harga']);
    $jumlah = intval($_POST['jumlah']);

    if ($kode != "" && $nama != "" && $harga > 0 && $jumlah > 0) {
        $_SESSION['cart'][] = [
            'kode' => $kode,
            'nama' => $nama,
            'harga' => $harga,
            'jumlah' => $jumlah
        ];
    }
}

// Kosongkan keranjang
if (isset($_POST['kosongkan'])) {
    $_SESSION['cart'] = [];
}

function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
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

        .topbar {
            width: 100%;
            background: #ffffffdd;
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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

        .right-area {
            text-align: right;
            padding-right: 60px;
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

        /* FORM */
        .form-container {
            width: 80%;
            margin: 40px auto;
            background: #ffffffdd;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.15);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px 18px;
            margin-top: 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-blue {
            background: #0d6efd;
            color: white;
        }

        .btn-gray {
            background: #ccc;
        }

        /* TABEL */
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
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f3ffff;
        }

        /* BOX TOTAL BELANJA */
        .summary-box {
            width: 80%;
            margin: 25px auto 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            font-weight: bold;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 14px 25px;
            font-size: 20px;
        }

        .sum-belanja {
            background: #4ecdc4;
            color: white;
        }

        .sum-diskon {
            background: #ffda7e;
            color: #444;
        }

        .sum-total {
            background: #4ecdc4;
            color: white;
        }

    </style>
</head>
<body>

    <div class="topbar">
        <div class="logo-area">
            <img src="img/logomart.jfif" alt="logo">
            <div class="polgan-text">POLGAN MART</div>
        </div>

        <div class="right-area">
            <div class="welcome-text">Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</div>
            <div class="role-text">Role: Mahasiswa</div>
            <button class="btn-logout" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

    <!-- FORM INPUT BARANG -->
    <div class="form-container">
        <h2 style="text-align:center;margin-bottom:20px;">Input Barang</h2>

        <form method="POST">

            <label>Kode Barang</label>
            <select name="kode" id="kode" required>
                <option value="">-- Pilih Barang --</option>

                <?php foreach ($barang_list as $kode => $b): ?>
                    <option value="<?= $kode ?>"
                        data-nama="<?= $b['nama'] ?>"
                        data-harga="<?= $b['harga'] ?>">
                        <?= $kode ?> - <?= $b['nama'] ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <label>Nama Barang</label>
            <input type="text" id="nama" name="nama" readonly required>

            <label>Harga</label>
            <input type="number" id="harga" name="harga" readonly required>

            <label>Jumlah</label>
            <input type="number" name="jumlah" required>

            <button class="btn btn-blue" name="tambah">Tambahkan</button>
            <button class="btn btn-gray" type="reset">Batal</button>
        </form>
    </div>

    <!-- SCRIPT AUTO-FILL -->
    <script>
    document.getElementById('kode').addEventListener('change', function() {
        let opt = this.options[this.selectedIndex];

        document.getElementById('nama').value = opt.getAttribute('data-nama') || "";
        document.getElementById('harga').value = opt.getAttribute('data-harga') || "";
    });
    </script>

    <!-- TABEL BELANJA -->
    <div class="table-container">
        <h2 style="text-align: center; margin-bottom: 20px;">Daftar Pembelian</h2>

        <table>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>

            <?php
            $grandtotal = 0;

            foreach ($_SESSION['cart'] as $item) {
                $total = $item['harga'] * $item['jumlah'];
                $grandtotal += $total;

                echo "<tr>";
                echo "<td>{$item['kode']}</td>";
                echo "<td>{$item['nama']}</td>";
                echo "<td>". rupiah($item['harga']) ."</td>";
                echo "<td>{$item['jumlah']}</td>";
                echo "<td>". rupiah($total) ."</td>";
                echo "</tr>";
            }

            if ($grandtotal < 50000) { $p = 5; }
            elseif ($grandtotal <= 100000) { $p = 10; }
            else { $p = 15; }

            $diskon = ($p/100) * $grandtotal;
            $total_bayar = $grandtotal - $diskon;
            ?>
        </table>

        <!-- SUMMARY / RINGKASAN -->
        <div class="summary-box">
            <div class="summary-row sum-belanja">
                <div>Total Belanja</div>
                <div><?= rupiah($grandtotal) ?></div>
            </div>

            <div class="summary-row sum-diskon">
                <div>Diskon</div>
                <div>- <?= rupiah($diskon) ?> (<?= $p ?>%)</div>
            </div>

            <div class="summary-row sum-total">
                <div>Total Bayar</div>
                <div><?= rupiah($total_bayar) ?></div>
            </div>
        </div>

        <form method="POST">
            <button class="btn btn-gray" name="kosongkan" style="margin-top:20px;">Kosongkan Keranjang</button>
        </form>

    </div>

</body>
</html>
