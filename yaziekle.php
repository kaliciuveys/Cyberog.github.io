<?php
include 'ayar.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Blog</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .post {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            transition: transform 0.2s ease;
        }

        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #343a40;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="yaziekle.php">Yazı ekle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hakkimda.php">Hakkımızda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim.php">İletişim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="yaziekle.php">yazı ekle</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   

    <div class="container my-5">
        <h2 class="text-center mb-4">Son Yazılar</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="post">
                    <h5>İlk Blog Yazım</h5>
                    <p>Bu, ilk blog yazımın içeriği. İlginç bilgiler burada.</p>
                </div>
            </div>

            <?php 
if ($_POST) {
    $baslik = htmlspecialchars($_POST["baslik"]);
    $aciklama = htmlspecialchars($_POST["aciklama"]);
    $link = permalink($baslik);

    if (empty($baslik) || empty($aciklama)) {
        echo '<p class="alert alert-warning">Lütfen boş bırakmayın</p>';
    } else {
        $veriekle = $db->prepare("INSERT INTO yazilar (yazi_baslik, yazi_aciklama, yazi_link) VALUES (?, ?, ?)");
        $veriekle->execute([
            $baslik,
            $aciklama,
            $link
        ]);

        if ($veriekle) {
            echo '<p class="alert alert-success">Başarıyla eklendi</p>';
            header("REFRESH:2;URL=yaziekle.php");
            exit;
        } else {
            echo '<p class="alert alert-danger">Başarısız ekleme</p>';
            header("REFRESH:2;URL=yaziekle.php");
            exit;
        }
    }
}

function permalink($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}
?>


     <form action="" method="post">
<strong>Başlık</strong>
<input type="text" name="baslik" id="" class="form-control">
<strong>Açıklama/yazı:</strong>
 <textarea name="aciklama" id="" class="form-control"></textarea>
 <br> 
 <input type="submit" value="yayınla/paylaş" class="btn btn-dark">
     </form>
    <footer>
        <p>&copy; 2024 Blogum. Tüm Hakları Saklıdır.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
	
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
