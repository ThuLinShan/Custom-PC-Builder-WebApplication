-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 03:28 PM
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
(12, 'NA', 'secondary 2 testing(500x500)', '1718508259HuTao1.jpg', '2024-05-25 17:02:07', 'secondary', 'sub', 1),
(13, 'NA', 'secondary 3testing (500x500)', '1717345164Hutao4.jpg', '2024-05-25 17:02:25', 'secondary', 'mini1', 1),
(14, 'NA', 'secondary4 testing (400x200)', '17173452485424073.jpg', '2024-05-25 17:02:39', 'secondary', 'mini2', 1),
(15, 'NA', 'secondary main (500x500)', '1718508234Hutao3.jpg', '2024-06-16 09:52:53', 'secondary', 'main', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(15) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `author` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `is_featured` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `header`, `description`, `date`, `author`, `img`, `is_featured`) VALUES
(1, 'Building Your Own PC: A Comprehensive Guide', '&lt;h5&gt;Building Your Own PC: A Comprehensive Guide&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Building your own PC can be one of the most rewarding projects you undertake. Not only does it allow for customization to meet your specific needs, but it also offers a deeper understanding of the inner workings of computers. Whether you&#039;re looking to save money, customize your rig for gaming, or simply enjoy the process of building, this guide will walk you through the essentials.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Understanding Your Needs&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Before diving into the hardware, it&rsquo;s crucial to identify what you want from your PC. Are you building a high-end gaming rig, a workhorse for video editing, or a simple machine for everyday tasks? Your requirements will dictate your budget and the components you&#039;ll need.\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Gaming:&lt;/strong&gt; High-end graphics card (GPU), fast processor (CPU), ample RAM, SSD for quick load times.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Content Creation:&lt;/strong&gt; Powerful CPU, substantial RAM, high-capacity storage (preferably SSD), good GPU for rendering.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;General Use:&lt;/strong&gt; Moderate CPU, integrated graphics or budget GPU, standard RAM, sufficient storage.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Choosing the Components&lt;/h5&gt;\r\n&lt;h5&gt;CPU (Central Processing Unit)&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The CPU is the brain of your computer. Brands like Intel and AMD offer a variety of processors catering to different needs and budgets. For gaming and high-performance tasks, look at Intel&rsquo;s Core i5/i7/i9 or AMD&rsquo;s Ryzen 5/7/9 series.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Motherboard&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The motherboard is the backbone that connects all your components. Ensure compatibility with your chosen CPU. Key considerations include the socket type (e.g., LGA for Intel, AM4 for AMD), form factor (ATX, Micro-ATX, Mini-ITX), and features like RAM slots, PCIe slots, and connectivity options.\r\n&lt;/p&gt;\r\n&lt;h5&gt;RAM (Random Access Memory)&lt;/h5&gt;\r\n&lt;p&gt;\r\n    RAM is crucial for multitasking and overall system speed. For gaming and content creation, 16GB is the minimum, with 32GB being ideal for heavy multitasking and professional workloads. Ensure your motherboard supports the RAM type (DDR4 or DDR5).\r\n&lt;/p&gt;\r\n&lt;h5&gt;Storage&lt;/h5&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;SSD (Solid State Drive):&lt;/strong&gt; Faster and more reliable than traditional hard drives. An NVMe SSD is preferable for the operating system and frequently used programs.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;HDD (Hard Disk Drive):&lt;/strong&gt; Good for mass storage of large files at a lower cost per gigabyte.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;GPU (Graphics Processing Unit)&lt;/h5&gt;\r\n&lt;p&gt;\r\n    A dedicated GPU is essential for gaming and graphic-intensive tasks. Nvidia and AMD are the leading manufacturers. For high-end gaming, look at the Nvidia RTX 30 series or AMD Radeon RX 6000 series.\r\n&lt;/p&gt;\r\n&lt;h5&gt;PSU (Power Supply Unit)&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The PSU powers all your components. It&rsquo;s important to choose a reliable unit with sufficient wattage. Calculate your total power consumption and add a margin for future upgrades. Look for a PSU with an 80 Plus certification for better efficiency.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Case&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The case houses all your components and affects cooling and expandability. Choose a case that fits your motherboard (ATX, Micro-ATX, Mini-ITX) and has good airflow. Additional features like dust filters, cable management options, and aesthetic preferences (e.g., tempered glass side panels) are also important.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Cooling&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Good cooling is essential to maintain performance and longevity. This includes CPU coolers (air or liquid) and case fans. Some high-end builds might also require additional cooling solutions for the GPU and other components.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Peripherals&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Don&rsquo;t forget the peripherals: monitor, keyboard, mouse, and speakers or headphones. While these aren&#039;t part of the build itself, they are necessary for operation.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Assembling Your PC&lt;/h5&gt;\r\n&lt;h5&gt;Preparation&lt;/h5&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Workspace:&lt;/strong&gt; Clean, spacious, and well-lit area.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Tools:&lt;/strong&gt; Phillips-head screwdriver, anti-static wrist strap, thermal paste (if not pre-applied on the CPU cooler).&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Step-by-Step Assembly&lt;/h5&gt;\r\n&lt;ol&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install the CPU:&lt;/strong&gt; Place the CPU into the motherboard socket, aligning the notches correctly. Secure it with the retention arm.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install RAM:&lt;/strong&gt; Insert the RAM sticks into the designated slots, ensuring they click into place.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install the CPU Cooler:&lt;/strong&gt; Attach the cooler to the CPU, applying thermal paste if necessary. Secure it to the motherboard.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Mount the Motherboard:&lt;/strong&gt; Place the motherboard into the case and screw it into place using the standoffs.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install Storage:&lt;/strong&gt; Mount your SSD and HDD in their respective slots and connect them to the motherboard and PSU.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install GPU:&lt;/strong&gt; Insert the GPU into the PCIe slot and secure it with screws.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Connect PSU:&lt;/strong&gt; Attach the power cables to the motherboard, GPU, storage devices, and other components. Make sure all connections are secure.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Install Case Fans:&lt;/strong&gt; Attach any additional case fans for improved airflow.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Cable Management:&lt;/strong&gt; Tidy up the cables to ensure good airflow and a clean look.&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;h5&gt;First Boot and BIOS Setup&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Once everything is connected, it&#039;s time for the first boot:\r\n&lt;/p&gt;\r\n&lt;ol&gt;\r\n    &lt;li&gt;&lt;strong&gt;Power On:&lt;/strong&gt; Connect your monitor, keyboard, and mouse. Press the power button. If everything is connected correctly, the system should power on.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Enter BIOS:&lt;/strong&gt; Press the designated key (usually Del or F2) during the boot process to enter the BIOS. Check if all your components are recognized.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Set Boot Order:&lt;/strong&gt; Set your SSD as the primary boot device.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Save and Exit:&lt;/strong&gt; Save your settings and exit the BIOS.&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;h5&gt;Installing the Operating System&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Insert your OS installation media (USB or DVD) and follow the on-screen instructions to install the operating system. After installation, update your system and install necessary drivers for your GPU, motherboard, and other components.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Testing and Optimization&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Once your OS is installed, run some benchmarks and stress tests to ensure stability and performance. Programs like Prime95 for CPU stress testing, MemTest86 for RAM, and 3DMark for GPU benchmarking are useful tools.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Optimization Tips&lt;/h5&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Update Drivers:&lt;/strong&gt; Ensure all your drivers are up to date for the best performance.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Manage Startup Programs:&lt;/strong&gt; Disable unnecessary startup programs to speed up boot times.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Regular Maintenance:&lt;/strong&gt; Keep your system clean and free from dust. Monitor temperatures and ensure your cooling solutions are effective.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Conclusion&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Building your own PC can be a fulfilling experience, giving you a machine tailored to your needs and a greater appreciation for the technology. By carefully selecting components, methodically assembling your system, and optimizing its performance, you&rsquo;ll have a powerful and reliable PC that can serve you well for years to come. Whether for gaming, content creation, or general use, the journey of building your own PC is as rewarding as the end result.\r\n&lt;/p&gt;', '2024-06-16 04:22:57', 6, '17185155014x3(2).jpg', 0),
(3, 'The Symbiotic Relationship Between Motherboard Chipsets and CPUs', '\r\n&lt;h5&gt;Understanding Motherboard Chipsets and CPUs&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The motherboard chipset and CPU are fundamental components of any computer, playing a critical role in determining the system&#039;s performance, capabilities, and compatibility. This article will delve into the relationship between motherboards and CPUs, focusing on the significance of chipsets and how they affect your PC&#039;s functionality.\r\n&lt;/p&gt;\r\n&lt;h5&gt;What is a Motherboard Chipset?&lt;/h5&gt;\r\n&lt;p&gt;\r\n    A motherboard chipset is a collection of integrated circuits that manage data flow between the processor, memory, storage, and peripheral devices. Essentially, it acts as the communication hub and traffic controller of the motherboard, ensuring that data is routed efficiently and components work harmoniously together.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n    The chipset is divided into two main parts:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Northbridge:&lt;/strong&gt; This part of the chipset directly connects the CPU to high-speed components like RAM and the graphics card (GPU). It manages tasks that require high performance and speed.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Southbridge:&lt;/strong&gt; This component handles lower-speed peripherals, such as USB ports, SATA connections for storage devices, and audio systems. It facilitates communication between the CPU and various input/output devices.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n    In modern chipsets, the functionality of the Northbridge is often integrated directly into the CPU, while the Southbridge retains its role under different names like PCH (Platform Controller Hub) for Intel and FCH (Fusion Controller Hub) for AMD.\r\n&lt;/p&gt;\r\n&lt;h5&gt;The Role of Chipsets in PC Performance&lt;/h5&gt;\r\n&lt;p&gt;\r\n    The chipset significantly impacts your system&#039;s performance and expansion capabilities. Here are some key factors influenced by the chipset:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Compatibility:&lt;/strong&gt; Chipsets determine which CPUs are compatible with the motherboard. Each chipset supports specific processor generations and models. For example, Intel&#039;s Z590 chipset supports 10th and 11th Gen Intel Core processors.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Overclocking:&lt;/strong&gt; Certain chipsets, like Intel&#039;s Z-series and AMD&#039;s X-series, support overclocking, allowing users to push their CPUs beyond the standard specifications for enhanced performance.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Connectivity:&lt;/strong&gt; Chipsets dictate the number and type of expansion slots, USB ports, SATA ports, and PCIe lanes available. High-end chipsets offer more connectivity options, facilitating better expansion and upgrade potential.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Performance Features:&lt;/strong&gt; Advanced chipsets come with features like RAID support, faster data transfer rates, and better power management, contributing to overall system efficiency and performance.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Choosing the Right Chipset and CPU Combination&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Selecting the appropriate chipset and CPU combination is crucial for building a balanced and high-performing system. Here are some considerations:\r\n&lt;/p&gt;\r\n&lt;h5&gt;Intel Chipsets and CPUs&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Intel categorizes its chipsets into different series, each tailored for specific use cases:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Z-Series:&lt;/strong&gt; Designed for enthusiasts and gamers, these chipsets support overclocking and multiple GPU setups. The Z790 chipset, for instance, supports Intel&#039;s 13th Gen processors and offers extensive connectivity options.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;H-Series:&lt;/strong&gt; These chipsets provide a balance between performance and cost, suitable for mainstream users. They lack overclocking support but offer sufficient features for everyday computing and gaming.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;B-Series:&lt;/strong&gt; Targeted at budget-conscious users, these chipsets offer essential features without the premium extras. They are ideal for entry-level and mid-range builds.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n    When pairing an Intel CPU with a motherboard, ensure the socket type matches (e.g., LGA 1200 for 10th and 11th Gen processors) and the chipset supports the CPU&#039;s generation.\r\n&lt;/p&gt;\r\n&lt;h5&gt;AMD Chipsets and CPUs&lt;/h5&gt;\r\n&lt;p&gt;\r\n    AMD&rsquo;s chipset lineup is categorized similarly:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;X-Series:&lt;/strong&gt; These are high-end chipsets for enthusiasts and gamers, offering overclocking support and advanced features. The X670 chipset, for example, supports AMD&rsquo;s Ryzen 7000 series processors and boasts robust connectivity options.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;B-Series:&lt;/strong&gt; Balanced chipsets providing good performance and features at a mid-range price point. The B550 chipset supports PCIe 4.0 and is compatible with Ryzen 3000 and 5000 series processors.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;A-Series:&lt;/strong&gt; Budget-friendly chipsets for basic builds and everyday use, offering essential features without the extras found in higher-end chipsets.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n    For AMD systems, ensure the socket type (AM4 for most Ryzen CPUs) and chipset are compatible with the CPU generation you intend to use.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Future-Proofing Your Build&lt;/h5&gt;\r\n&lt;p&gt;\r\n    When selecting a motherboard and chipset, consider future-proofing to ensure your system remains relevant and upgradable. Opt for a chipset that supports the latest technologies, such as PCIe 4.0 or PCIe 5.0, USB 3.2, and NVMe storage. Additionally, check for BIOS update support to ensure compatibility with upcoming CPU generations.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Conclusion&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Understanding the relationship between motherboard chipsets and CPUs is essential for building a well-rounded and high-performing PC. By choosing the right combination, you can ensure compatibility, maximize performance, and future-proof your system. Whether you&#039;re a gamer, content creator, or casual user, the right chipset and CPU pair will significantly impact your computing experience.\r\n&lt;/p&gt;', '2024-06-16 05:15:45', 6, '17185149454x3.jpg', 0),
(4, 'Laptops vs. Desktop Computers: Making the Right Choice', '&lt;p&gt;\r\n    When it comes to choosing between a laptop and a desktop computer, it&#039;s essential to consider your specific needs, preferences, and usage scenarios. Both devices offer distinct advantages and disadvantages, catering to different lifestyles and work environments. This article explores the key differences between laptops and desktops, helping you make an informed decision based on your requirements.\r\n&lt;/p&gt;\r\n&lt;h5&gt;Laptops: Portability and Convenience&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Laptops are renowned for their portability and convenience, making them ideal for users who need to work or access their data on the go. Here are some key benefits of choosing a laptop:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Portability:&lt;/strong&gt; Laptops are compact and lightweight, allowing you to carry them anywhere easily. Whether you&#039;re a student moving between classes, a business professional traveling for meetings, or a digital nomad working remotely, the mobility of a laptop offers unparalleled convenience.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Space-Saving:&lt;/strong&gt; Laptops take up minimal space compared to desktop setups, making them suitable for small apartments, shared workspaces, or environments where desk space is limited.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Built-in Battery:&lt;/strong&gt; Most laptops come with a built-in battery that provides several hours of usage on a single charge. This feature is advantageous during power outages or when working in locations without readily available power outlets.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Integrated Components:&lt;/strong&gt; Modern laptops integrate essential components like a display, keyboard, touchpad, webcam, and speakers into a single unit, offering a streamlined user experience without the need for additional peripherals.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n    Despite these advantages, laptops also have limitations that may influence your decision:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Performance Constraints:&lt;/strong&gt; Due to their compact size and thermal limitations, laptops generally have less powerful hardware compared to desktop computers. High-performance tasks like video editing, gaming, or running resource-intensive software may be slower on a laptop.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Upgradability:&lt;/strong&gt; Upgrading components in a laptop, such as the CPU or GPU, is often limited or impossible compared to desktops, where components are more accessible and easier to replace.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Ergonomics:&lt;/strong&gt; Extended use of a laptop can lead to ergonomic issues like neck strain or discomfort due to the fixed screen and keyboard alignment. External monitors, keyboards, and ergonomic accessories can mitigate these issues but add to the overall setup complexity.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Desktop Computers: Power and Customizability&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Desktop computers, on the other hand, offer unparalleled power, customization options, and ergonomic benefits. Here are some reasons why you might choose a desktop:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Performance Powerhouse:&lt;/strong&gt; Desktops can accommodate high-performance CPUs, GPUs, and larger amounts of RAM, making them ideal for demanding tasks like gaming, 3D rendering, video editing, and software development.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Customizability:&lt;/strong&gt; Unlike laptops, desktops allow extensive customization and upgradeability. You can easily swap out components to upgrade performance or replace outdated parts without needing to replace the entire system.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Ergonomics:&lt;/strong&gt; Desktop setups can be optimized for ergonomics with adjustable monitors, keyboards, and chairs, reducing strain during long hours of use. This customization is crucial for maintaining comfort and productivity.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Cost-Effectiveness:&lt;/strong&gt; In the long run, desktops often provide better value for money in terms of performance per dollar spent. You can build a powerful desktop at a lower cost compared to an equivalent laptop.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n    However, desktops also have their drawbacks that may impact your decision:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Immobility:&lt;/strong&gt; Desktop computers are stationary and require a dedicated workspace with power outlets. They are not suitable for users who need to move frequently or work in multiple locations.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Space Requirements:&lt;/strong&gt; Desktop setups occupy more physical space than laptops, requiring a desk or dedicated area for setup. This can be challenging in small living spaces or shared environments.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Power Consumption:&lt;/strong&gt; Desktop computers consume more power than laptops, potentially leading to higher electricity bills over time. Energy-efficient components can mitigate this, but laptops generally offer better power efficiency.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Choosing the Right Device for You&lt;/h5&gt;\r\n&lt;p&gt;\r\n    To determine whether a laptop or desktop is suitable for your needs, consider the following factors:\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;Usage Scenarios:&lt;/strong&gt; Assess how you plan to use the computer. If mobility and portability are critical, a laptop may be the better choice. For intensive tasks requiring maximum performance and customization options, a desktop is preferable.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Budget:&lt;/strong&gt; Consider your budget and the value you place on performance, portability, and upgradeability. Desktops often offer better performance for the price, while laptops provide unmatched portability.&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;Long-Term Needs:&lt;/strong&gt; Think about your future needs. If you anticipate needing to upgrade hardware frequently or require mobility, factor this into your decision-making process.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;h5&gt;Conclusion&lt;/h5&gt;\r\n&lt;p&gt;\r\n    Both laptops and desktop computers have distinct advantages and are suited to different lifestyles and work environments. By weighing the pros and cons outlined in this article and assessing your specific requirements, you can make an informed decision that aligns with your computing needs and preferences.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n    Whether you prioritize portability, performance, or customization, choosing the right device ensures a productive and enjoyable computing experience.\r\n&lt;/p&gt;', '2024-06-16 07:13:35', 6, '17185220154x3(3).jpg', 1);

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
(6, 'admin@thu.com', '$2y$10$IFw17e309zcYQ2wAaOYJVO3D5a5u7kESMcxe71q9WbFM/oPY8gq5y', 'admin@gmail.com', '123123123', '123123123', '', '1701928854thumbnail1x1.png', 0, 1),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
