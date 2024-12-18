<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hakkımızda</title>

    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #333;
        }
       
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 80px auto;
            background: #ffffff;
            padding: 40px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.6em;
            margin-bottom: 25px;
        }
        p {
            line-height: 1.8;
            font-size: 1.2em;
            color: #555;
            margin-bottom: 20px;
        }
        .team {
            margin-top: 50px;
        }
        .team h2 {
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 25px;
            text-align: center;
        }
        .team-member {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .team-member:last-child {
            border-bottom: none;
        }
        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
            border: 3px solid #1abc9c;
        }
        .team-member div {
            flex-grow: 1;
        }
        .team-member h3 {
            font-size: 1.6em;
            color: #2c3e50;
            margin: 0;
        }
        .team-member p {
            font-size: 1.1em;
            margin: 8px 0 0;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 1em;
            color: #888;
            padding: 20px 0;
            background-color: #2c3e50;
            color: #fff;
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
        <h1>Hakkımızda</h1>
        <p>Merhaba! Biz Muhammet ve Uras. Siber güvenlik alanında hem öğrenmek isteyenlere bilgi sağlamak hem de bu alanda bir topluluk oluşturmak amacıyla bu blogu kurduk. 
        Amacımız, karmaşık görülen bu dünyayı daha anlaşılır hale getirmek ve hem teknik hem de pratik bilgilerle ziyaretçilerimize katkıda bulunmaktır.</p>

        <p>Siber güvenlik sadece bir meslek değil, aynı zamanda bir tutku. Bu yüzden sizlerle tecrübelerimizi, öğrendiklerimizi ve en güncel bilgileri paylaşarak herkesin bu alanda gelişmesine yardımcı olmak istiyoruz. 
        İster başlangıç seviyesinde olun, ister ileri düzey bir profesyonel, blogumuzda herkes için bir şeyler bulabilirsiniz.</p>

        <div class="team">
            <h2>Ekibimiz</h2>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Muhammet">
                <div>
                    <h3>Muhammet</h3>
                    <p>Yeni teknolojilere olan merakı ve sistem güvenliği konusundaki uzmanlaşma hedefiyle blogun teknik içerik sağlayıcısı.</p>
                </div>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Uras">
                <div>
                    <h3>Uras</h3>
                    <p>Analitik düşünme becerisi ve sosyal ağ oluşturma tutkusuyla blogun iletişim ve topluluk yöneticisi.</p>
                </div>
            </div>
        </div>

        <p>Eğer siber güvenlik hakkında sorularınız varsa ya da topluluğumuzun bir parçası olmak istiyorsanız, bizimle iletişime geçebilirsiniz. Birlikte öğrenmek ve büyümek dileğiyle!</p>
        
        <div class="footer">
            &copy; 2024 Muhammet & Uras - Tüm Hakları Saklıdır.
        </div>
    </div>
</body>
</html>
