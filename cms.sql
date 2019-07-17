-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Paź 2018, 18:00
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `com_id` int(3) NOT NULL,
  `com_post_id` int(3) NOT NULL,
  `com_author` varchar(255) NOT NULL,
  `com_email` varchar(255) NOT NULL,
  `com_content` text NOT NULL,
  `com_status` varchar(255) NOT NULL,
  `com_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`com_id`, `com_post_id`, `com_author`, `com_email`, `com_content`, `com_status`, `com_date`) VALUES
(14, 30, 'test', 'example@gmail.com', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. ', 'approved', '2018-10-05'),
(15, 30, 'example', 'example@gmail.com', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. ', 'approved', '2018-10-05'),
(16, 29, 'example', 'example@gmail.com', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. ', 'approved', '2018-10-05'),
(17, 33, 'example', 'example@gmail.com', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. ', 'disapproved', '2018-10-05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `session` varchar(256) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `online_users`
--

INSERT INTO `online_users` (`id`, `session`, `time`) VALUES
(9, 'etih19jk1g1me97s9of923sr85', 1538755212);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_img` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_com_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_img`, `post_content`, `post_tags`, `post_com_count`, `post_status`, `post_views`) VALUES
(29, 1, 'Post 1', 'test', '2018-10-05', 'abstract-business-code-270348.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. Vestibulum efficitur nulla quis leo ullamcorper laoreet. Donec est nisl, laoreet at arcu non, maximus facilisis ligula. Aenean vehicula diam sapien, at commodo nunc vulputate auctor. Praesent dignissim hendrerit vehicula. Vestibulum sit amet purus et quam bibendum tincidunt ac a velit. Morbi scelerisque sem in tristique molestie. Phasellus vehicula dui eget mi condimentum, eget aliquam ex egestas. Aenean mattis id magna scelerisque tempus.</p><p>Praesent quis elit ante. Donec lacinia sed lorem nec dignissim. Suspendisse a vehicula ligula. Nullam elit nisi, convallis sit amet erat vitae, rhoncus ullamcorper turpis. Morbi consequat sagittis risus eget varius. Maecenas eu nisi id nisi fermentum pharetra. Curabitur enim ex, ultrices eget finibus ac, vehicula a nisl. Morbi sapien ipsum, finibus sed malesuada nec, posuere nec eros. Suspendisse risus ex, molestie quis ligula vitae, mattis viverra lectus. Nulla rhoncus convallis mi ut laoreet. Pellentesque vehicula neque nec dui fermentum imperdiet. Fusce hendrerit neque quis volutpat fermentum.</p>', 'TEST, JS, JAVA, web', 1, 'published', 2),
(30, 1, 'Post2', 'test', '2018-10-05', 'abstract-art-artistic-327509.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. Vestibulum efficitur nulla quis leo ullamcorper laoreet. Donec est nisl, laoreet at arcu non, maximus facilisis ligula. Aenean vehicula diam sapien, at commodo nunc vulputate auctor. Praesent dignissim hendrerit vehicula. Vestibulum sit amet purus et quam bibendum tincidunt ac a velit. Morbi scelerisque sem in tristique molestie. Phasellus vehicula dui eget mi condimentum, eget aliquam ex egestas. Aenean mattis id magna scelerisque tempus.</p><p>Praesent quis elit ante. Donec lacinia sed lorem nec dignissim. Suspendisse a vehicula ligula. Nullam elit nisi, convallis sit amet erat vitae, rhoncus ullamcorper turpis. Morbi consequat sagittis risus eget varius. Maecenas eu nisi id nisi fermentum pharetra. Curabitur enim ex, ultrices eget finibus ac, vehicula a nisl. Morbi sapien ipsum, finibus sed malesuada nec, posuere nec eros. Suspendisse risus ex, molestie quis ligula vitae, mattis viverra lectus. Nulla rhoncus convallis mi ut laoreet. Pellentesque vehicula neque nec dui fermentum imperdiet. Fusce hendrerit neque quis volutpat fermentum.</p>', 'js, bootstrap', 2, 'published', 3),
(31, 1, 'Post 3', 'test', '2018-10-05', 'access-code-connection-1181467.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. Vestibulum efficitur nulla quis leo ullamcorper laoreet. Donec est nisl, laoreet at arcu non, maximus facilisis ligula. Aenean vehicula diam sapien, at commodo nunc vulputate auctor. Praesent dignissim hendrerit vehicula. Vestibulum sit amet purus et quam bibendum tincidunt ac a velit. Morbi scelerisque sem in tristique molestie. Phasellus vehicula dui eget mi condimentum, eget aliquam ex egestas. Aenean mattis id magna scelerisque tempus.</p><p>Praesent quis elit ante. Donec lacinia sed lorem nec dignissim. Suspendisse a vehicula ligula. Nullam elit nisi, convallis sit amet erat vitae, rhoncus ullamcorper turpis. Morbi consequat sagittis risus eget varius. Maecenas eu nisi id nisi fermentum pharetra. Curabitur enim ex, ultrices eget finibus ac, vehicula a nisl. Morbi sapien ipsum, finibus sed malesuada nec, posuere nec eros. Suspendisse risus ex, molestie quis ligula vitae, mattis viverra lectus. Nulla rhoncus convallis mi ut laoreet. Pellentesque vehicula neque nec dui fermentum imperdiet. Fusce hendrerit neque quis volutpat fermentum.</p>', 'tech, js', 0, 'deaft', 0),
(32, 2, 'Post 4', 'test', '2018-10-05', 'blank-business-composition-373076.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. Vestibulum efficitur nulla quis leo ullamcorper laoreet. Donec est nisl, laoreet at arcu non, maximus facilisis ligula. Aenean vehicula diam sapien, at commodo nunc vulputate auctor. Praesent dignissim hendrerit vehicula. Vestibulum sit amet purus et quam bibendum tincidunt ac a velit. Morbi scelerisque sem in tristique molestie. Phasellus vehicula dui eget mi condimentum, eget aliquam ex egestas. Aenean mattis id magna scelerisque tempus.</p><p>Praesent quis elit ante. Donec lacinia sed lorem nec dignissim. Suspendisse a vehicula ligula. Nullam elit nisi, convallis sit amet erat vitae, rhoncus ullamcorper turpis. Morbi consequat sagittis risus eget varius. Maecenas eu nisi id nisi fermentum pharetra. Curabitur enim ex, ultrices eget finibus ac, vehicula a nisl. Morbi sapien ipsum, finibus sed malesuada nec, posuere nec eros. Suspendisse risus ex, molestie quis ligula vitae, mattis viverra lectus. Nulla rhoncus convallis mi ut laoreet. Pellentesque vehicula neque nec dui fermentum imperdiet. Fusce hendrerit neque quis volutpat fermentum.</p>', 'business', 0, 'published', 0),
(33, 1, 'Post 5', 'test', '2018-10-05', 'code-coding-computer-574071.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices magna in eros pretium faucibus et eget dui. Quisque ultrices elementum malesuada. Sed varius metus urna, a facilisis odio elementum non. Vestibulum efficitur nulla quis leo ullamcorper laoreet. Donec est nisl, laoreet at arcu non, maximus facilisis ligula. Aenean vehicula diam sapien, at commodo nunc vulputate auctor. Praesent dignissim hendrerit vehicula. Vestibulum sit amet purus et quam bibendum tincidunt ac a velit. Morbi scelerisque sem in tristique molestie. Phasellus vehicula dui eget mi condimentum, eget aliquam ex egestas. Aenean mattis id magna scelerisque tempus.</p><p>Praesent quis elit ante. Donec lacinia sed lorem nec dignissim. Suspendisse a vehicula ligula. Nullam elit nisi, convallis sit amet erat vitae, rhoncus ullamcorper turpis. Morbi consequat sagittis risus eget varius. Maecenas eu nisi id nisi fermentum pharetra. Curabitur enim ex, ultrices eget finibus ac, vehicula a nisl. Morbi sapien ipsum, finibus sed malesuada nec, posuere nec eros. Suspendisse risus ex, molestie quis ligula vitae, mattis viverra lectus. Nulla rhoncus convallis mi ut laoreet. Pellentesque vehicula neque nec dui fermentum imperdiet. Fusce hendrerit neque quis volutpat fermentum.</p>', 'js, bootstrap', 1, 'published', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `us_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `us_pass` varchar(255) NOT NULL,
  `us_firstname` varchar(255) NOT NULL,
  `us_lastname` varchar(255) NOT NULL,
  `us_email` varchar(255) NOT NULL,
  `us_img` text NOT NULL,
  `us_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`us_id`, `username`, `us_pass`, `us_firstname`, `us_lastname`, `us_email`, `us_img`, `us_role`) VALUES
(7, 'test', '$1$BxLFRwKD$bLvwKBWf52yfaFD6yBq9f0', '', '', 'test@test.com', '', 'admin'),
(10, 'eddy', '$2y$12$wJ3oPJUHX8EMKFTrhTsSQOTwgp71.l9LJiU4cQYuL8MRZ3vju8bQ2', 'Edward', 'Norton', 'eddy@gmail.com', 'avatar.png', 'user'),
(11, 'sparrow', '$2y$12$1NV5wpqNwMc6UuCB8piLxu/fhABeR.lKPQti4JqwK12rDkolzpegW', 'Johnny', 'Depp', 'exaple@examle.com', 'avatar.png', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indeksy dla tabeli `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `us_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
