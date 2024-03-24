-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yesbrew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_profile` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `username`, `admin_password`, `admin_profile`, `firstname`, `lastname`) VALUES
(1, 'Patrice', '$2y$10$oimgUSFzigs4c3ot3ycgUur0oei0vd4GeKGJLdTmqg4Ybn9ZdgVHO', 'admin.jpg', 'Patrice', 'Quitoles');

-- --------------------------------------------------------

--
-- Table structure for table `cart-details`
--

CREATE TABLE `cart-details` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart-details`
--

INSERT INTO `cart-details` (`cart_id`, `product_id`, `user_id`, `quantity`) VALUES
(76, 5, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(7, 'Hot'),
(8, 'Whipped'),
(9, 'Pastry'),
(12, 'Shake');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `product_image`, `product_price`, `date`, `status`) VALUES
(2, 'Urban Roast Ritual', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Urban, roastal, Ritual, Hot', 7, 'item1.png', '49', '2023-12-28 05:09:08', 'true'),
(4, 'Buttercloud Bites', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Buttercloud, Bites, Pastry', 9, 'item9.png', '120', '2023-12-28 05:30:03', 'true'),
(5, 'Morning Bliss', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Morning, Bliss', 8, 'item7.png', '69', '2023-12-28 06:03:07', 'true'),
(6, 'Brewed Elegance', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Brewed, Elegance', 7, 'item3.png', '39', '2023-12-28 06:04:21', 'true'),
(7, 'Cobblestone', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Cobblestone', 8, 'item6.png', '59', '2023-12-28 06:06:25', 'true'),
(8, 'Sugar Haven', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Sugar, Haven', 9, 'item10.png', '105', '2023-12-28 06:07:56', 'true'),
(12, 'Blueberry Burst', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Blueberry Burst', 9, 'item12.png', '79', '2024-01-22 09:07:16', 'true'),
(13, 'Choco-Whirl', 'Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laborum Assumenda Voluptates', 'Choco-Whirl', 12, 'item6.png', '55', '2024-01-22 09:08:52', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `total_product_sold`
--

CREATE TABLE `total_product_sold` (
  `sold_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_product_sold`
--

INSERT INTO `total_product_sold` (`sold_id`, `product_id`, `quantity`) VALUES
(1, 2, 3),
(2, 4, 2),
(3, 2, 2),
(4, 2, 1),
(5, 4, 1),
(6, 2, 1),
(7, 4, 2),
(8, 8, 1),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 26, 387, 415203654, 2, '2024-01-11 18:38:23', 'paid'),
(2, 26, 98, 1494867909, 1, '2024-01-11 18:46:04', 'paid'),
(3, 20, 169, 856841237, 2, '2024-01-18 01:31:11', 'paid'),
(4, 20, 289, 193965386, 2, '2024-01-19 04:50:13', 'paid'),
(5, 28, 105, 1274456382, 1, '2024-01-22 08:22:15', 'paid'),
(6, 30, 49, 1136472392, 1, '2024-01-22 08:51:08', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_fname`, `user_lname`, `user_name`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_number`) VALUES
(20, 'Marchel', 'Maugdang', 'marchel15', 'marchel@15', '$2y$10$hX8nFujArckrHakku59QYuZXTi24FQzCTDX5CHSFHKGkK0FXWxz/m', 'marchel.jpg', '', 'caloocan', '09422761723'),
(22, 'Griella', 'Autida', 'GriellaJane12', 'griella@tup', '$2y$10$ELaqCk4MgGD3FewvvxKRWO9meQ7g2pohdTCuwGoHeD9yKfFKyf3fG', 'griella.jpg', '', 'Pasay', '09639991259'),
(23, 'Brayan', 'Hufalar', 'Brayan09', 'Brayan@tup', '$2y$10$XVQEZqMLroPjISHjG/BVFO6tYSyvH/1yNID5F2hFueyLgUQkiOve6', 'brayan.jpg', '', 'Navotas', '098969186383'),
(24, 'Anthony', 'Lapada', 'Anthony22', 'Anthony@tup', '$2y$10$oyFP.akd1NokRd.DI4cO1uspOBVhy/fZAbk/OYvFN7fVPFhxvB9mm', 'anthony.jpg', '', 'tondo, manila', '09776240201'),
(25, 'Gabriel', 'Japson', 'Gab0567', 'Gabo@tup', '$2y$10$Md6/6jzGjxy8r3s8fF9FJeoA1zPN7Tn7MOaijC4Qx32OT3bMAibhe', 'gabo.jpg', '', 'Antipolo, Rizal', '09321979085'),
(26, 'Ron', 'Gunda', 'Ron_Caleb', 'ron.gunda@tup', '$2y$10$gMIkUezxtxnG.hIDgex0F.cZzAiOwl61838C3lozGo6ZGXRlhm.5e', 'Ron.JPG', '', 'Marawi', '09548332979'),
(30, 'chewy', 'quitoles', 'chewy01', 'chewy@tup', '$2y$10$F5ir5rPPPqcI9INReFM7refu8kqmf1RQwNYM4W3f4.4IvX5v7/c02', 'review2.png', '', '1086 karen ave.', '09127919278');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart-details`
--
ALTER TABLE `cart-details`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `total_product_sold`
--
ALTER TABLE `total_product_sold`
  ADD PRIMARY KEY (`sold_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart-details`
--
ALTER TABLE `cart-details`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `total_product_sold`
--
ALTER TABLE `total_product_sold`
  MODIFY `sold_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
