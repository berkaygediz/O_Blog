<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap | O Blog</title>
    <?php
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
            transition: all 1s ease-in-out;
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
        }

        header img {
            height: 8vh;
            max-height: auto;
            max-width: auto;
        }

        main {
            margin-top: 7vh;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color: #49a09d;
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 0 1vh 0 1vh;
            margin-bottom: 1.5vh;
            font-size: 1.2rem;
            border-radius: 5px;
            border: 2px solid wheat;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        input[type="submit"] {
            margin-top: 3vh;
            margin-bottom: 4vh;
            background-color: #1B9C85;
            color: white;
            padding: 10px 20px 10px 20px;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #4C4C6D;
        }

        label {
            text-shadow: 2px 2px #000000;
            color: white;
            font-weight: bold;
        }

        h1 {
            background: -webkit-linear-gradient(45deg, red, #ffffff);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    <header>
        <a href="index.php" style="text-decoration: none;">
            <img src="img/o_favicon.png" style="float:left;">
            <h1 style="text-shadow: 0 0 45px white; font-weight: bold; float:left;">Blog</h1>
        </a>
    </header>
    <main>
        <?php
        session_start();

        if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["eposta"]) && isset($_POST["sifre"])) {
                $eposta = $_POST["eposta"];
                $sifre = $_POST["sifre"];
                $varmi = mysqli_query($baglanti, "SELECT * FROM author WHERE email='$eposta' AND password='$sifre'");
                $bilgi = mysqli_fetch_assoc($varmi);

                if (mysqli_num_rows($varmi) > 0 && $bilgi["email"] == $eposta && $bilgi["password"] == $sifre) {
                    $_SESSION["girisyapildi"] = true;
                    $_SESSION["kullaniciid"] = $bilgi["id"];
                    $_SESSION["eposta"] = $bilgi["email"];
                    $_SESSION["sifre"] = $bilgi["password"];
                    $_SESSION["kullaniciadi"] = $bilgi["username"];
                    mysqli_close($baglanti);

                    header('Location: index.php');
                    exit;
                } else {
                    $_SESSION["hata"] = true;
                    header('Location: giris.php');
                    exit;
                }
            } else {
                $_SESSION["hata"] = true;
                header('Location: giris.php');
                exit;
            }
        }

        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
            <h1 style="text-shadow: 0 0 100px black;">Giriş Yap</h1>
            <h4><b>
                    <script>
                        const sloganlar = [
                            "Yazarların sesi, okuyucuların kalbi.",
                            "Yazılarımızla dünyayı değiştiriyoruz.",
                            "Yazarlarımızın kaleminden hayatın gerçekleri.",
                            "Okumak için yazıyoruz, yazmak için okuyoruz.",
                            "Yazarlarımızın kalemi, düşüncelerinizi şekillendirir.",
                            "Yazılarımızla hayatınıza renk katıyoruz.",
                            "Yazarlarımızın kelimeleri, zihninizi açacak.",
                            "Okuyucularımızın gözünden dünya.",
                            "Yazarlarımızın yaratıcılığı, sınırları zorlar.",
                            "Yazılarımızla hayatınızı değiştiriyoruz.",
                            "Yazarlarımızın kelimeleri, düşüncelerinizi uçuracak.",
                            "Okuyucularımızın kalbinde yer ediyoruz.",
                            "Yazarlarımızın kalemi, hayatınızı aydınlatır.",
                            "Yazılarımızla düşüncelerinizi şekillendiriyoruz.",
                            "Yazarlarımızın kelimeleri, zihninizde iz bırakacak.",
                            "Okuyucularımızın hayatına dokunuyoruz.",
                            "Yazarlarımızın yaratıcılığı, sizi şaşırtacak.",
                            "Yazılarımızla dünyayı keşfediyoruz."
                        ];
                        const slogan = sloganlar[Math.floor(Math.random() * sloganlar.length)];

                        document.write(slogan);
                    </script>
                </b></h4><br>
            <label for="eposta">E-posta:</label><br>
            <input type="email" id="eposta" name="eposta" required><br>
            <label for="sifre">Şifre:</label><br>
            <input type="password" id="sifre" name="sifre" required><br>
            <input type="submit" value="Giriş"><a href="#"
                style="text-decoration:none; color:white; font-weight:bold; padding-left: 1.2vh; text-shadow: 1px 1px #000000;"
                onclick="alert('Mail sunucusu mevcut değil.');">Şifremi unuttum</a>
            <?php
            if (isset($_SESSION["hata"]) && ($_SESSION["hata"] == true)) {
                echo "<p style='color: red; font-weight: bold;'>E-posta veya şifre yanlış girildi.</p>";
                $_SESSION["hata"] = false;
            }
            ?>
            <p style="margin-top: 1vh;">Hesabınız yok mu?<br><a href="kayit.php"
                    style="text-decoration:none; color:white; font-weight:bold; padding: top 1vh; font-size: 1.2rem; text-shadow: 2px 2px #ff0000;">Kaydol</a>
            </p>
        </form>
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>