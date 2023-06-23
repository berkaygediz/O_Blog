-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Haz 2023, 04:17:35
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `o_blog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Genel'),
(2, 'Hayat'),
(3, 'Makale'),
(4, 'Sanat'),
(5, 'Spor'),
(6, 'Teknoloji');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazar`
--

CREATE TABLE `yazar` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(50) NOT NULL,
  `eposta` varchar(100) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0,
  `kayitzamani` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `yazar`
--

INSERT INTO `yazar` (`id`, `kullaniciadi`, `eposta`, `sifre`, `isadmin`, `kayitzamani`) VALUES
(14, 'bg', 'bg@bg.com', '123456', 1, '2023-06-23 02:05:27'),
(15, 'bgyorum', 'bgyorum@bg.com', '123456', 0, '2023-06-23 02:05:45');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazi`
--

CREATE TABLE `yazi` (
  `id` int(11) NOT NULL,
  `baslik` varchar(200) NOT NULL,
  `metin` text NOT NULL,
  `yazarid` int(11) NOT NULL,
  `kategoriid` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `yazi`
--

INSERT INTO `yazi` (`id`, `baslik`, `metin`, `yazarid`, `kategoriid`, `tarih`) VALUES
(14, 'Hayatın Sözü', 'Hayatla ilgili güzel ve anlamlı sözler okumak bazen hayata karşı bizi motive eder. Bazen her şeyden umudumuzu yitirmişken karşımıza çıkan hayatla ilgili anlamlı bir söz bizde umut çiçeklerinin tekrar yeşermesini sağlar. Bunun yanı sıra kendine doğru bir yolculuğa çıkmak isteyenler için de bir rehber görevi görür.\r\n\r\nYaşadığımız bu koca evrende küçük birer noktayız belki de. Tüm noktaların birleşmesiyle de oluşan rengarenk bir tablo evren! Her birimizin ayrı bir renk, ayrı bir dünya olduğu bu evrende ayrı koşuşturmalarımız ve ayrı zamanlarımız var. Hepimizin yaşama amacı, hayattan beklentileri, dünyaya kattıkları ya da dünyanın ona verdikleri birbirinden çok farklı. Hiçbir hayat yok ki bir diğeri ile tıpa tıp aynı olsun. Bu sebepledir ki yaşadığımız hayatları kıyaslamak pek de doğru olmaz. Bulunduğumuz andan keyif almak ve olmak istediğimiz gerçek “Ben”e doğru yürümek lazım. Yaşadığımız hayatta dünyadan aldıklarımız kadar kattıklarımız da olmalı. Bize sunduğu güzellikler karşısında ona teşekkürü borç bilip içinde bulunan canlı veya cansız her bir varlığa iyi davranmalıyız. Ancak böylelikle mutlu bir hayat yaşayabilir bir insan.', 14, 2, '2023-05-23 20:00:09'),
(16, 'Amerikan Mimarisi', 'Amerika Birleşik Devletleri’nin üçüncü başkanı Thomas Jefferson yenilikçi bir mimardı ve Virginia’daki evi Monticello (1772-1809) için yaptığı tasarım, dört renkli sütunlu bir Palladyan portiko kullanarak Neoklasik tarzı örnekledi. Benjamin Henry Latrobe’un resmi binalar için tercih edilen Federal tarz olarak bilinen şeyi başlattı.\r\n\r\nNeoklasizm bağlamında 1830 civarında gelişen Beaux-Arts mimarisi, Neoklasizmin resmiyetini Rönesans, Barok ve Geç Gotik mimarisinden unsurları dahil etmek için reddetti. Amerika Birleşik Devletleri’nde, Richard Morris Hunt tarafından yönetilen Beaux-Arts tarzı, “Amerikan Rönesansı” veya “Amerikan Klasisizmi” olarak tanındı. 1890’da başlayan ve İngiliz Sanat ve El Sanatları hareketinden ve Japonizm’den etkilenen son derece etkili Art Nouveau hareketi, organik, akıcı, bitkisel motifler içeriyordu.', 14, 4, '2023-05-24 20:02:43'),
(17, 'Fenerbahçe Nedir?', 'Fenerbahçe erkek futbol takımı, Fenerbahçe Spor Kulübü&#039;nün Süper Lig&#039;de mücadele eden profesyonel futbol takımıdır. Kulübün futbol dışında faaliyet gösterdiği diğer spor dalları basketbol, voleybol, atletizm, boks, kürek, yelken, yüzme ve masa tenisi&#039;dir.', 14, 5, '2023-05-24 20:05:15'),
(18, 'Teknoloji Felsefesi Nedir?', 'Yirminci yüzyılda çok sayıda düşünür, teknoloji üzerine yazdı, çizdi. Martin Heidegger, Hannah Arendt, Jacques Ellul, Langdon Winner ve Lewis Mumford bu isimlerden en dikkat çekenleri olabilir. Bu düşünürler ve adını buraya sığdıramadığımız niceleri, her ne kadar farklı tarz ve gerekçelerle de olsa, teknolojiye karşı &quot;eleştirel&quot; bir bakış geliştirdiler. Bu figürlerin çoğu, gelişen teknolojinin insan yaşamına o dönemde mevcut veya olası etkileri üzerinden analizler yaptılar. Heidegger gibi isimlerin ise daha felsefi kaygıları vardı. Heidegger özelinde teknolojinin dâhil olduğu problemin kapsamı çok daha geniş ve bu yazının sınırlarını fazlasıyla aşıyor. Fakat merak edenleriniz için ilgili Stanford Felsefe Ansiklopedisi makalesini tavsiye ediyoruz.', 14, 6, '2023-05-24 20:06:24'),
(19, 'Havalar Güzel Mi?', 'Havalar güzel mi?', 14, 1, '2023-05-24 20:07:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

CREATE TABLE `yorum` (
  `id` int(11) NOT NULL,
  `metin` text NOT NULL,
  `yaziid` int(11) NOT NULL,
  `yazarid` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`id`, `metin`, `yaziid`, `yazarid`, `tarih`) VALUES
(22, 'Güzel.', 19, 15, '2023-05-24 20:08:10'),
(23, 'Burada haksızsınız.', 18, 15, '2023-05-24 20:08:22'),
(24, 'Yaşa Galatasaray!', 17, 15, '2023-05-24 20:08:35'),
(25, 'Aydınlandım.', 16, 15, '2023-05-24 20:09:32'),
(27, 'Kendimi buldum.', 14, 15, '2023-05-24 20:12:13');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yazar`
--
ALTER TABLE `yazar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yazi`
--
ALTER TABLE `yazi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yazarid` (`yazarid`),
  ADD KEY `kategoriid` (`kategoriid`);

--
-- Tablo için indeksler `yorum`
--
ALTER TABLE `yorum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_YorumYazar` (`yazarid`),
  ADD KEY `FK_YorumYazi` (`yaziid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `yazar`
--
ALTER TABLE `yazar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `yazi`
--
ALTER TABLE `yazi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `yorum`
--
ALTER TABLE `yorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `yazi`
--
ALTER TABLE `yazi`
  ADD CONSTRAINT `FK_YaziKategori` FOREIGN KEY (`kategoriid`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `FK_YaziYazar` FOREIGN KEY (`yazarid`) REFERENCES `yazar` (`id`);

--
-- Tablo kısıtlamaları `yorum`
--
ALTER TABLE `yorum`
  ADD CONSTRAINT `FK_YorumYazar` FOREIGN KEY (`yazarid`) REFERENCES `yazar` (`id`),
  ADD CONSTRAINT `FK_YorumYazi` FOREIGN KEY (`yaziid`) REFERENCES `yazi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
