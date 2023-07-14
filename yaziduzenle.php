<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazı Düzenleme | O Blog</title>
    <link rel="icon" type="image/x-icon" href="img/o_favicon.png">
    <?php
    session_start();
    include("connect.php");
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
            cursor: pointer;
            transition: all 0.5s ease-in-out;
            font-weight: bold;
        }

        #olustur:hover {
            transform: scale(1.125);
            transition: all 0.5s ease-in-out;
            border: 1px dashed red;
            box-shadow: 0 0 30px white;
        }

        input[type="text"],
        textarea,
        select {
            border: 2px solid wheat;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            transition: all 0.5s ease-in-out;
            color: black;
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
            <<?php
            include("nav.php");
            ?>
        </div>
    </header>
    <main>
        <?php
        if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
            $kullaniciid = $_SESSION["kullaniciid"];
            $yaziid = $_GET['yaziid'];
            echo "<h1>Yazını Düzenle</h1>";
            $yazisor = mysqli_query($baglanti, "SELECT * FROM post WHERE id='$yaziid'");
            $yazicek = mysqli_fetch_assoc($yazisor);
            if ($yazicek["id"] == $_GET["yaziid"]) {

                echo "<form action='yaziduzenleaction.php?yaziid=" . $yaziid . "' method='POST'>
            <input type='text' name='baslik' value='" . $yazicek["title"] . "' placeholder='Başlık' style='width: 60%; padding: 1vh 1vh 1vh 1vh; border-radius: 2em; border: 1px solid white; background: linear-gradient(45deg, #F9FBE7, #F0EDD4, #ECCDB4); font-weight: bold; font-size: 2em;font-family: Arial, Helvetica, sans-serif;' maxlength='100' required><br><br>
            <textarea name='metin' placeholder='İçerik' style='width: 70%; height: 50vh; padding: 1vh 1vh 1vh 1vh; border-radius: 2em; border: 1px solid white; background-color: #F0EDD4; color: black; font-weight: bold; font-family: Arial, Helvetica, sans-serif;' maxlength='3500' required>" . $yazicek["text"] . "</textarea><br><br>
            <input type='submit' id='olustur' value='Yazıyı Düzenle'>";
            }
        } else {
            header("Location: giris.php");
        }

        ?>
    </main>
    <footer>
        <p style="color: white; font-weight: bold; text-decoration: none;">O Blog &copy; 2023 - Berkay Gediz - <a
                href="https://github.com/berkaygediz">GitHub</a> </p>
    </footer>
</body>

</html>