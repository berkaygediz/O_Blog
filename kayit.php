<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol | O Blog</title>
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
        ?>
        <form action="uyelikolustur.php" method="POST" enctype="multipart/form-data">
            <h1>Kayıt Ol</h1>

            <h4>Sen de <b style="background: -webkit-linear-gradient(#E8F6EF, #FFE194);
            -webkit-background-clip: text;background-clip: text;    
            -webkit-text-fill-color: transparent; font-weight:bold;">O Blog</b>'un sınırsız içerik dünyasına
                katıl!</h4>

            <label for="kullaniciadi">Kullanıcı Adı:</label>
            <input type="text" id="kullaniciadi" name="kullaniciadi" required><br>
            <br>
            <label for="eposta">E-posta:</label>
            <input type="email" id="eposta" name="eposta" required><br>
            <br>
            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required><br>
            <br>
            <input type="submit" value="Kayıt Ol">
            <p style="margin-top: 1vh;">Hesabın var mı?<br><a href="giris.php"
                    style="text-decoration:none; color:white; font-weight:bold; padding: top 1vh; font-size: 1.2rem; text-shadow: 2px 2px #ff0000;">Giriş
                    Yap</a></p>
        </form>
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>