<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    include("connect.php");
    ?>
    <title>
        <?php echo $_GET["kullaniciadi"]; ?> | O Blog
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

        .profile-item {
            color: rgb(235, 234, 234);
            user-select: none;
            background-color: rgba(0, 0, 0, 0.253);
            font-weight: bolder;
            padding: 0.6% 0.6% 0.6% 0.6%;
            cursor: pointer;
            max-width: auto;
            font-size: 2rem;
            overflow: none;
            transition: all 0.5s ease-in-out;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .profile-item:hover {
            transition: all 0.5s ease-in-out;
            background-color: rgba(0, 0, 0, 0.37);
        }

        .profile-item:active {
            transition: all 0.05s ease-in-out;
            background-color: rgba(255, 255, 255, 0.25);
        }

        #profil {
            border-radius: 1rem;
            background-image: linear-gradient(90deg, rgb(223, 0, 0), rgb(162, 0, 255), rgba(196, 253, 253, 0.767));
            margin-bottom: 2%;
            transition: color 0.5s ease-in-out;
            box-shadow: 0.5vw 0.5vh 50rem rgb(122, 86, 86);
        }

        #iletisim {
            padding-left: 1%;
            padding-right: 1%;
            font-size: 1.1rem;
            text-align: justify;
            padding-bottom: 2%;
        }

        #profile-info {
            user-select: none;
            filter: brightness(100%);
            width: 100%;
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
        <div id="profil"
            style="background: linear-gradient(45deg, purple, rgb(128, 0, 167), rgb(149, 0, 194), yellow); color: black;">
            <div class="profile-item">
                <?php
                if (isset($_GET["kullaniciadi"])) {
                    $yazar = mysqli_query($baglanti, "SELECT * FROM author WHERE username='" . $_GET["kullaniciadi"] . "'");
                    if (mysqli_num_rows($yazar) > 0) {
                        while ($yazaroku = mysqli_fetch_assoc($yazar)) {
                            echo $yazaroku["username"];
                        }
                    } else {
                        echo "Yazar bulunamadı.";
                    }
                } else {
                    echo "Yazar bulunamadı.";
                }
                ?>
            </div>
            <div id="iletisim" style="clear:both; padding-top:2%;position:relative; float: left; color: white;">

            </div>
            <div id="profile-info">
                <div style="clear:both; padding-left:1%;padding-top: 1%; color: wheat;"><b>Paylaşım sayısı:</b>
                    <?php
                    if (isset($_GET["kullaniciadi"])) {
                        $yazilar = mysqli_query($baglanti, "SELECT * FROM post INNER JOIN author ON post.authorid=author.id WHERE author.username='" . $_GET["kullaniciadi"] . "'");
                        if (mysqli_num_rows($yazilar) > 0) {
                            echo mysqli_num_rows($yazilar);
                        } else {
                            echo "-";
                        }
                    } else {
                        echo "-";
                    }
                    ?>
                </div>
            </div>
            <div class="context" style="margin-top: 2%;">
                <hr>
                <h1>Yazılar</h1>
                <?php
                if (isset($_GET["kullaniciadi"])) {
                    $yazilar = mysqli_query($baglanti, "SELECT * FROM author INNER JOIN post ON post.authorid=author.id WHERE author.username='" . $_GET["kullaniciadi"] . "'");
                    if (mysqli_num_rows($yazilar) > 0) {
                        echo "<table style='width:100%;'>";
                        echo "<tr><th>Başlık</th><th>Tarihi</th></tr>";
                        while ($yazi = mysqli_fetch_assoc($yazilar)) {
                            echo "<tr style='color:white;'><td><a style='word-break:break-all;' href='yazi.php?id=" . $yazi["id"] . "'>" . $yazi["title"] . "</a></td><td>" . $yazi["date"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Yazılar yüklenemedi.";
                    }
                } else {
                    echo "Yazılar yüklenemedi.";
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($_GET["hesapsil"])) {
            if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
                $kullaniciid = $_SESSION["kullaniciid"];

                if (isset($_GET["hesapsil"])) {
                    $yorumsil = mysqli_query($baglanti, "DELETE FROM comment WHERE authorid='$kullaniciid'");
                    $yazisil = mysqli_query($baglanti, "DELETE FROM post WHERE authorid='$kullaniciid'");
                    $yazarsil = mysqli_query($baglanti, "DELETE FROM author WHERE id='$kullaniciid'");

                    if ($yazisil && $yorumsil && $yazarsil) {
                        header("Location: cikis.php");
                    } else {
                        echo "Hesap silinirken bir hata oluştu.";
                    }
                }
            } else {
                header("Location: profil.php?kullaniciadi=" . $_SESSION["kullaniciadi"]);
            }
        }
        ?>

        <?php
        if (isset($_GET["kullaniciadi"]) && !(isset($_GET["hesapsil"]))) {
            if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
                if ($_SESSION["kullaniciadi"] == $_GET["kullaniciadi"]) {
                    echo "<div style='margin-top: 2%;''><a href='" . $_SERVER['PHP_SELF'] . "?kullaniciadi=" . $_SESSION["kullaniciadi"] . "&hesapsil=1' style='color: red;''>Hesabımı sil</a></div>";
                } else {
                    echo "Mevcut değil.";
                }
            }
        } else {
        }
        ?>
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>