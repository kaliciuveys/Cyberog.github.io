<?php
include 'ayar.php';
session_start(); 

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function permalink($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if ($csrf_token !== $_SESSION['csrf_token']) {
        die('<p class="alert alert-danger">Geçersiz CSRF token!</p>');
    }

    $baslik = htmlspecialchars(trim($_POST["baslik"] ?? ''));
    $aciklama = htmlspecialchars(trim($_POST["aciklama"] ?? ''));
    $link = permalink($baslik);

    if (empty($baslik) || empty($aciklama)) {
        echo '<p class="alert alert-warning">Lütfen boş bırakmayın</p>';
    } else {
        try {
            $veriekle = $db->prepare("INSERT INTO yazilar (yazi_baslik, yazi_aciklama, yazi_link) VALUES (?, ?, ?)");
            $veriekle->execute([$baslik, $aciklama, $link]);

            echo '<p class="alert alert-success">Başarıyla eklendi</p>';
            header("REFRESH:2;URL=index.php");
            exit;
        } catch (PDOException $e) {
            echo '<p class="alert alert-danger">Hata: ' . $e->getMessage() . '</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            
        }
        footer {
            background: #343a40;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            height: 35px;
        }
        .blog-list {
            margin-top: 2rem;
        }
        .blog-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            font-family: 'Poppins', sans-serif;
        }
        .blog-item h3 {
            margin-bottom: 10px;
        }
        .blog-item p {
            color: #6c757d;
        }
       
        .carousel-inner{
            margin-left:500px;
            margin-right:50px; 
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

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div  class="carousel-inner" >
    <div class="carousel-item active">
      <img class="d-block w-50" src="getir.jpg" alt="getir">
    </div>
    <div class="carousel-item">
      <img class="d-block w-50" src="ups.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-50" src="faber.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="false"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="false"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container my-5">
    <h2 class="text-center mb-4">Yeni Yazı Ekle</h2>
    <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="mb-3">
            <label for="baslik" class="form-label"><strong>Başlık</strong></label>
            <input type="text" name="baslik" id="baslik" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="aciklama" class="form-label"><strong>Açıklama/Yazı</strong></label>
            <textarea name="aciklama" id="aciklama" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Yayınla/Paylaş</button>
    </form>
</div>

<div class="container blog-list">
    <h2 class="text-center mb-4">Blog Yazıları</h2>
    <?php
    $dataList = $db->prepare("SELECT * FROM yazilar ORDER BY yazi_id DESC");
    $dataList->execute();
    $dataList = $dataList->fetchAll(PDO::FETCH_ASSOC);

    if ($dataList) {
        foreach ($dataList as $row) {
            echo '<div class="blog-item">
             <p>' . htmlspecialchars($row["yazi_baslik"]) . '</p>
                    <p>' . htmlspecialchars($row["yazi_aciklama"]) . '</p>
                    <small class="text-muted">' . htmlspecialchars($row["yazi_tarih"]) . '</small>
                  </div>';
        }
    } else {
        echo '<p class="text-center">Henüz yazı eklenmedi.</p>';
    }
    ?>
</div>

<footer>
    <p>&copy; 2024 Blogum. Tüm Hakları Saklıdır.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
