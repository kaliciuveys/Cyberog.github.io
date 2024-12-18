<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; // XAMPP'de varsayılan kullanıcı adı
$password = ""; // XAMPP'de varsayılan şifre boş
$dbname = "blog_iletisim"; // Veritabanı adı

// MySQL bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// POST işlemini kontrol et
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isim = htmlspecialchars($_POST['isim'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $mesaj = htmlspecialchars($_POST['mesaj'] ?? '');

    // Formun eksiksiz doldurulup doldurulmadığını kontrol et
    if (empty($isim) || empty($email) || empty($mesaj)) {
        $hata = "Lütfen tüm alanları doldurunuz.";
    } else {
        // Veritabanına veri ekleme sorgusu
        $stmt = $conn->prepare("INSERT INTO iletisim (isim, email, mesaj) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $isim, $email, $mesaj);

        if ($stmt->execute()) {
            $basari = "Mesajınız başarıyla kaydedildi. Teşekkür ederiz.";
        } else {
            $hata = "Mesaj kaydedilirken bir hata oluştu: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>İletişim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 90%;
            max-width: 600px;
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
        label {
            font-weight: bold;
        }
        input, textarea {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            font-size: 1rem;
            background:rgb(0, 0, 0);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background:rgb(119, 16, 153);
        }
        .info {
            margin-top: 20px;
            text-align: center;
        }
        .error, .success {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .error {
            background: #f8d7da;
            color: #842029;
        }
        .success {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Cyberog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="hakkimda.php">Hakkımızda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="iletisim.php">İletişim</a>
        </li>
      </ul>

    </div>
  </div>
</nav>

    <div class="container">
        <h1>İletişim</h1>
        <?php if (!empty($hata)): ?>
            <div class="error"><?= $hata ?></div>
        <?php endif; ?>
        <?php if (!empty($basari)): ?>
            <div class="success"><?= $basari ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="isim">İsim</label>
            <input type="text" id="isim" name="isim" required>

            <label for="email">E-posta</label>
            <input type="email" id="email" name="email" required>

            <label for="mesaj">Mesaj</label>
            <textarea id="mesaj" name="mesaj" rows="5" required></textarea>

            <button type="submit">Gönder</button>
        </form>
        <div class="info">
            <p><strong>Telefon:</strong> <a href="tel:05511018443">0551 101 84 43</a></p>
            <p><strong>E-posta:</strong> <a href="mailto:muhammetphlvn@gmail.com">muhammetphlvn@gmail.com</a></p>
        </div>
    </div>
</body>
</html>