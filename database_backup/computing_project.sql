-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 09:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computing_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `spec1` varchar(100) NOT NULL,
  `spec2` varchar(100) NOT NULL,
  `spec3` varchar(100) NOT NULL,
  `spec4` varchar(100) NOT NULL,
  `original_price` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `reviews` int(15) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT 'NA',
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL,
  `sub_type` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `description`, `img`, `date`, `type`, `sub_type`, `status`) VALUES
(8, 'NA', 'Summer Discount 20% off', '1716393821banner1.jpg', '2024-05-22 22:33:41', 'main', '', 1),
(9, 'NA', 'BAnnEr 2. Is CoOL', '1716395214banner2.jpg', '2024-05-22 22:56:54', 'main', '', 1),
(10, 'NA', 'You gotta keep it flashy~~~~~~~~~~~~', '1716632235banner4.jpg', '2024-05-22 22:57:10', 'main', '', 1),
(11, 'NA', 'secondary 1', 'testing', '2024-05-25 17:01:39', 'secondary', 'main', 1),
(12, 'NA', 'secondary 2', 'testing', '2024-05-25 17:02:07', 'secondary', 'sub', 1),
(13, 'NA', 'secondary 3', 'testing', '2024-05-25 17:02:25', 'secondary', 'mini1', 1),
(14, 'NA', 'secondary4', 'testing', '2024-05-25 17:02:39', 'secondary', 'mini2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(15) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `products` varchar(60) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `products`, `img`, `description`, `link`) VALUES
(3, 'DELL', ' Desktops  Laptops  Components', '1702566252dell.png', 'Company which is special in office use Desktop PCs and accessories\r\n', 'https://www.dell.com/'),
(4, 'Asus', ' Desktops  Laptops  Motherboard  Components ', '1702272629asus.png', 'Literally ASUS. All gamers should know about this company. Quality and performance', 'https://www.asus.com/'),
(5, 'Nividia', ' GPU ', '1702273161nividia.png', 'Popular Graphics Card manufacturer. All gamers know. Some love, some hate.', 'https://www.nvidia.com/en-us/'),
(6, 'msi', ' Laptops  Motherboard  Components ', '1702566752msi.png', 'mostly popular for gaming laptops', 'https://www.msi.com/page/msi-logos'),
(7, 'Intel', ' CPU ', '1702308961intel.png', 'A cpu company everyone who works with computer for more than 1 year know. If they don&#039;t know, it is their fault. \r\nIntel manufacture mainly consumer grade chipsets with good price and good quality.', 'https://www.intel.com/content/www/us/en/homepage.html'),
(8, 'Corsair', ' Components ', '1702541788Corsair.png', 'asdfasd', 'https://www.corsair.com/us/en'),
(12, 'Asrock', ' Motherboard ', '1702656209asrock.jpg', 'Motherboard manufacturer. Pretty popular, I guess.', 'https://www.asrock.com/index.asp'),
(13, 'AMD', ' GPU  CPU ', '1702734638amd.png', 'Popular for performance chipsets. Mostly loved by gamers. One and only competitor of Intel. Apple sucks.', 'https://www.amd.com/en.html'),
(14, 'Gigabyte', ' Motherboard  Components ', '1702753213gigabyte.png', 'Popular for quality motherboard products. Pretty popular among PC gamers. updated', 'https://www.gigabyte.com/'),
(15, 'fujitsu', ' Desktops  Laptops  Motherboard  Components ', '1702787383fujitsu.png', 'popular japanese electronic company', 'https://www.gigabyte.com/Motherboard/B450-AORUS-ELITE-rev-1x#kf'),
(16, 'Samsung', ' Components ', '1702883441samsung.png', 'One of the most popular electronic companies around the world. Samsung also manufactures computer components such as RAMs. ', 'https://www.samsung.com/us/'),
(17, 'Crucial', ' Components ', '1702889948crucial.png', 'Popular for their computer solid state drive products. Their products are budget friendly and reliable.', 'https://www.crucial.com/'),
(20, 'Microsoft', ' Laptops  operating_system ', '1703257725Microsoft.png', 'One of the biggest IT cooperation around the world. Windows operating system is one of its most popular products', 'https://www.microsoft.com/en-us/');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coming_soon`
--

CREATE TABLE `coming_soon` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `timer` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cooler`
--

CREATE TABLE `cooler` (
  `id` int(11) NOT NULL,
  `cooler_name` varchar(255) NOT NULL,
  `brand` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `type` varchar(150) NOT NULL,
  `fan_speed` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `radiator_dimension` varchar(100) NOT NULL,
  `tube_length` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cooler`
--

INSERT INTO `cooler` (`id`, `cooler_name`, `brand`, `img`, `type`, `fan_speed`, `power`, `radiator_dimension`, `tube_length`, `price`, `link`) VALUES
(2, 'ROG RYUJIN III 240', 4, '1703004324rog_ryujinIII240.png', 'Liquid Cooling', 2000, 30, '279.5 x 120 x 30 mm', 400, 150, 'https://rog.asus.com/cooling/cpu-liquid-coolers/rog-ryujin/rog-ryujin-iii-240/');

-- --------------------------------------------------------

--
-- Table structure for table `cpu`
--

CREATE TABLE `cpu` (
  `id` int(15) NOT NULL,
  `brand` int(15) NOT NULL,
  `cpu_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `generation` tinyint(4) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `cores` int(11) NOT NULL,
  `threads` int(11) NOT NULL,
  `power` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpu`
--

INSERT INTO `cpu` (`id`, `brand`, `cpu_name`, `img`, `description`, `generation`, `frequency`, `cores`, `threads`, `power`, `price`, `link`) VALUES
(4, 7, 'Intel&reg; Core&trade; i9 processor 14900K', '1703005007core-i9.jpg', 'A popular chip with great performance. Price over performance I guess', 9, ' 5.6', 24, 32, 150, 500, 'https://ark.intel.com/content/www/us/en/ark/products/236773/intel-core-i9-processor-14900k-36m-cache-up-to-6-00-ghz.html'),
(5, 13, 'AMD Ryzen&trade; 7 5800X', '1703005200ryzen7.jpg', '8 cores optimized for high-FPS gaming rigs. As an AMD chip, it is pretty well rounded. Both budget wise and performance wise', 5, '4.7', 8, 16, 105, 150, 'https://www.amd.com/en/products/cpu/amd-ryzen-7-5800x'),
(6, 7, 'Intel&reg; Core&trade; i5-13600K Processor', '1703523224corei513600k.png', 'Powerful and budget friendly chipset. Most used in family friendly budget gaming PC.', 13, '5.10', 14, 20, 127, 240, 'https://ark.intel.com/content/www/us/en/ark/products/230493/intel-core-i5-13600k-processor-24m-cache-up-to-5-10-ghz.html'),
(7, 13, 'AMD Ryzen&trade; 9 5900X', '1703525468ryzen9.jpg', 'Good. Pricey. Powerful. Not the best but one of the bests.', 9, '4.8', 12, 24, 105, 306, 'https://www.amd.com/en/products/cpu/amd-ryzen-9-5900x');

-- --------------------------------------------------------

--
-- Table structure for table `desktop_case`
--

CREATE TABLE `desktop_case` (
  `id` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `desktop_case_name` varchar(255) NOT NULL,
  `type` varchar(150) NOT NULL,
  `color` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL,
  `cooling` varchar(150) NOT NULL,
  `dimensions` varchar(150) NOT NULL,
  `io_panel` varchar(255) NOT NULL,
  `radiator_support` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desktop_case`
--

INSERT INTO `desktop_case` (`id`, `brand`, `desktop_case_name`, `type`, `color`, `img`, `cooling`, `dimensions`, `io_panel`, `radiator_support`, `price`, `link`) VALUES
(2, 8, '3000D RGB AIRFLOW Mid-Tower PC Case - Black', 'Mid Tower', 'Black', '1702898780corsaircase1.jpg', ' H55, H60, H100, H115, H150', '466,462,230', ' 2x USB 3.2 Gen 1 Type-A, Headphone/Mic Combo Jack ', ' 120mm, 140mm, 240mm, 280mm, 360mm', 100, 'https://www.corsair.com/us/en/p/pc-cases/cc-9011255-ww/3000d-rgb-tempered-glass-mid-tower-black-cc-9011255-ww#tab-techspecs'),
(8, 4, 'ROG Hyperion EVA-02 Edition', 'Full Tower', 'red and black', '1703473501rogHyperion.png', '3 x 120 mm 3 x 140 mm', ' 268 * 639 * 659 mm', ' 1 x headphone / Microphone 4 x USB 3.2Gen1 1 x USB 3.2 Gen2 Type C LED Control Button Reset Button 1 x USB 4.0 Type C or 1 x USB 3.2 Gen 2x2 Type C', '120 mm 140 mm 240 mm 280 mm 360 mm 420 mm', 766, 'https://rog.asus.com/cases/rog-hyperion-gr701-eva-02-edition/'),
(9, 4, 'ROG Strix Helios White Edition', 'Mid Tower', 'White', '1703473649rogStrixHelios.png', '3 x 120 mm 3 x 140 mm Radiator + Fan Thickness: Max. 90 mm', ' 250 x 565 x 591 mm', ' 1 x Headphone 1 x Microphone 4 x USB 3.1 Gen1 1 x USB 3.1 Gen2 Type C LED Control Button Fan Control Button Reset Button', '120 mm 140 mm 240 mm 280 mm 360 mm', 856, 'https://rog.asus.com/cases/rog-strix-helios-white-edition-model/'),
(10, 4, ' TUF Gaming GT501', 'Mid Tower', 'Grey', '1703473798turGT501.png', '3 x 120 mm 2 x 140 mm', '552 x 251 x 545 mm', ' 1 x Headphone 1 x Microphone 2 x USB 3.1 Gen1', '120 mm 140 mm', 356, 'https://www.asus.com/motherboards-components/gaming-cases/tuf-gaming/tuf-gaming-gt501/');

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gpu`
--

CREATE TABLE `gpu` (
  `id` int(11) NOT NULL,
  `brand` varchar(150) NOT NULL,
  `gpu_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `vram` tinyint(4) NOT NULL,
  `memory_type` varchar(100) NOT NULL,
  `power` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gpu`
--

INSERT INTO `gpu` (`id`, `brand`, `gpu_name`, `img`, `vram`, `memory_type`, `power`, `price`, `link`) VALUES
(1, '5', 'NVIDIA GeForce RTX 4090', '1702820474rtx4090.jpg', 24, 'GDDR6X', 450, 1600, 'https://www.nvidia.com/en-us/geforce/graphics-cards/40-series/rtx-4090/'),
(2, '5', 'NVIDIA GeForce RTX 4060Ti ', '1702820983rtx4060ti.jpg', 16, 'GDDR6', 165, 500, 'https://www.nvidia.com/en-us/geforce/graphics-cards/40-series/rtx-4060-4060ti/'),
(3, '5', 'GeForce RTX 3060ti', '17036035323060ti.png', 8, 'GDDR6X', 200, 310, 'https://www.nvidia.com/en-us/geforce/graphics-cards/30-series/rtx-3060-3060ti/');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `id` int(15) NOT NULL,
  `brand` int(15) NOT NULL,
  `laptop_name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `os` varchar(150) NOT NULL,
  `cpu` varchar(150) NOT NULL,
  `gpu` varchar(150) NOT NULL,
  `ram` varchar(150) NOT NULL,
  `primary_storage` varchar(150) NOT NULL,
  `secondary_storage` varchar(150) DEFAULT NULL,
  `io_ports` varchar(255) NOT NULL,
  `internet` varchar(150) NOT NULL,
  `display` varchar(150) NOT NULL,
  `battery` varchar(150) NOT NULL,
  `dimensions` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `bonus` varchar(150) DEFAULT NULL,
  `free_shipping` tinyint(4) NOT NULL DEFAULT 0,
  `rating` tinyint(4) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`id`, `brand`, `laptop_name`, `category`, `os`, `cpu`, `gpu`, `ram`, `primary_storage`, `secondary_storage`, `io_ports`, `internet`, `display`, `battery`, `dimensions`, `img`, `price`, `bonus`, `free_shipping`, `rating`, `date`, `description`, `stock`, `link`) VALUES
(3, 4, 'ROG Strix SCAR 17 X3D (2023) G733  G733PYV-LL061X', 'Gaming', 'Windows 11 Professional', ' AMD Ryzen&trade; 9 7945HX3D Mobile Processor (16-core/32-thread, 128MB L3 cache, up to 5.4 GHz max boost)', ' NVIDIA&reg; GeForce RTX&trade; 4090 Laptop GPU ROG Boost: 2090MHz* at 175W (2040MHz Boost Clock+50MHz OC, 150W+25W Dynamic Boost) 16GB GDDR6', ' 32GB DDR5-4800 SO-DIMM x 2 Max Capacity: 64GB', ' 2TB PCIe&reg; 4.0 NVMe&trade; M.2 Performance SSD', 'NA', ' 1x 3.5mm Combo Audio Jack 1x HDMI 2.1 FRL 2x USB 3.2 Gen 1 Type-A 1x USB 3.2 Gen 2 Type-C support DisplayPort&trade; / power delivery / G-SYNC 1x USB 3.2 Gen 2 Type-C support DisplayPort&trade; / G-SYNC 1x 2.5G LAN port', 'Wi-Fi 6E(802.11ax) (Triple band) 2*2 + Bluetooth&reg; 5.3 Wireless Card ', ' 17.3-inch WQHD (2560 x 1440) 16:9 IPS-level', ' 90WHrs, 4S1P, 4-cell Li-ion', '39.5 x 28.2 x 2.34 ~ 2.83 cm (15.55&quot; x 11.10&quot; x 0.92&quot; ~ 1.11&quot;)', '1703401697rogStrixScar17.png', 1593, ' ROG backpack ROG Fusion II 300 ROG Gladius III Mouse P514 TYPE-C, 100W AC Adapter, Output: 20V DC, 5A, 100W, Input: 100~240V AC 50/60Hz universal', 1, NULL, '2023-12-24 07:08:17', 'Reach the pinnacle of Windows 11 Pro gaming on the 2023 Strix SCAR 17 X3D, with an AMD Ryzen&trade; 9 7945HX3D processor and an NVIDIA&reg; GeForce RTX&trade; 4090 Laptop GPU.', 20, 'https://rog.asus.com/laptops/rog-strix/rog-strix-scar-17-x3d-2023/'),
(4, 6, 'Stealth GS77 12UH', 'Gaming', 'Windows 11 Home', '12th Gen Intel&reg; Core&trade; i9 Processor', 'NVIDIA&reg; GeForce RTX&trade; 3080 Laptop GPU 8GB GDDR6', 'Max 64GB DDR5-4800 2 Slots', ' 1TB M.2 SSD (NVMe PCIe Gen4)', '1TB M.2 SSD slot (NVMe PCIe Gen4)', '1x Type-C (USB3.2 Gen2 / DP) 1x Type-C (USB / DP / Thunderbolt&trade; 4) with PD charging 2x Type-A USB3.2 Gen2 1x SD Express Card Reader 1x HDMI&trade; 2.1 (8K @ 60Hz / 4K @ 120Hz) 1x RJ45', 'Killer Gb LAN (Up to 2.5G) Intel&reg; Killer&trade; AX Wi-Fi 6E + Bluetooth 5.2', '17.3&quot; FHD (1920x1080), 360Hz, IPS-Level', '4-Cell 99 Battery (Whr)', '397.6 x 283.5 x 20.1~20.8 mm', '1703402078msiStealth.png', 1900, 'NA', 0, NULL, '2023-12-24 07:14:38', 'Experience performance with portability.\r\nA combination of gaming and business features,\r\nthe all-new Stealth GS77 is made for business and gaming.', 11, 'https://www.msi.com/Laptop/Stealth-GS77-12UX/Overview'),
(5, 4, 'ROG Zephyrus Duo 16 ', 'Gaming', 'Windows 11 Professional', 'AMD Ryzen&trade; 9 7945HX Mobile Processor (16-core/32-thread, 64MB L3 cache, up to 5.4 GHz max boost)', 'NVIDIA&reg; GeForce RTX&trade; 4090 Laptop GPU ROG Boost: 2090 MHz* at 175W (2040MHz Boost Clock+50MHz OC, 140W+15W Dynamic Boost in Turbo Mode, 150W+', '32GB DDR5-4800 SO-DIMM x 2 Max Capacity: 64GB Support dual channel memory', '2TB PCIe&reg; 4.0 NVMe&trade; M.2 Performance SSD (RAID 0)', '2TB PCIe&reg; 4.0 NVMe&trade; M.2 Performance SSD (RAID 0)', '1x 3.5mm Combo Audio Jack 1x HDMI 2.1 FRL 2x USB 3.2 Gen 2 Type-A 1x USB 3.2 Gen 2 Type-C support DisplayPort&trade; / power delivery / G-SYNC 1x USB 3.2 Gen 2 Type-C support DisplayPort&trade; / G-SYNC 1x 2.5G LAN port', 'Wi-Fi 6E(802.11ax) (Triple band) 2*2 + Bluetooth&reg; 5.3 Wireless Card (*Bluetooth&reg; version may change with OS version different.)', '16-inch QHD+ 16:10 (2560 x 1600, WQXGA) Mini LED Anti-glare display DCI-P3: 100 Refresh Rate: 240Hz.  Additional Display: ScreenPad&trade; Plus (14&qu', '90WHrs, 4S1P, 4-cell Li-ion', '35.5 x 26.6 x 2.05 ~ 2.97 cm (13.98&quot; x 10.47&quot; x 0.81&quot; ~ 1.17&quot;)', '1703423431rogZephyrusDuo16.jpg', 2250, 'ROG Ranger BP2701 Gaming Backpack ROG Fusion II 300 Palm rest ROG Gladius III Mouse P514 TYPE-C, 100W AC Adapter, Output: 20V DC, 5A, 100W, Input: 100', 1, NULL, '2023-12-24 13:10:31', 'Game or create on the cutting edge with up to an AMD Ryzen&trade; 9 7945HX processor and up to an NVIDIA&reg;GeForce RTX&trade; 4090 Laptop GPU. The Ryzen&trade; 9 7945HX CPU offers incredible gaming and multitasking performance, letting you stream and render even the most intensive projects, while the powerful RTX&trade; 4090 Laptop GPU guarantees incredible in-game framerates and content creation acceleration. A 1080p IR webcam offers seamless video capture and security with Windows Hello support. With up to 4TB of blazing fast PCIe&reg;4.0 SSD storage in RAID 0 and 64GB of 4800MHz DDR5 RAM, the 2023 Zephyrus Duo 16 is a multitasking monster and offers rapid load times for all your games and applications.', 5, 'https://rog.asus.com/laptops/rog-zephyrus/rog-zephyrus-duo-16-2023-series/'),
(6, 4, 'ASUS Zenbook 14 OLED (UX3405)', 'Professional', 'Windows 11 Home', 'Intel&reg; Core&trade; Ultra 7 Processor 155H 1.4 GHz (24MB Cache, up to 4.8 GHz, 16 cores, 22 Threads); Intel&reg; AI Boost NPU', 'Intel&reg; Arc&trade; Graphics', '16GB LPDDR5X on board Max Total system memory up to:16GB', ' 1TB M.2 NVMe&trade; PCIe&reg; 4.0 SSD', '512GB M.2 NVMe&trade; PCIe&reg; 4.0 SSD', ' 1x USB 3.2 Gen 1 Type-A 2x Thunderbolt&trade; 4 supports display / power delivery 1x HDMI 2.1 TMDS 1x 3.5mm Combo Audio Jack', 'Wi-Fi 6E(802.11ax) (Dual band) 2*2 + Bluetooth&reg; 5.3 Wireless Card ', '14.0-inch, 3K (2880 x 1800) OLED 16:10 aspect ratio, 0.2ms response time, 120Hz refresh rate, 400nits, 600nits HDR peak brightness, 100% DCI-P3 color ', ' 75WHrs, 2S2P, 4-cell Li-ion', '31.24 x 22.01 x 1.49 ', '1703423955Zenbook14.png', 1223, 'Microsoft Office Home &amp; Business 2021,  Sleeve Stylus (Active stylus SA200H-MPP1.51 support) USB-A to RJ45 gigabit ethernet adapter', 1, NULL, '2023-12-24 13:19:15', 'Go the extra mile with the remarkably sleek Zenbook 14 OLED &mdash; the ultimate ultraportable laptop that takes sophistication to a whole new level. Seize every moment using the enhanced extended-life battery, amplify your efficiency with the top-tier Intel&reg; Core&trade; Ultra processor Series 1 and Intel Arc&trade; graphics, and achieve seamless connectivity via all the essential ports. Immerse your senses in the vivid ASUS Lumina OLED1 touchscreen2 and powerful new Super-linear speakers, while embracing the eco-elegance of the environmentally conscious design.', 7, 'https://www.asus.com/laptops/for-home/zenbook/asus-zenbook-14-oled-ux3405/');

-- --------------------------------------------------------

--
-- Table structure for table `memory`
--

CREATE TABLE `memory` (
  `id` int(11) NOT NULL,
  `brand` int(150) NOT NULL,
  `ram_name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `capacity` tinyint(4) DEFAULT NULL,
  `frequency` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `combo` tinyint(4) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memory`
--

INSERT INTO `memory` (`id`, `brand`, `ram_name`, `img`, `capacity`, `frequency`, `price`, `combo`, `link`) VALUES
(1, 8, 'Vengance CMH32GX5M2B5200C40', '1702873857VengeanceCMH32GX5M2B5200C40(2x16GB).png', 16, 'DDR5 DRAM 5200MT/s', 120, 2, 'https://www.corsair.com/us/en/p/memory/cmh32gx5m2b5200c40/vengeance-rgb-32gb-2x16gb-ddr5-dram-5200mhz-c40-memory-kit-black-cmh32gx5m2b5200c40'),
(2, 14, 'ARS32G60D5R', '1702883248ARS32G60D5R(2x16GB).png', 16, 'DDR5 6000MT/s', 200, 2, 'https://www.gigabyte.com/Memory/AORUS-RGB-Memory-DDR5-32GB--2x16GB-6000MT-s#kf'),
(3, 16, 'M323R2GA3BB0-CQK', '1702883694samsungram.jpg', 16, 'DDR5-4800MHz', 300, 2, 'https://semiconductor.samsung.com/dram/module/udimm/m323r2ga3bb0-cqk/');

-- --------------------------------------------------------

--
-- Table structure for table `motherboard`
--

CREATE TABLE `motherboard` (
  `id` int(15) NOT NULL,
  `brand` int(15) NOT NULL,
  `motherboard_name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `chipset` varchar(100) NOT NULL,
  `chipset_name` varchar(50) NOT NULL,
  `form_factor` varchar(50) NOT NULL,
  `ram_slots` tinyint(2) NOT NULL,
  `link` varchar(300) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motherboard`
--

INSERT INTO `motherboard` (`id`, `brand`, `motherboard_name`, `img`, `chipset`, `chipset_name`, `form_factor`, `ram_slots`, `link`, `price`) VALUES
(3, 4, 'PRIME H610M-F D4 R2.0', '1702109165Prime_B350-Plus-7.jpg', 'AMD', 'H610', 'ATX', 4, 'https://www.asus.com/motherboards-components/motherboards/prime/prime-h610m-f-d4-r2-0/', 1200),
(4, 12, 'Asrock B550M-HDV', '1702182945B550M-HDV-1.png', 'AMD', 'H610', 'E-ATX', 4, 'https://www.asrock.com/mb/AMD/B550M-HDV/index.asp', 1100),
(5, 4, 'Asus Z170 Pro Gaming', '1702183074Z170_Pro_Gaming-1.jpg', 'Intel', 'Z170', 'ATX', 4, 'https://www.asus.com/Motherboards/Z170-PRO-GAMING/', 1500),
(6, 4, 'Asus Z170-A', '1702299893Z170-A-1.jpg', 'Intel', 'Z170', 'ATX', 4, 'https://www.asus.com/Motherboards/Z170-A/', 1100),
(9, 14, 'Gigabyte B550I Aorus Pro AX', '1702753574B550I_Aorus_Pro_AX-1.png', 'AMD', 'AMD B550', 'Mini ATX', 2, 'https://www.gigabyte.com/Motherboard/B550I-AORUS-PRO-AX-10', 1500),
(27, 14, 'Gigabyte B450 Aorus Elite', '1702789729B450_Aorus_Elite-1.png', 'AMD', 'B450', 'ATX', 4, 'https://www.gigabyte.com/Motherboard/B450-AORUS-ELITE-rev-1x#kf', 120);

-- --------------------------------------------------------

--
-- Table structure for table `operating_system`
--

CREATE TABLE `operating_system` (
  `id` int(11) NOT NULL,
  `operating_system_name` varchar(255) NOT NULL,
  `brand` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operating_system`
--

INSERT INTO `operating_system` (`id`, `operating_system_name`, `brand`, `img`, `description`, `price`, `link`) VALUES
(1, 'Windows 11 Home Edition', 20, '1703307749windows11.png', 'Home edition for windows 11 operating system. Popular for its fair price and powerful os.', 60, 'https://www.microsoft.com/software-download/windows11');

-- --------------------------------------------------------

--
-- Table structure for table `popular`
--

CREATE TABLE `popular` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts_comments`
--

CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `power_supply`
--

CREATE TABLE `power_supply` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `power_supply_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `dimension` varchar(150) NOT NULL,
  `power` int(4) NOT NULL,
  `modular` varchar(10) NOT NULL,
  `pcie` tinyint(4) NOT NULL,
  `sata` tinyint(4) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_supply`
--

INSERT INTO `power_supply` (`id`, `brand`, `power_supply_name`, `img`, `dimension`, `power`, `modular`, `pcie`, `sata`, `price`, `link`) VALUES
(1, '4', 'ROG LOKI SFX-L 1000W Platinum', '1702895190ROG-Loki-SFX-L-1000W-Platinum.png', '4.9 x 4.9 x 2.5 inches', 1000, 'Yes', 4, 0, 500, 'https://rog.asus.com/power-supply-units/rog-loki/rog-loki-1000p-sfx-l-gaming-model/'),
(2, '4', 'ROG STRIX 850W Gold', '1709974621rog_strix_powersupply.png', '16 x 15 x 8.6 Centimeter', 200, 'Yes', 8, 4, 510, 'https://rog.asus.com/power-supply-units/rog-strix/rog-strix-850g/spec/');

-- --------------------------------------------------------

--
-- Table structure for table `prebuilt`
--

CREATE TABLE `prebuilt` (
  `id` int(15) NOT NULL,
  `prebuilt_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(150) NOT NULL,
  `os` int(15) NOT NULL,
  `cpu` int(15) NOT NULL,
  `gpu` int(15) NOT NULL,
  `ram` int(15) NOT NULL,
  `primary_storage` int(15) NOT NULL,
  `secondary_storage` int(15) DEFAULT NULL,
  `motherboard` int(15) NOT NULL,
  `desktop_case` int(11) NOT NULL,
  `power_supply` int(15) NOT NULL,
  `price` int(15) NOT NULL,
  `default_price` int(11) NOT NULL,
  `free_shipping` tinyint(1) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prebuilt`
--

INSERT INTO `prebuilt` (`id`, `prebuilt_name`, `description`, `img`, `os`, `cpu`, `gpu`, `ram`, `primary_storage`, `secondary_storage`, `motherboard`, `desktop_case`, `power_supply`, `price`, `default_price`, `free_shipping`, `status`, `date`, `stock`) VALUES
(35, 'TLT GX60 007 BgGaming', 'A budget gamin desktop with all rounded specifications and performance. Can handle 99% of all modern software.\r\nWindows 11 Home Edition, PRIME H610M-F D4 R2.0, AMD Ryzen&trade; 7 5800X, NVIDIA GeForce RTX 4090, Vengance CMH32GX5M2B5200C40, ROG RYUJIN III 240', '1715488219turGT501.png', 1, 5, 1, 1, 1, 1, 3, 10, 1, 5400, 4276, 1, 'None', '2024-05-09 16:16:47', 20),
(36, 'TLX ST5000 ProGm 270', 'Intel&reg; Core&trade; i9 processor 14900K, Windows 11 Home Edition, Asus Z170-A From factor: ATX, AORUS Gen4 7300 SSD 1TB', '1715489140rogStrixHelios.png', 1, 4, 2, 1, 2, 2, 6, 9, 1, 4000, 3946, 1, 'Hot', '2024-05-12 04:45:40', 5),
(38, 'JDev XloTLS666', 'Powerful gaming desktop', '1716096044desktop1.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 5000, 4600, 1, 'Hot', '2024-05-19 05:20:44', 60),
(39, 'GLX 5000 TLS', 'Powerful Gaming Desktop PC', '1716096078desktop2.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 3000, 4600, 0, 'New', '2024-05-19 05:21:18', 12),
(40, 'ALS4000 LinLin', 'Super powerful gaming desktop PC', '1716096129desktop5.jpg', 1, 5, 1, 1, 1, 0, 3, 2, 1, 2556, 3950, 1, 'Discount', '2024-05-19 05:22:09', 30),
(41, 'ALS4000 ShanShan', 'Lorem ipsum 123 this is some text. Literally some text.', '1716096188desktop6.jpg', 1, 4, 2, 1, 1, 0, 5, 2, 1, 3000, 3500, 0, 'Hot', '2024-05-19 05:23:08', 30),
(42, 'ALS4000 K', 'Powerful Gaming Desktop PC', '1716096215desktop4.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 49000, 4600, 1, 'None', '2024-05-19 05:23:35', 20),
(43, 'JDevT XloTLS666', 'Some text, this is some text', '1716096258desktop1.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 2330, 4600, 1, 'New', '2024-05-19 05:24:18', 15),
(44, 'JDevT XloTLS222', 'Clean', '1716096309desktop5.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 3999, 4600, 1, 'New', '2024-05-19 05:25:09', 15),
(45, 'ALS4000 LinLin', 'Windows 11 Home, Intel Core i9-14900KF CPU, ASUS Z790 WiFi MB, GeForce RTX 4070 SUPER 12GB GPU, 32GB DDR5-6000MHz RGB RAM, 2TB M.2 NVMe SSD, iBUYPOWER 360mm RGB Liquid Cooling', '1716096371desktop1.jpg', 1, 4, 1, 1, 1, 0, 5, 2, 1, 2500, 4600, 1, 'Hot', '2024-05-19 05:26:11', 3000),
(46, 'JDevT XloTLS666', 'Windows 11 Home, Intel Core i9-14900KF CPU, ASUS Z790 WiFi MB, GeForce RTX 4070 SUPER 12GB GPU, 32GB DDR5-6000MHz RGB RAM, 2TB M.2 NVMe SSD, iBUYPOWER 360mm RGB Liquid Cooling', '1716096393desktop3.jpg', 1, 5, 1, 1, 1, 0, 3, 2, 1, 6000, 3950, 1, 'Hot', '2024-05-19 05:26:33', 22),
(47, 'JDevT XloTLS666', 'This is some description.', '1716107588corsaircase1.jpg', 1, 7, 2, 2, 2, 2, 27, 2, 1, 6000, 4106, 0, 'New', '2024-05-19 08:33:08', 22);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(150) NOT NULL,
  `percent` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `time_limited` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `brand` varchar(150) NOT NULL,
  `storage_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `interface` varchar(150) NOT NULL,
  `capacity` int(11) NOT NULL,
  `capacity_format` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`id`, `brand`, `storage_name`, `img`, `interface`, `capacity`, `capacity_format`, `price`, `link`) VALUES
(1, '17', 'Crucial T500 1TB PCIe Gen4 NVMe M.2 SSD', '1702891789crucialT500ssd.png', 'PCIe', 1, 'TB', 70, 'https://www.crucial.com/ssd/t500/ct1000t500ssd5'),
(2, '14', 'AORUS Gen4 7300 SSD 1TB', '1702891769AORUSGen47300SSD1TB.png', 'SATA', 1, 'TB', 80, 'https://www.gigabyte.com/SSD/AORUS-Gen4-7300-SSD-1TB#kf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `subscribed` tinyint(4) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone1`, `phone2`, `address`, `avatar`, `subscribed`, `is_admin`) VALUES
(5, 'HakuHaku123', '$2y$10$1VjCaFDTAPKn7plV8towpO69zUZRQZ4q/PXFfkYqfftKmGq1se7by', 'thulinshan1234@gmail.com', '123123123', '123123123', '', '1701924974profile4.png', 0, 0),
(6, 'admin', '$2y$10$IFw17e309zcYQ2wAaOYJVO3D5a5u7kESMcxe71q9WbFM/oPY8gq5y', 'admin@gmail.com', '123123123', '123123123', '', '1701928854thumbnail1x1.png', 0, 1),
(7, 'test', '$2y$10$3FCmW/2Ofsc0sOOooPPCpeVmnIKPaZj5aV85gMleUHkUgagwVbZdm', 'test@test.com', '123123123', '222222222', 'somewhere', '170248177313a2b2437efba06fdc41bad5119f9782.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coming_soon`
--
ALTER TABLE `coming_soon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cooler`
--
ALTER TABLE `cooler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desktop_case`
--
ALTER TABLE `desktop_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memory`
--
ALTER TABLE `memory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motherboard`
--
ALTER TABLE `motherboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operating_system`
--
ALTER TABLE `operating_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular`
--
ALTER TABLE `popular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_supply`
--
ALTER TABLE `power_supply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prebuilt`
--
ALTER TABLE `prebuilt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coming_soon`
--
ALTER TABLE `coming_soon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cooler`
--
ALTER TABLE `cooler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `desktop_case`
--
ALTER TABLE `desktop_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gpu`
--
ALTER TABLE `gpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `memory`
--
ALTER TABLE `memory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motherboard`
--
ALTER TABLE `motherboard`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `operating_system`
--
ALTER TABLE `operating_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `popular`
--
ALTER TABLE `popular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts_comments`
--
ALTER TABLE `posts_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `power_supply`
--
ALTER TABLE `power_supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prebuilt`
--
ALTER TABLE `prebuilt`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
