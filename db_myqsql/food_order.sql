-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 19, 2025 lúc 07:00 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food_order`
--
CREATE DATABASE IF NOT EXISTS `food_order` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `food_order`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`) VALUES
(15, 'quang', 'quangn30', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(17, 'Món nước', 'Food_Category_738.jpg', 'Yes', 'Yes'),
(18, 'Cơm', 'Food_Category_794.jpg', 'Yes', 'Yes'),
(19, 'Fast food', 'Food_Category_854.jpg', 'No', 'Yes'),
(20, 'Drinks', 'Food_Category_109.jpg', 'Yes', 'Yes'),
(21, 'Đồ ăn vặt', 'Food_Category_879.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(16, 'Chicken Set 1', '3 miếng gà', 4.00, 'Food_Name_3450.jpg', 19, 'Yes', 'Yes'),
(17, 'Chicken set 2', '5 miếng gà + 1 khoai + 1 nước', 6.00, 'Food_Name_3314.jpg', 19, 'Yes', 'Yes'),
(18, 'Chicken set 3', '8 miếng gà + 2 khoai + 2 nước', 9.50, 'Food_Name_6070.jpg', 19, 'No', 'Yes'),
(19, 'Fried', '1 khoai chiên', 1.00, 'Food_Name_761.jpg', 19, 'No', 'Yes'),
(20, 'Pepsi', 'Pepsi lon 350ml', 0.50, 'Food_Name_9116.jpg', 20, 'No', 'Yes'),
(21, 'Onion ring', '1 hành chiên', 1.50, 'Food_Name_9901.jpg', 19, 'No', 'Yes'),
(22, 'Phở gà', 'Phở gà top 1 Việt Nam', 1.25, 'Food_Name_1177.jpg', 17, 'Yes', 'Yes'),
(23, 'Gà sốt cay', '1 gà sốt cay', 4.00, 'Food_Name_7054.jpg', 19, 'No', 'Yes'),
(24, 'Bún bò', '1 phần bún bò', 1.50, 'Food_Name_7416.jpg', 17, 'Yes', 'Yes'),
(25, 'Bún riêu cua', '1 phần bún riêu cua', 1.50, 'Food_Name_9211.jpg', 17, 'No', 'Yes'),
(26, 'Cơm gà nướng', '1 phần cơm gà nướng', 2.00, 'Food_Name_1944.jpg', 18, 'Yes', 'Yes'),
(27, 'Cơm sườn bì chả', '1 phần cơm sườn nướng, bì, chả, trứng', 2.50, 'Food_Name_8075.jpg', 18, 'No', 'Yes'),
(28, 'Burger', '1 burger bò phô mai', 1.50, 'Food_Name_8455.jpg', 19, 'Yes', 'Yes'),
(29, 'Phở bò', '1 phần phở bò gia truyền Nam Định', 1.50, 'Food_Name_6495.jpg', 17, 'No', 'Yes'),
(30, 'Nước dứa', '1 chai nước dứa 500ml', 0.75, 'Food_Name_153.jpg', 20, 'Yes', 'Yes'),
(31, 'Nước chanh leo', '1 chai nước chanh leo 500ml', 0.75, 'Food_Name_7218.jpg', 20, 'Yes', 'Yes'),
(32, 'Ramen', '1 phần ramen', 2.00, 'Food_Name_2822.jpg', 17, 'Yes', 'Yes'),
(33, 'Cookies', '1 hộp cookies 500gr', 3.00, 'Food_Name_7371.jpg', 21, 'Yes', 'Yes'),
(34, 'Khô gà lá chanh', '1 hộp khô gà lá chanh 500gr', 3.50, 'Food_Name_7131.jpg', 21, 'No', 'Yes'),
(35, 'Khô bò', '1 hộp khô bò 500gr', 3.50, 'Food_Name_2096.jpg', 21, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) DEFAULT NULL,
  `price` decimal(10,6) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(10,6) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(2, 'Ab rerum laudantium', 613.000000, 2, 1226.000000, '2025-02-16 07:31:37', 'Ordered', 'Francesca Sheppard', '+1 (196) 694-5008', 'ryjepuluxu@mailinator.com', 'Qui pariatur Fugiat'),
(3, 'Ab rerum laudantium', 613.000000, 2, 1226.000000, '2025-02-16 07:33:10', 'Cancelled', 'Silas Davis', '+1 (177) 991-2189', 'pymopukil@mailinator.com', 'Qui vel beatae quia '),
(4, 'Ab rerum laudantium', 613.000000, 1, 613.000000, '2025-02-16 07:33:52', 'Delivered', 'Derek Stokes', '+1 (889) 671-1921', 'dicade@mailinator.com', 'Saepe dolores labore'),
(5, 'Officia occaecat id ', 526.000000, 2, 1052.000000, '2025-02-16 07:34:11', 'Delivered', 'Vanna Webster', '+1 (895) 217-4744', 'zusib@mailinator.com', 'Qui tenetur dolor iu'),
(6, 'Phở gà', 1.250000, 5, 6.250000, '2025-02-19 06:49:47', 'Delivered', 'Duc Quang', '1231231232', '123@gmail.com', 'nhà 3 ngõ 4 phố y quận e'),
(7, 'Pepsi', 0.500000, 20, 10.000000, '2025-02-19 06:52:16', 'Delivered', 'Eaton Moody', '+1 (995) 665-5466', 'wikisoce@mailinator.com', 'Eaque quo autem aut '),
(8, 'Cơm sườn bì chả', 2.500000, 4, 10.000000, '2025-02-19 06:53:12', 'Delivered', 'Teagan Morris', '+1 (196) 839-5029', 'habi@mailinator.com', 'Perferendis soluta i'),
(9, 'Chicken Set 1', 4.000000, 3, 12.000000, '2025-02-19 06:55:25', 'Ordered', 'Buffy Booker', '+1 (553) 879-5673', 'fupopofi@mailinator.com', 'Fuga Natus duis est'),
(10, 'Cơm gà nướng', 2.000000, 2, 4.000000, '2025-02-19 06:55:32', 'Ordered', 'Paul Fry', '+1 (209) 951-8973', 'jecy@mailinator.com', 'Minim ut do lorem no'),
(11, 'Nước dứa', 0.750000, 6, 4.500000, '2025-02-19 06:55:41', 'Ordered', 'Bethany Freeman', '+1 (541) 925-7247', 'nonojipu@mailinator.com', 'Dolor incididunt qui'),
(12, 'Cookies', 3.000000, 10, 30.000000, '2025-02-19 06:56:06', 'Ordered', 'Benedict Russell', '+1 (314) 855-7613', 'suqobo@mailinator.com', 'Excepteur ut recusan'),
(13, 'Chicken set 2', 6.000000, 2, 12.000000, '2025-02-19 06:56:31', 'Delivered', 'Eaton Decker', '+1 (705) 697-7271', 'xecoridik@mailinator.com', 'Obcaecati nostrud ve'),
(14, 'Chicken set 2', 6.000000, 25, 150.000000, '2025-02-19 06:56:51', 'Delivered', 'Driscoll Gonzalez', '+1 (238) 362-9973', 'gofevigoju@mailinator.com', 'Distinctio Ut dolor'),
(15, 'Nước chanh leo', 0.750000, 1, 0.750000, '2025-02-19 06:57:33', 'Ordered', 'Jakeem Chen', '+1 (652) 795-1209', 'sabelyce@mailinator.com', 'Pariatur Magna nisi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `birthday` date NOT NULL,
  `hire_date` date NOT NULL,
  `years_of_service` decimal(10,1) UNSIGNED NOT NULL,
  `wage` decimal(10,1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`id`, `fullname`, `phone_number`, `age`, `birthday`, `hire_date`, `years_of_service`, `wage`) VALUES
(2, 'Lacota Long', '+1 (462) 517-8261', 12, '2012-07-02', '2016-01-13', 9.1, 1000.0),
(3, 'Ora Williams', '+1 (215) 354-9594', 8, '2016-12-06', '2012-09-17', 12.4, 76.0),
(4, 'Odette Quinn', '+1 (429) 437-7789', 53, '1971-07-27', '2001-09-19', 23.4, 29.0),
(5, 'Erich Mcleod', '+1 (843) 585-9086', 38, '1986-10-13', '2010-02-02', 15.0, 79.0),
(6, 'Rylee Woodard', '+1 (283) 619-5017', 19, '2005-11-10', '1977-06-13', 47.7, 31.0),
(7, 'Hilel Rice', '+1 (449) 806-8014', 9, '2015-04-09', '2012-05-22', 12.7, 61.0),
(8, 'Gareth Hebert', '+1 (453) 153-7465', 1, '2023-03-04', '2008-06-05', 16.7, 47.0),
(9, 'Jessamine Schroeder', '+1 (972) 454-5644', 6, '2018-03-15', '1984-10-17', 40.3, 44.0),
(10, 'Brianna Lang', '+1 (176) 147-7025', 12, '2012-11-03', '2021-04-10', 3.8, 76.0),
(11, 'Ross Rowland', '+1 (972) 196-5707', 28, '1996-11-24', '2010-10-23', 14.3, 22.0),
(12, 'Sheila Castaneda', '+1 (113) 304-7743', 16, '2008-09-15', '2024-02-21', 0.9, 38.0),
(13, 'Alika Eaton', '+1 (387) 664-6018', 20, '2004-07-18', '2016-05-27', 8.7, 5.0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__category` (`category_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `FK__category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
