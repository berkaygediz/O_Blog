-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 08:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `o_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `username`, `email`, `password`, `isadmin`, `regdate`) VALUES
(14, 'bg', 'bg@bg.com', '123456', 1, '2023-06-23 02:05:27'),
(15, 'bgyorum', 'bgyorum@bg.com', '123456', 0, '2023-06-23 02:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'General'),
(2, 'Life'),
(3, 'Article'),
(4, 'Art'),
(5, 'Sport'),
(6, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `postid` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `text`, `postid`, `authorid`, `date`) VALUES
(22, 'Güzel.', 19, 15, '2023-05-24 20:08:10'),
(23, 'Burada haksızsınız.', 18, 15, '2023-05-24 20:08:22'),
(24, 'Yaşa Galatasaray!', 17, 15, '2023-05-24 20:08:35'),
(25, 'Aydınlandım.', 16, 15, '2023-05-24 20:09:32'),
(27, 'Kendimi buldum.', 14, 15, '2023-05-24 20:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `authorid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `authorid`, `categoryid`, `date`) VALUES
(14, 'Hayatın Sözü', 'Hayatla ilgili güzel ve anlamlı sözler okumak bazen hayata karşı bizi motive eder. Bazen her şeyden umudumuzu yitirmişken karşımıza çıkan hayatla ilgili anlamlı bir söz bizde umut çiçeklerinin tekrar yeşermesini sağlar. Bunun yanı sıra kendine doğru bir yolculuğa çıkmak isteyenler için de bir rehber görevi görür.\r\n\r\nYaşadığımız bu koca evrende küçük birer noktayız belki de. Tüm noktaların birleşmesiyle de oluşan rengarenk bir tablo evren! Her birimizin ayrı bir renk, ayrı bir dünya olduğu bu evrende ayrı koşuşturmalarımız ve ayrı zamanlarımız var. Hepimizin yaşama amacı, hayattan beklentileri, dünyaya kattıkları ya da dünyanın ona verdikleri birbirinden çok farklı. Hiçbir hayat yok ki bir diğeri ile tıpa tıp aynı olsun. Bu sebepledir ki yaşadığımız hayatları kıyaslamak pek de doğru olmaz. Bulunduğumuz andan keyif almak ve olmak istediğimiz gerçek “Ben”e doğru yürümek lazım. Yaşadığımız hayatta dünyadan aldıklarımız kadar kattıklarımız da olmalı. Bize sunduğu güzellikler karşısında ona teşekkürü borç bilip içinde bulunan canlı veya cansız her bir varlığa iyi davranmalıyız. Ancak böylelikle mutlu bir hayat yaşayabilir bir insan.', 14, 2, '2023-05-23 20:00:09'),
(16, 'Amerikan Mimarisi', 'Amerika Birleşik Devletleri’nin üçüncü başkanı Thomas Jefferson yenilikçi bir mimardı ve Virginia’daki evi Monticello (1772-1809) için yaptığı tasarım, dört renkli sütunlu bir Palladyan portiko kullanarak Neoklasik tarzı örnekledi. Benjamin Henry Latrobe’un resmi binalar için tercih edilen Federal tarz olarak bilinen şeyi başlattı.\r\n\r\nNeoklasizm bağlamında 1830 civarında gelişen Beaux-Arts mimarisi, Neoklasizmin resmiyetini Rönesans, Barok ve Geç Gotik mimarisinden unsurları dahil etmek için reddetti. Amerika Birleşik Devletleri’nde, Richard Morris Hunt tarafından yönetilen Beaux-Arts tarzı, “Amerikan Rönesansı” veya “Amerikan Klasisizmi” olarak tanındı. 1890’da başlayan ve İngiliz Sanat ve El Sanatları hareketinden ve Japonizm’den etkilenen son derece etkili Art Nouveau hareketi, organik, akıcı, bitkisel motifler içeriyordu.', 14, 4, '2023-05-24 20:02:43'),
(17, 'Fenerbahçe Nedir?', 'Fenerbahçe erkek futbol takımı, Fenerbahçe Spor Kulübü&#039;nün Süper Lig&#039;de mücadele eden profesyonel futbol takımıdır. Kulübün futbol dışında faaliyet gösterdiği diğer spor dalları basketbol, voleybol, atletizm, boks, kürek, yelken, yüzme ve masa tenisi&#039;dir.', 14, 5, '2023-05-24 20:05:15'),
(18, 'Teknoloji Felsefesi Nedir?', 'Yirminci yüzyılda çok sayıda düşünür, teknoloji üzerine yazdı, çizdi. Martin Heidegger, Hannah Arendt, Jacques Ellul, Langdon Winner ve Lewis Mumford bu isimlerden en dikkat çekenleri olabilir. Bu düşünürler ve adını buraya sığdıramadığımız niceleri, her ne kadar farklı tarz ve gerekçelerle de olsa, teknolojiye karşı &quot;eleştirel&quot; bir bakış geliştirdiler. Bu figürlerin çoğu, gelişen teknolojinin insan yaşamına o dönemde mevcut veya olası etkileri üzerinden analizler yaptılar. Heidegger gibi isimlerin ise daha felsefi kaygıları vardı. Heidegger özelinde teknolojinin dâhil olduğu problemin kapsamı çok daha geniş ve bu yazının sınırlarını fazlasıyla aşıyor. Fakat merak edenleriniz için ilgili Stanford Felsefe Ansiklopedisi makalesini tavsiye ediyoruz.', 14, 6, '2023-05-24 20:06:24'),
(19, 'Havalar Güzel Mi?', 'Havalar güzel mi?', 14, 1, '2023-07-15 03:17:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `authorid` (`authorid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorid` (`authorid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_CommentAuthor` FOREIGN KEY (`authorid`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `FK_CommentPost` FOREIGN KEY (`postid`) REFERENCES `post` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_PostAuthor` FOREIGN KEY (`authorid`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `FK_PostCategory` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
