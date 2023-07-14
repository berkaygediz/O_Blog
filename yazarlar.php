<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazarlar | O Blog</title>
    <?php include("connect.php"); ?>
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
            session_start();
            include("nav.php");
            ?>
        </div>
    </header>
    <main>
        <?php
        if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
            $yazarlar = mysqli_query($baglanti, "SELECT * FROM author ORDER BY regdate DESC");
            if (mysqli_num_rows($yazarlar) > 0) {
                echo "<h1>Yazarlar</h1>";
                echo "<table style='width:100%;'>";
                echo "<tr> <th style='border: 2px solid black;'>Kullanıcı Adı</th> <th style='border: 2px solid black;'>Paylaşım Sayısı</th> <th style='border: 2px solid black;'>Kayıt Tarihi</th> </tr>";
                while ($yazar = mysqli_fetch_assoc($yazarlar)) {
                    $yaziveri = mysqli_query($baglanti, "SELECT * FROM post WHERE authorid=" . $yazar["id"]);
                    echo "<tr><td style='border: 2px solid aqua;'><a href='profil.php?kullaniciadi=" . $yazar["username"] . "'>" . $yazar["username"] . "</a></td><td style='border: 2px solid aqua;'>" . mysqli_num_rows($yaziveri) . "</td><td style='border: 2px solid aqua;'>" . $yazar["regdate"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Hiç yazar yok.";
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