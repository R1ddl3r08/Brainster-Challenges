-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 06:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `services_products`
--

CREATE TABLE `services_products` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `website_info_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_products`
--

INSERT INTO `services_products` (`id`, `description`, `image_url`, `website_info_id`) VALUES
(22, 'Description: Professional web development creating customized sites to boost your online presence. Expert team, latest technologies, dynamic designs. From simple pages to e-commerce platforms. Enhance visibility and engage your audience effectively. Focus on growth, we handle the technical aspects.', 'https://picsum.photos/300/200', 12),
(23, 'Description: Creative graphic design solutions that make your brand stand out. Our talented designers bring your ideas to life, delivering visually stunning and impactful designs. From logos to marketing materials, we craft unique and memorable visuals that resonate with your target audience. Enhance your brand identity and leave a lasting impression with our professional graphic design service.', 'https://picsum.photos/300/200', 12),
(24, 'Description: Compelling content that captivates and converts. Our skilled writers create engaging and informative content tailored to your specific needs. From website copy to blog articles, we craft well-researched and SEO-friendly content that drives organic traffic and boosts your online visibility. Establish your authority, connect with your audience, and achieve your content marketing goals with our expert content writing service.', 'https://picsum.photos/300/200', 12);

-- --------------------------------------------------------

--
-- Table structure for table `website_info`
--

CREATE TABLE `website_info` (
  `id` int(11) NOT NULL,
  `image_url` text DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `about_you` text DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `linkedin` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website_info`
--

INSERT INTO `website_info` (`id`, `image_url`, `title`, `subtitle`, `about_you`, `tel`, `location`, `type`, `description`, `linkedin`, `facebook`, `twitter`, `google`) VALUES
(12, 'https://picsum.photos/1920/540', 'TechCrafter Solutions', '\"Unlocking the Digital Potential\"', 'At TechCrafter Solutions, we are a dynamic team of creative minds and technical experts dedicated to providing comprehensive solutions in coding, design, and marketing. With a passion for innovation and a commitment to excellence, we strive to empower businesses and individuals by leveraging the power of technology.', '+38978261257', 'Macedonia', 'Services', 'TechCrafter Solutions is a leading technology company specializing in coding, design, and marketing solutions. With a passion for innovation and a focus on delivering exceptional results, we empower businesses to thrive in the digital age. Our team of skilled professionals combines technical expertise, artistic creativity, and strategic thinking to craft tailor-made solutions that drive growth and success.\r\n\r\nAs a trusted partner, we understand the unique challenges faced by businesses today. Our comprehensive suite of services encompasses web and mobile development, captivating design, and strategic marketing. Whether you need a stunning website, a user-friendly mobile app, eye-catching visuals, or a targeted marketing campaign, we have the knowledge and expertise to bring your vision to life.', 'https://www.linkedin.com/company/unavailable/', 'https://www.facebook.com/TechCrafterSolutions', 'https://twitter.com/TechCrafterSols', 'https://plus.google.com/+TechCrafterSolutions');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services_products`
--
ALTER TABLE `services_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `website_info_id` (`website_info_id`);

--
-- Indexes for table `website_info`
--
ALTER TABLE `website_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services_products`
--
ALTER TABLE `services_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `website_info`
--
ALTER TABLE `website_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services_products`
--
ALTER TABLE `services_products`
  ADD CONSTRAINT `services_products_ibfk_1` FOREIGN KEY (`website_info_id`) REFERENCES `website_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
