<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazılarım | O Blog</title>
    <?php
    session_start();
    include("connect.php");
    ?>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
    <style>
        body {
            padding: 0;
            margin: 0;
            background-color: #49a09d;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 10vh;
            background: linear-gradient(360deg, #49a09d, red);
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
            max-height: auto;
            max-width: auto;
            transition: all 1s ease-in-out;
            position: fixed;
        }

        header img {
            height: 8vh;
            max-height: auto;
            max-width: auto;
        }

        main {
            width: 90vh;
            margin-top: 12.5vh;
            justify-content: center;
            align-items: center;
            background-color: #49a09d;
            text-align: center;
        }

        footer {
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
            transition: all 1s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 5vh;
            background: linear-gradient(180deg, #49a09d, #1B9C85);
            background-color: #1B9C85;
            position: fixed;
            bottom: 0;
        }

        footer p {
            font-size: 1rem;
            color: white;
        }

        a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .nav-eleman-kontrol {
            margin-left: 3vh;
            margin-right: 3vh;
        }

        .nav-eleman-kontrol:hover {
            text-shadow: 0 0 20px white;
            transition: all 0.2s ease-in-out;
        }

        #olustur {
            padding: 1vh 2vh 1vh 2vh;
            border: 1px dashed white;
            border-radius: 3em;
            background: linear-gradient(90deg, #49a09d, red, #49a09d);
            font-size: 1rem;
            transition: all 0.5s ease-in-out;
        }

        #olustur:hover {
            transform: scale(1.125);
            transition: all 0.5s ease-in-out;
            border: 1px dashed red;
            box-shadow: 0 0 30px white;
        }
    </style>
</head>

<body>
    <header>
        <div><a href="index.php" style="text-decoration: none;">
                <img src="img/o_favicon.png" style="float:left;">
                <h1
                    style="text-shadow: 0 0 45px white; font-weight: bold; float:left; background: -webkit-linear-gradient(45deg, red, #ffffff);-webkit-background-clip: text; background-clip:text; -webkit-text-fill-color: transparent;">
                    Blog</h1>
            </a>
        </div>
        <div style="display: flex; align-items: center; width:50%;">
            <?php
            include("nav.php");
            ?>
        </div>
    </header>
    <main>
        <?php
        if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
            $yazilar = mysqli_query($baglanti, "SELECT * FROM post WHERE authorid='" . $_SESSION["kullaniciid"] . "' ORDER BY date DESC");
            if (mysqli_num_rows($yazilar) > 0) {
                echo "<h1>Yazılarım</h1>";
                echo "<table style='width:100%;'>";
                echo "<tr><th style='border:2px solid black;'>Başlık</th><th style='border:2px solid black;'>Tarih</th><th style='border:2px solid black;'>İşlemler</th></tr>";
                while ($yazi = mysqli_fetch_assoc($yazilar)) {
                    echo "<tr><td style='border: 2px solid aqua;'><a href='yazi.php?id=" . $yazi["id"] . "'>" . substr($yazi["title"], 0, 50) . "</a></td><td style='border: 2px solid aqua;'>" . $yazi["date"] . "</td><td style='border: 2px solid aqua;'><a href='yaziduzenle.php?yaziid=" . $yazi["id"] . "'>Düzenle</a> | <a href='yazisil.php?yaziid=" . $yazi["id"] . "'>Sil</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "<a href='olustur.php' id='olustur' style=''>Oluştur!</a><br><br>";
                echo "Henüz hiç yazı oluşturulmamış.";
            }
        } else {
            echo "Bu sayfayı görüntülemek için giriş yapmalısınız.<br><br>";
        }
        ?>
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>