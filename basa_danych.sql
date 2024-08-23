-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 23 Sie 2024, 14:54
-- Wersja serwera: 10.11.6-MariaDB-0+deb12u1
-- Wersja PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_danych`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bank_account_number` varchar(32) NOT NULL,
  `NIP` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`id`, `name`, `bank_account_number`, `NIP`) VALUES
(1, 'Jan Kowalski', '10100125003603250056329856', '025612548'),
(2, 'Adam Nowak', '10365245698562365214877596', '2514632514'),
(3, 'Anna Kowalska', '10365214523698856954715624', '9586125485'),
(4, 'Joanna Nowak', '10652315249845621574583890', '5126485721'),
(5, 'Wiktor Januszewski', '12625398545146521462358547', '5214632541'),
(6, 'Karolina Pelc', '12625398545958621462358541', '2465876894'),
(7, 'Łukasz Serafin', '12625398545146521462352160', '9546821576'),
(8, 'Katarzyna Tereba', '12625398545146521435169872', '9451628057'),
(9, 'Piotr Wójcik', '12625398545146521498465365', '8541367209'),
(10, 'Elżbieta Wiśniewska', '12625398545146521423980620', '9458621745');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `gross_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `number`, `date`, `due_date`, `gross_total`) VALUES
(1, 1, 'FV 2024/08/22 - 1', '2024-08-22 12:31:14', '2024-08-28 12:31:14', 1591.51),
(2, 2, 'FV 2024/08/22 - 2', '2024-08-22 10:34:14', '2024-08-28 10:34:14', 369.9),
(3, 3, 'FV 2024/08/22 - 3', '2024-08-22 13:46:13', '2024-08-29 13:46:13', 129.99),
(4, 2, 'FV 2024/08/22 - 4', '2024-08-22 13:46:13', '2024-08-29 13:46:13', 2544.99),
(5, 2, 'FV 2024/08/12 - 1', '2024-08-12 15:02:57', '2024-08-19 15:02:57', 169.5),
(6, 4, 'FV 2024/08/23 - 1', '2024-08-23 13:46:13', '2024-09-01 14:47:35', 150),
(7, 7, 'FV 2024/08/23 - 1', '2024-08-23 13:46:13', '2024-09-01 14:47:35', 369.9),
(8, 9, 'FV 2024/08/23 - 3', '2024-08-23 14:52:45', '2024-09-01 14:52:45', 269),
(9, 10, 'FV 2024/08/23 - 4', '2024-08-23 14:53:15', '2024-08-23 14:53:15', 765.8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 'Telefon komórkowy', 1, 1510),
(2, 1, 'Etui na telefon', 1, 81.51),
(3, 2, 'Oprogramowanie Microsoft Office 2021', 1, 369.9),
(4, 3, 'Klawiatura', 3, 129.99),
(5, 4, 'Komputer stacjonarny', 1, 2544.99),
(6, 6, 'Podkładka chłodząca', 2, 150),
(7, 7, 'Microsoft Windows 11', 1, 369.9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_title` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `payment_date` datetime NOT NULL,
  `bank_number_for_payment` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `invoice_id`, `payment_title`, `amount`, `payment_date`, `bank_number_for_payment`) VALUES
(1, 1, 1, 'Opłata faktury nr FV 2024/08/22 - 1', 1591.51, '2024-08-22 12:51:48', '12100502630562154856232521'),
(2, 2, 2, 'Opłata faktury nr FV 2024/08/22 - 2', 369.9, '2024-08-20 12:51:48', '12100502630562154856232521'),
(3, 4, 0, 'Wpłata środków', 1500, '2024-08-22 14:59:28', '15652125418745965875621548'),
(4, 2, 0, 'Wpłata środków', 500, '2024-08-23 13:03:20', '12321565423259685475923651'),
(5, 7, 7, 'Opłata faktury FV 2024/08/23 - 1', 500, '2024-08-23 14:50:53', '15652125418745965859658412');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
