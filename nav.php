<?php
if (isset($_SESSION["girisyapildi"]) && ($_SESSION["girisyapildi"] == true)) {
    echo "<div style='margin-left:10vh;margin-right:2vh;justify-content: space-between;'><a href='index.php' class='nav-eleman-kontrol'>Keşfet</a><a href='yazarlar.php' class='nav-eleman-kontrol'>Yazarlar</a><a href='yazilarim.php' class='nav-eleman-kontrol'>Yazılarım</a> <a href='yorumlarim.php' class='nav-eleman-kontrol'>Yorumlarım</a></div>";
    echo "| <div style='margin-left:2vh;'> Hoşgeldiniz, <a href='profil.php?kullaniciadi=" . $_SESSION["kullaniciadi"] . "'>" . $_SESSION["kullaniciadi"] . "</a><a href='cikis.php' class='nav-eleman-kontrol'>Çıkış</a>";
} else {
    echo "<div style='margin-left:45vh;margin-right:2vh;justify-content: space-between;'><a href='giris.php' class='nav-eleman-kontrol'>Giriş Yap</a> | <a href='kayit.php' class='nav-eleman-kontrol'>Kayıt Ol</a></div>";
}
?>