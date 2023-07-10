<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keşfet | O Blog</title>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
    <?php
    session_start();
    include("baglanti.php");
    ?>
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
            z-index: 999;
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
            z-index: 998;
            width: 90vh;
            margin-top: 12.5vh;
            justify-content: center;
            align-items: center;
            background-color: #49a09d;
            text-align: left;
            margin-bottom: 5vh;
        }

        footer {
            z-index: 997;
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
            display: flex;
            z-index: -1;
            padding: 1vh 2vh 1vh 2vh;
            border: 1px solid white;
            border-radius: 3em;
            background: linear-gradient(90deg, white, wheat, red);
            color: black;
            opacity: 0.8;
            font-size: 1rem;
            transition: all 0.5s ease-in-out;
        }

        #olustur:hover {
            transform: scale(1.05);
            transition: all 0.5s ease-in-out;
            border: 1px dashed red;
            box-shadow: 0 0 30px white;
        }

        #yazi {
            color: black;
            border-radius: 1rem;
            background-color: orangered;
            margin-bottom: 2%;
            padding-top: 1.5%;
            transition: color 0.3s ease-in-out;
            box-shadow: 0.1vw 0.1vh 2rem rgb(122, 86, 86);
            margin-bottom: 7vh;
        }

        #baslik {
            padding-left: 1%;
            color: black;
            font-weight: bolder;
            font-size: 2.5rem;
        }

        #metin {
            padding-left: 1%;
            padding-right: 1%;
            font-size: 1.1rem;
            padding-bottom: 2%;
            word-wrap: break-word;
        }

        h1 {
            background: -webkit-linear-gradient(45deg, goldenrod, #ffffff);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
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
            if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
                echo "<div style='margin-left:10vh;margin-right:2vh;justify-content: space-between;'><a href='index.php' class='nav-eleman-kontrol'>Keşfet</a><a href='yazarlar.php' class='nav-eleman-kontrol'>Yazarlar</a><a href='yazilarim.php' class='nav-eleman-kontrol'>Yazılarım</a> <a href='yorumlarim.php' class='nav-eleman-kontrol'>Yorumlarım</a></div>";
                echo "| <div style='margin-left:2vh;'> Hoşgeldiniz, <a href='profil.php?kullaniciadi=" . $_SESSION["kullaniciadi"] . "'>" . $_SESSION["kullaniciadi"] . "</a><a href='cikis.php' class='nav-eleman-kontrol'>Çıkış</a>";
            } else {
                echo "<div style='margin-left:45vh;margin-right:2vh;justify-content: space-between;'><a href='giris.php' class='nav-eleman-kontrol'>Giriş Yap</a> | <a href='kayit.php' class='nav-eleman-kontrol'>Kayıt Ol</a></div>";
            }
            ?>
        </div>
    </header>
    <main>
        <?php
        if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
            $yazilar = mysqli_query($baglanti, "SELECT * FROM yazi ORDER BY tarih DESC");
            $yazarlar = mysqli_query($baglanti, "SELECT * FROM yazi INNER JOIN yazar ON yazi.yazarid = yazar.id ORDER BY tarih DESC");

            if (mysqli_num_rows($yazilar) > 0) {
                echo "<a href='olustur.php' id='olustur' style=''>Oluştur!</a><br><br>";
                while ($yazi = mysqli_fetch_assoc($yazilar)) {
                    $yazar = mysqli_fetch_assoc($yazarlar);
                    $yorumlar = mysqli_query($baglanti, "SELECT * FROM yazi INNER JOIN yorum ON yazi.id = yorum.yaziid WHERE yazi.id = " . $yazi["id"] . " ORDER BY yazi.tarih DESC");
                    echo "<div id='yazi'>";
                    echo "<div id='baslik'><a href='yazi.php?id=" . $yazi["id"] . "'>" . substr($yazi["baslik"], 0, 60) . "...</a></div>";
                    echo "<div id='metin'>" . substr($yazi["metin"], 0, 250) . "...</div>";
                    echo "<div style='padding-left:1%;padding-bottom:1%;'><b>Yazar:</b> <a href='profil.php?kullaniciadi=" . $yazar["kullaniciadi"] . "'>" . $yazar["kullaniciadi"] . "</a></div>";
                    echo "<div style='padding-left:1%;padding-bottom:1%;'><b>Tarih:</b> " . $yazi["tarih"] . "<br>";
                    if ($yazi["tarih"] > date("Y-m-d")) {
                        echo "<b style='color:lime;'>(Güncel)</b>";
                    }
                    echo "</div><div style='padding-left:1%;padding-bottom:1%;'><b>Yorumlar:</b> " . mysqli_num_rows($yorumlar) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<a href='olustur.php' id='olustur' style=''>Oluştur!</a><br><br>";
                echo "Henüz hiç yazı yok.";
            }
        } else {
            echo "<div style='background-color:#3F3F3F; opacity:0.93; box-shadow:0 0 25px black; padding: 2% 3% 2% 3%; border-radius: 2rem;'><h1>Hoşgeldiniz!</h1><br>";
            echo "<p>O Blog'a hoş geldiniz. Burada dilediğiniz gibi yazılar oluşturabilir, yorum yapabilir ve diğer kullanıcıların yazılarını okuyabilirsiniz.</p></div>";
        }
        ?>
    </main>
    <footer>
        <p style="color: white; font-weight: bold;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>