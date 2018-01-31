-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Lis 2017, 19:43
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hardware`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cpu`
--

CREATE TABLE `cpu` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `rdzenie` tinyint(4) NOT NULL,
  `watki` tinyint(4) NOT NULL,
  `taktowanie` smallint(6) NOT NULL,
  `gniazdo` varchar(30) NOT NULL,
  `architektura` varchar(15) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `cpu`
--

INSERT INTO `cpu` (`id`, `producent`, `model`, `rdzenie`, `watki`, `taktowanie`, `gniazdo`, `architektura`, `img`) VALUES
(8, 'Intel', 'i5-4460', 4, 4, 3200, 'LGA 1150', '64', 'http://cdn.buysnip.com/INTEL-I-5-4460-2-800x800.jpg'),
(9, 'AMD', 'Ryzen 5 1500X', 4, 4, 3500, 'AM4', '64', 'https://ryanscomputers.com/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/a/m/amd_ryzen_5_1500x-2.jpg'),
(10, 'Intel', 'Pentium G4400', 2, 2, 3300, 'LGA 1151', '64', 'https://gloimg.gbtcdn.com/gb/pdm-product-pic/Electronic/2017/08/11/goods-img/1502733365498760584.jpg'),
(12, 'AMD', 'Sempron 3400+', 1, 1, 1800, 'AM2', '64', 'https://images-na.ssl-images-amazon.com/images/I/410oaQMjuBL.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gpu`
--

CREATE TABLE `gpu` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `pamiec` int(11) NOT NULL,
  `zlacze` varchar(30) NOT NULL,
  `dsub` tinyint(1) NOT NULL,
  `dvi` tinyint(1) NOT NULL,
  `hdmi` tinyint(1) NOT NULL,
  `producentgpu` varchar(30) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `gpu`
--

INSERT INTO `gpu` (`id`, `producent`, `model`, `pamiec`, `zlacze`, `dsub`, `dvi`, `hdmi`, `producentgpu`, `img`) VALUES
(6, 'Gigabyte', 'GeForce 550Ti', 1024, 'PCIE', 1, 1, 1, 'Nvidia', 'http://pclab.pl/zdjecia/artykuly/majkel/GTX550/gigabyte_persp1.jpg'),
(7, 'Gigabyte', 'Radeon R7 260X', 1024, 'PCIE', 0, 1, 1, 'AMD', 'https://images-na.ssl-images-amazon.com/images/I/61ONRWVgHKL._SX355_.jpg'),
(8, 'ATI', 'Radeon 9550', 256, 'AGP', 1, 1, 0, 'ATI', 'https://www.evertek.com/imageshare/A/300x300/ATI9550-256MTV-D-unit.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hdd`
--

CREATE TABLE `hdd` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `interfejs` varchar(10) NOT NULL,
  `pojemnosc` int(11) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `hdd`
--

INSERT INTO `hdd` (`id`, `producent`, `model`, `interfejs`, `pojemnosc`, `img`) VALUES
(1, 'Seagate', 'Barracuda', 'SATA', 1000, 'https://images-na.ssl-images-amazon.com/images/I/51h36uuxcJL.jpg'),
(2, 'Seagate', 'Barracuda PRO', 'SATA', 2000, 'https://images-na.ssl-images-amazon.com/images/I/910TSxYRC6L._SL1500_.jpg'),
(3, 'Hitachi', 'Deskstar', 'ATA', 160, 'http://www.esaitech.com/images/detailed/2/EEE/img50373.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komputer`
--

CREATE TABLE `komputer` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `plyta_id` int(11) NOT NULL,
  `cpu_id` int(11) NOT NULL,
  `gpu_id` int(11) NOT NULL,
  `hdd_id` int(11) NOT NULL,
  `ram0_id` int(11) NOT NULL,
  `ram1_id` int(11) NOT NULL,
  `ram2_id` int(11) NOT NULL,
  `ram3_id` int(11) NOT NULL,
  `psu_id` int(11) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `komputer`
--

INSERT INTO `komputer` (`id`, `nazwa`, `plyta_id`, `cpu_id`, `gpu_id`, `hdd_id`, `ram0_id`, `ram1_id`, `ram2_id`, `ram3_id`, `psu_id`, `img`) VALUES
(2, 'Perfektus', 1, 11, 9, 1, 0, 4, 0, 0, 1, 'https://8.allegroimg.com/s400/01b16e/52c6dcfd472b8aed843a2834ff58'),
(3, 'Zalman Professional', 2, 10, 6, 2, 0, 0, 3, 3, 0, 'https://images10.newegg.com/NeweggImage/ProductImage/11-235-045-02.jpg'),
(5, 'Behemot', 3, 0, 7, 3, 2, 2, 0, 0, 2, 'http://www.corsair.com/~/media/corsair/product%20photos/cases/obsidian-series/350d/small/350d_hero_down.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mobo`
--

CREATE TABLE `mobo` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `gniazdo` varchar(30) NOT NULL,
  `pci` tinyint(1) NOT NULL,
  `agp` tinyint(1) NOT NULL,
  `pcie` tinyint(1) NOT NULL,
  `ata` tinyint(1) NOT NULL,
  `sata` tinyint(1) NOT NULL,
  `ramtyp` varchar(10) NOT NULL,
  `ramilosc` tinyint(4) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `mobo`
--

INSERT INTO `mobo` (`id`, `producent`, `model`, `gniazdo`, `pci`, `agp`, `pcie`, `ata`, `sata`, `ramtyp`, `ramilosc`, `img`) VALUES
(1, 'Gigabyte', 'GA-G31M-ES2L', 'LGA 775', 1, 0, 1, 1, 1, 'DDR2', 2, 'https://static.komputronik.pl/product-picture/6/PLGAG31MES2L-1.png'),
(2, 'MSI', 'B250M PRO-VDH', 'LGA 1151', 1, 0, 1, 0, 1, 'DDR4', 4, 'https://asset.msi.com/global/picture/image/feature/mb/Z270/B250M/msi-b250m_pro_vdh-tuning-hero.png'),
(3, 'Gigabyte', 'GA-78LMT', 'AM3+', 1, 0, 1, 1, 1, 'DDR3', 4, 'https://images-na.ssl-images-amazon.com/images/I/61OeThvlGcL._SX355_.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `psu`
--

CREATE TABLE `psu` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `moc` smallint(6) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `psu`
--

INSERT INTO `psu` (`id`, `producent`, `model`, `moc`, `img`) VALUES
(1, 'be quiet!', 'Pure Power', 500, 'https://imagescdn.tweaktown.com/content/5/8/5876_01_be_quiet_pure_power_l8_500_watt_80_plus_bronze_power_supply_review.jpg'),
(2, 'Game Max', 'GP-400', 400, 'https://www.cclonline.com/images/avante/GP-400A_01.jpg?width=1600&height=1600');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `producent` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `typ` varchar(15) NOT NULL,
  `pamiec` int(11) NOT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `ram`
--

INSERT INTO `ram` (`id`, `producent`, `model`, `typ`, `pamiec`, `img`) VALUES
(2, 'Kingston', 'HyperX', 'DDR3', 4096, 'https://media.kingston.com/hyperx/features/hx-features-memory-savage-ddr3.jpg'),
(3, 'Ballistix', ' Ballistix Sport', 'DDR4', 8192, 'https://i.ebayimg.com/images/g/JuAAAOSwo4pYEESv/s-l225.jpg'),
(4, 'Kingston', 'KVR', 'DDR2', 2048, 'http://www.acusel.com/wp-content/uploads/2014/02/Kingston-ddr2.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdd`
--
ALTER TABLE `hdd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komputer`
--
ALTER TABLE `komputer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobo`
--
ALTER TABLE `mobo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psu`
--
ALTER TABLE `psu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `gpu`
--
ALTER TABLE `gpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `hdd`
--
ALTER TABLE `hdd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `komputer`
--
ALTER TABLE `komputer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `mobo`
--
ALTER TABLE `mobo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `psu`
--
ALTER TABLE `psu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
