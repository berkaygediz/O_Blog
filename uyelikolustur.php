<?php
include("connect.php");

$kullaniciadi = $_POST["kullaniciadi"];
$eposta = $_POST["eposta"];
$sifre = $_POST["sifre"];

$kullaniciadi_oncesi = mysqli_query($baglanti, "SELECT * FROM author WHERE username='$kullaniciadi'");
$eposta_oncesi = mysqli_query($baglanti, "SELECT * FROM author WHERE email='$eposta'");

if (mysqli_num_rows($kullaniciadi_oncesi) == 0 && mysqli_num_rows($eposta_oncesi) == 0) {
    $ekle = mysqli_query($baglanti, "INSERT INTO author (username, email, password) VALUES ('$kullaniciadi', '$eposta', '$sifre')");
    if ($ekle) {
        session_start();
        $varlik_kontrol = mysqli_query($baglanti, "SELECT * FROM author WHERE username='$kullaniciadi' AND email='$eposta'");
        $bilgi_kontrol = mysqli_fetch_assoc($varlik_kontrol);
        $_SESSION["girisyapildi"] = true;
        $_SESSION["kullaniciid"] = $bilgi_kontrol["id"];
        $_SESSION["kullaniciadi"] = $bilgi_kontrol["username"];
        $_SESSION["eposta"] = $bilgi_kontrol["email"];
        $_SESSION["sifre"] = $bilgi_kontrol["password"];
        mysqli_close($baglanti);

        header('Location: index.php');
        exit;
    } else {
        echo "Hata: " . $ekle . "<br>" . mysqli_error($baglanti);
    }
} else {
    $_SESSION["hata"] = true;
    header('Location: kayit.php');
    exit;
}

?>