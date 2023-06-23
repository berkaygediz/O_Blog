<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <?php
    session_start();
    include("baglanti.php");
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli | O Blog</title>
    <link rel="icon" type="image/x-icon" href="img/oconom_favicon.png">
</head>

<body>
    <?php
    if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
        $kullaniciid = $_SESSION["kullaniciid"];
        $yazarbilgisor = mysqli_query($baglanti, "SELECT * FROM yazar WHERE id='$kullaniciid'");
        $yazarbilgicek = mysqli_fetch_assoc($yazarbilgisor);
        if ($yazarbilgicek["isadmin"] == 1) {
            echo "<h1>OCONOM Blog - Yönetim Paneli</h1>";
            echo "ID: " . $kullaniciid . "<br>";
            echo "Kullanıcı: " . $_SESSION["kullaniciadi"] . "<br>";
            echo "isadmin: " . $yazarbilgicek["isadmin"] . "<br>";
            echo "<a href='cikis.php'>Çıkış yap</a>";
            echo "<hr>";
            echo "<h1>Kategori Ekle</h1>";
            echo "<form action='kategoriekleaction.php' method='POST'>";
            echo "<input type='text' name='kategoriadi' placeholder='Kategori adı'>";
            echo "<input type='submit' value='Kategori ekle'>";
            echo "</form>";

            echo "<h1>Kategoriler</h1>";
            $kategorisor = mysqli_query($baglanti, "SELECT * FROM kategori");
            while ($kategoricek = mysqli_fetch_assoc($kategorisor)) {
                echo $kategoricek["kategori"];
                echo " - <a href='kategorisilaction.php?kategoriid=" . $kategoricek["id"] . "'>Sil</a>";
                echo "<br>";
            }
        } else {
            header("Location: giris.php");
        }
    } else {
        header("Location: giris.php");
    }
    ?>
</body>

</html>