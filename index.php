<?php
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = "admin";
    $pass = "1234";

    if ($username == $user && $password == $pass) {

        $_SESSION['username'] = $username;
        header("Location: dashboard2.php");
        exit();

    } else {
        $error = "Username atau Password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #b2f7ef, #cffffe); /* AQUA pastel */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 330px;
            background: #ffffffdd;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.15);
            animation: fadeIn 0.6s ease;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #1e7f8c;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        label {
            font-weight: bold;
            color: #2f5f63;
            float: left;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #9de6df;
            border-radius: 8px;
            font-size: 14px;
            background: #f4ffff;
        }

        input:focus {
            outline: none;
            border-color: #55c8c4;
            box-shadow: 0 0 6px #c3fffa;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #4ecdc4;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-bottom: 10px;
        }

        .btn-login:hover {
            background: #3bb8b0;
        }

        .btn-cancel {
            width: 100%;
            padding: 10px;
            background:  #b5b5b5;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background:  #9e9e9e;
        }

        .footer {
            margin-top: 15px;
            font-size: 13px;
            color: #2f5f63;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body>

    <div class="card">
        <h2>Polgan Mart</h2>

        <?php if (!empty($error)) { ?>
    <p style="color: red; text-align:center; font-weight:bold;">
        <?= $error ?>
    </p>
<?php } ?>


        <form action="index.php" method="post">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn-login" name="login">Login</button>
            <button type="reset" class="btn-cancel">Batal</button>
        </form>

        <div class="footer">
            ©2025 Polgan Mart
        </div>
    </div>

</body>
</html>
