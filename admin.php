<?php

session_start();

$adminUsername = "admin";
$adminPassword = "password123";

// Eğer giriş yapılmışsa, oturum bilgilerini kontrol edin
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Kullanıcı adı ve şifre doğrulama
        if ($username === $adminUsername && $password === $adminPassword) {
            $_SESSION['logged_in'] = true;
            header('Location: admin.php');
            exit;
        } else {
            $error = "Geçersiz kullanıcı adı veya şifre.";
        }
    }
}

// Çıkış yap işlemi
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input, button {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #4cae4c;
        }
        .error {
            color: #842029;
            background: #f8d7da;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            color: #5cb85c;
            text-decoration: none;
        }
    </style>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Ana sayfa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="hakkimda.php">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link" href="iletisim.php">İletişim</a></li>
                   </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if (!$loggedIn): ?>
            <h1>Admin Girişi</h1>
            <?php if (!empty($error)): ?>
                <div class="error"> <?= $error ?> </div>
            <?php endif; ?>
            <form action="" method="POST">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Giriş Yap</button>
            </form>
        <?php else: ?>
            <h1>Admin Paneli</h1>
            <p>Hoş geldiniz, Admin! Burada site içeriklerini yönetebilirsiniz.</p>

            <div class="logout">
                <a href="?logout">Çıkış Yap</a> <br><br>
                <a href="http://localhost/phpmyadmin/">Veri tabanına git</a>
            </div>
        <?php endif; ?>


    </div>
</body>
</html>
