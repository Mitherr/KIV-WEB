-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 24. říj 2017, 16:24
-- Verze serveru: 5.7.14
-- Verze PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `web_sem_final`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `access_rights`
--

CREATE TABLE `access_rights` (
  `id_access_rights` bigint(20) UNSIGNED NOT NULL,
  `access_right` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `access_rights`
--

INSERT INTO `access_rights` (`id_access_rights`, `access_right`) VALUES
(1, 'Autor'),
(2, 'Recenzent'),
(3, 'Administrátor');

-- --------------------------------------------------------

--
-- Struktura tabulky `articles`
--

CREATE TABLE `articles` (
  `id_articles` bigint(20) UNSIGNED NOT NULL,
  `article_title` text NOT NULL,
  `article_abstract` longtext NOT NULL,
  `article_pdf_name` varchar(100) NOT NULL,
  `article_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_published` tinyint(1) NOT NULL DEFAULT '0',
  `users_id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `articles`
--

INSERT INTO `articles` (`id_articles`, `article_title`, `article_abstract`, `article_pdf_name`, `article_date`, `article_published`, `users_id_user`) VALUES
(3, 'FAKE NEWS: UNOBSERVANT AUDIENCES ARE EASILY SWAYED', 'Fake news is everywhere. Science-related pseudo facts have taken over the gossip sites and social media. And we are only at the beginning of an uphill battle to set the record straight. In this contribution, Melissa Hoover, shares her investigation on how people\'s response to fake news makes it easier for such inaccurate stories to propagate at a rate that is way more important than fact-based news. And here is why... ', '690-2-FAKE NEWS: UNOBSERVANT AUDIENCES ARE EASILY SWAYED.pdf', '2017-10-23 13:45:13', 0, 2),
(9, 'THE IMPORTANCE OF ACCURATE ONLINE MEDICAL INFORMATION AND WHAT YOU CAN DO ABOUT IT', 'It is common for people to search for health information online. Indeed over 60% do so per year, and only 2% of them will use sites requiring payment. Searches range from specific questions about drugs and procedures, to how to interpret test results. More than half state that the information they found influenced a medical decision, and over a third don’t follow up their internet searches by consulting a doctor. The accuracy of free online medical information is therefore pretty important for public health. Of the competing free sources online, traffic to Wikipedia’s heath content is the highest (with only the American NIH coming close). And it’s not only the general public. Unsurprisingly, Wikipedia’s medical pages are used by 95% of medical students, but also over by half of practicing clinicians.', '582-2-THE IMPORTANCE OF ACCURATE ONLINE MEDICAL INFORMATION AND WHAT YOU CAN DO ABOUT IT.pdf', '2017-10-23 14:21:25', 0, 2),
(16, 'Adobe Lightroom je mrtev, ať žije Adobe Lightroom CC', 'Adobe končí s podporou licenční desktopové verze programu pro amatérské fotografy – Lightroomu 6. Veškerá péče vývojářů od této chvíle směruje ke stávající verzi CC a zcela nové plně cloudové variantě, které jsou založeny na předplatitelskému modelu.', '466-6-Adobe Lightroom je mrtev, ať žije Adobe Lightroom CC.pdf', '2017-10-24 10:53:04', 0, 6);

-- --------------------------------------------------------

--
-- Struktura tabulky `reviews`
--

CREATE TABLE `reviews` (
  `id_review` bigint(20) UNSIGNED NOT NULL,
  `review_text` longtext,
  `review_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `review_originality` int(11) DEFAULT NULL,
  `review_theme` int(11) DEFAULT NULL,
  `review_quality` int(11) DEFAULT NULL,
  `review_locked` tinyint(1) NOT NULL DEFAULT '0',
  `articles_id_articles` bigint(20) UNSIGNED NOT NULL,
  `users_id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `reviews`
--

INSERT INTO `reviews` (`id_review`, `review_text`, `review_date`, `review_originality`, `review_theme`, `review_quality`, `review_locked`, `articles_id_articles`, `users_id_user`) VALUES
(5, 'Skvěle napsané text má hlavu a patu ', '2017-10-23 14:03:25', 1, 1, 1, 1, 3, 3),
(6, 'Průměr mohlo by to být lepší ', '2017-10-23 14:03:27', 3, 3, 3, 1, 3, 4),
(7, 'Pěkne odfláknuté téma oničem kvalita tragická navíc okopírované', '2017-10-24 09:54:19', 5, 5, 5, 1, 3, 5),
(9, 'gramatické chyby', '2017-10-23 14:24:12', 1, 1, 5, 0, 9, 4),
(14, 'Celkem to ujde ale nevhodně zvolený jazyk', '2017-10-24 10:53:53', 1, 1, 3, 0, 16, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_registration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_banned` tinyint(1) DEFAULT '0',
  `access_rights_id_access_rights` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `user_email`, `user_password`, `user_registration_date`, `user_banned`, `access_rights_id_access_rights`) VALUES
(1, 'Petr Hlaváč', 'petr.hlavacc@gmail.com', '202cb962ac59075b964b07152d234b70', '2017-10-20 10:43:09', 0, 3),
(2, 'Autor', 'autor@autor.cz', '202cb962ac59075b964b07152d234b70', '2017-10-20 10:44:12', 0, 1),
(3, 'Recenzent1', 'recenzent@recenzent.cz', '202cb962ac59075b964b07152d234b70', '2017-10-20 10:44:12', 0, 2),
(4, 'Recenzent2', 'recenzent2@recenzent2.cz', '202cb962ac59075b964b07152d234b70', '2017-10-23 11:35:31', 0, 2),
(5, 'Recenzent3', 'recenzent3@recenzent3.cz', '202cb962ac59075b964b07152d234b70', '2017-10-23 13:42:01', 0, 2),
(6, 'Autor', 'autor2@autor2.cz', '202cb962ac59075b964b07152d234b70', '2017-10-24 10:51:33', 0, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `access_rights`
--
ALTER TABLE `access_rights`
  ADD PRIMARY KEY (`id_access_rights`),
  ADD UNIQUE KEY `id_access_rights_UNIQUE` (`id_access_rights`);

--
-- Klíče pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_articles`),
  ADD UNIQUE KEY `id_articles_UNIQUE` (`id_articles`),
  ADD KEY `fk_articles_users1_idx` (`users_id_user`);

--
-- Klíče pro tabulku `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD UNIQUE KEY `id_review_UNIQUE` (`id_review`),
  ADD KEY `fk_reviews_articles1_idx` (`articles_id_articles`),
  ADD KEY `fk_articles_users1_idx` (`users_id_user`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user_UNIQUE` (`id_user`),
  ADD KEY `fk_users_access_rights_idx` (`access_rights_id_access_rights`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `articles`
--
ALTER TABLE `articles`
  MODIFY `id_articles` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pro tabulku `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_users1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
