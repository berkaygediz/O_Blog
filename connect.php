<?php
$host = "localhost";
$kadi = "root";
$veritabani = "o_blog";
$baglanti = mysqli_connect($host, $kadi);
if ($baglanti == true) {
} else {
    echo mysqli_error($baglanti);
}

@mysqli_select_db($baglanti, $veritabani) or die("Veri tabanına bağlanamadık.");
?>