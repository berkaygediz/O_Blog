<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    include("baglanti.php");
    ?>
    <title>
        <?php
        $yaziverisi = mysqli_query($baglanti, "SELECT * FROM yazi WHERE id = " . $_GET["id"]);
        $yaziverisi = mysqli_fetch_assoc($yaziverisi);
        echo substr($yaziverisi["baslik"], 0, 30) . "...";
        ?> | O Blog
    </title>
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

        #yazi {
            color: black;
            border-radius: 1rem;
            background-color: wheat;
            margin-bottom: 2%;
            padding-top: 1.5%;
            transition: color 0.3s ease-in-out;
            box-shadow: 0.1vw 0.1vh 2rem rgb(122, 86, 86);
            margin-bottom: 7vh;
        }

        #baslik {
            padding-left: 1%;
            font-weight: bolder;
            font-size: 2.5rem;
        }

        #tarih {
            padding-left: 1%;
            font-weight: bold;
            font-size: 1.3rem;
            cursor: pointer;
            margin-bottom: 1%;
            user-select: none;
        }

        #metin {
            padding-left: 1%;
            padding-right: 1%;
            font-size: 1.1rem;
            padding-bottom: 2%;
            word-wrap: break-word;
        }

        #yazidetay {
            user-select: none;
            filter: brightness(100%);
            width: 100%;
        }

        .category-item {
            color: rgb(223, 221, 221);
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            font-weight: bold;
            padding: 0.7% 0.7% 0.7% 0.7%;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.5s ease-in-out;
            width: auto;
        }

        .category-item:hover {
            transition: all 0.5s ease-in-out;
            background-color: rgba(0, 0, 0, 0.37);
        }

        .category-item:active {
            transition: all 0.05s ease-in-out;
            background-color: rgb(143, 4, 4);
        }

        .yorum {
            color: black;
        }

        input[type="text"],
        textarea {
            border: 2px solid wheat;
            border-radius: 0.5rem;
            font-family: Arial, Helvetica, sans-serif;
            width: 20vw;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: all 0.5s ease-in-out;
            color: black;
        }

        .context {
            user-select: none;
            font-size: 3vh;
            text-align: center;
            font-weight: bolder;
            margin-bottom: 2vh;
            overflow: hidden;
        }

        .channel-item {
            user-select: none;
            background-color: rgba(0, 0, 0, 0.253);
            font-weight: bolder;
            margin-left: 0.5%;
            padding: 0.5% 0.5% 0.5% 0.5%;
            border-radius: 1rem;
            cursor: pointer;
            max-width: auto;
            font-size: 1.25rem;
            overflow: none;
            transition: all 0.5s ease-in-out;
            color: black;
        }

        .channel-item:hover {
            transition: all 0.5s ease-in-out;
            background-color: rgba(0, 0, 0, 0.37);
        }

        .channel-item:active {
            transition: all 0.05s ease-in-out;
            background-color: rgb(255, 255, 255);
        }
    </style>
</head>

<body>
    <header>
        <div><a href="index.php" style="text-decoration: none;">
                <img src="img/o_favicon.png" style="float:left;">
                <h1
                    style="text-shadow: 0 0 45px white; font-weight: bold; float:left; background: -webkit-linear-gradient(45deg, red, #ffffff);-webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">
                    Blog</h1>
            </a>
        </div>
        <div style="display: flex; align-items: center; width:50%;">
            <?php

            if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
                echo "<div style='margin-left:10vh;margin-right:2vh;justify-content: space-between;'><a href='index.php' class='nav-eleman-kontrol'>Keşfet</a><a href='yazarlar.php' class='nav-eleman-kontrol'>Yazarlar</a><a href='yazilarim.php' class='nav-eleman-kontrol'>Yazılarım</a> <a href='yorumlarim.php' class='nav-eleman-kontrol'>Yorumlarım</a></div>";
                echo "| <div style='margin-left:2vh;'> Hoşgeldiniz, <a href='profil.php?kullaniciadi=" . $_SESSION["kullaniciadi"] . "'>" . $_SESSION["kullaniciadi"] . "</a><a href='cikis.php' class='nav-eleman-kontrol'>Çıkış</a>";
            } else {
                echo "<div style='margin-left:40vh;margin-right:2vh;justify-content: space-between;'><a href='giris.php' class='nav-eleman-kontrol'>Giriş Yap</a> | <a href='kayit.php' class='nav-eleman-kontrol'>Kayıt Ol</a></div>";
            }
            ?>
        </div>
    </header>
    <main>
        <div id="yazi">
            <div id="baslik">
                <?php
                $yaziverisi = mysqli_query($baglanti, "SELECT * FROM yazi WHERE id = " . $_GET["id"]);
                $yaziverisial = mysqli_fetch_assoc($yaziverisi);
                if (mysqli_num_rows($yaziverisi) > 0) {
                    echo $yaziverisial["baslik"];
                } else {
                    echo "Başlık bulunamadı.";
                }
                ?>
            </div>
            <div id="metin">
                <?php
                if (mysqli_num_rows($yaziverisi) > 0) {
                    echo $yaziverisial["metin"];
                } else {
                    echo "Yazı bulunamadı.";
                }
                ?>
            </div>
            <div id="yazidetay">
                <div style="font-weight:bolder; font-size: 1.15rem;">👤Yazar:</div>
                <?php
                $yaziyazar = mysqli_query($baglanti, "SELECT * FROM yazi INNER JOIN yazar ON yazi.yazarid = yazar.id WHERE yazi.id = " . $_GET["id"]);
                $yaziyazarverisi = mysqli_fetch_assoc($yaziyazar);
                if (mysqli_num_rows($yaziyazar) > 0) {
                    echo "<a href='profil.php?kullaniciadi=" . $yaziyazarverisi["kullaniciadi"] . "'><div class='channel-item'>" . $yaziyazarverisi["kullaniciadi"] . "</div></a>";
                } else {
                    echo "<div class='channel-item'>Yazar yüklenemedi.</div>";
                }
                ?>
                <div style="clear:both; padding-top: 1%;"></div>
                <div style="font-weight:bolder; font-size: 1.15rem;">🔍Kategori:</div>
                <?php
                $yazikategori = mysqli_query($baglanti, "SELECT * FROM yazi INNER JOIN kategori ON yazi.kategoriid = kategori.id WHERE yazi.id = " . $_GET["id"]);
                $kategoriverisi = mysqli_fetch_assoc($yazikategori);

                if (mysqli_num_rows($yazikategori) > 0) {
                    echo "<div class='category-item'>" . $kategoriverisi["kategori"] . "</div></a>";
                } else {
                    echo "<div class='category-item'>Kategori yüklenemedi.</div>";
                }
                ?>
                <div style="clear:both; padding-top: 1%;"></div>
                <div style="font-weight:bolder; font-size: 1.15rem;">📅Yayınlanma Tarihi:</div>
                <div class="tarih">
                    <?php
                    if (mysqli_num_rows($yaziverisi) > 0) {
                        echo $yaziverisial["tarih"];
                    } else {
                        echo "Tarih yüklenemedi.";
                    }
                    ?>
                </div>
            </div>
            <?php
            if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {

                $yorumlar = mysqli_query($baglanti, "SELECT * FROM yorum INNER JOIN yazar ON yorum.yazarid = yazar.id WHERE yorum.yaziid = " . $_GET["id"] . " ORDER BY yorum.id DESC");
                $yorumlariverisi = mysqli_fetch_assoc($yorumlar);

                if (mysqli_num_rows($yorumlar)) {
                    echo "<div class='context' style='margin-top: 2%;'>Yorumlar (" . mysqli_num_rows($yorumlar) . ") </div>";
                    do {
                        echo "<div class='yorum'><div class='yorumyazan'><a href='profil.php?kullaniciadi=" . $yorumlariverisi["kullaniciadi"] . "'>" . $yorumlariverisi["kullaniciadi"] . "</a></div><div style='word-wrap: break-word;'>" . $yorumlariverisi["metin"] . "</div></div>" . $yorumlariverisi["tarih"] . "<hr>";
                    } while ($yorumlariverisi = mysqli_fetch_assoc($yorumlar));
                } else {
                    echo "<div class='context' style='margin-top: 2%;'>Yorumlar</div>";
                    echo "<div style='margin-top: 2vh; margin-bottom: 2vh;'>Bu yazıya henüz yorum yapılmamış.</div>";
                }
                if (mysqli_num_rows($yaziverisi) > 0) {
                    echo "<b>" . $_SESSION["kullaniciadi"] . ":</b>";
                    echo "<form action='yorumyaz.php' method='POST'>
                    <input type='hidden' name='yaziid' value='" . $_GET["id"] . "'>
                    <textarea name='yorum' maxlength='150' style='width: 19vw; height: 12vh;'></textarea><br>
                    <input type='submit' value='Yorumu Gönder' style='margin-top: 2vh; margin-bottom: 2vh;cursor:pointer;' id='olustur'>";
                } else {
                    echo "<b style='color:red;'>HATA:</b>Yorumlar yüklenemedi.";
                }
            } else {
                echo "<div style='padding-top: 4vh; padding-bottom: 4vh;'>Yorum yazmak için <a href='giris.php' style='color:black;'>giriş yapın</a> veya <a href='kayit.php' style='color:black;'>kayıt olun</a>.</div>";
            }
            ?>
            <div style="clear: both;">
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>