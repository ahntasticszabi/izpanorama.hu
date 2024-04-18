-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2024. Ápr 18. 14:43
-- Kiszolgáló verziója: 10.6.16-MariaDB-cll-lve-log
-- PHP verzió: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `zhzhhuwm_izpanorama`
--
CREATE DATABASE IF NOT EXISTS `izpanorama` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `izpanorama`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `answers`
--

CREATE TABLE `answers` (
  `aid` int(11) NOT NULL,
  `atid` int(11) NOT NULL,
  `auid` int(11) NOT NULL,
  `atext` text NOT NULL,
  `astatus` varchar(8) NOT NULL COMMENT 'Active, Archived',
  `adate` datetime NOT NULL,
  `aip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `cpid` int(11) NOT NULL,
  `cuid` int(11) NOT NULL,
  `ctext` text NOT NULL,
  `cdate` datetime NOT NULL,
  `cstatus` varchar(8) NOT NULL COMMENT 'Active, Archived',
  `chistory` varchar(255) NOT NULL,
  `cip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logging`
--

CREATE TABLE `logging` (
  `oid` int(11) NOT NULL,
  `olid` int(11) NOT NULL,
  `ourl` varchar(255) NOT NULL,
  `odate` datetime NOT NULL,
  `oip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `login`
--

CREATE TABLE `login` (
  `lid` int(11) NOT NULL,
  `luid` int(11) NOT NULL,
  `ldate` datetime NOT NULL,
  `lip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posts`
--

CREATE TABLE `posts` (
  `pid` int(11) NOT NULL,
  `puid` int(11) NOT NULL,
  `ppicture` varchar(50) NOT NULL,
  `ptitle` varchar(255) NOT NULL,
  `pstatus` varchar(8) NOT NULL DEFAULT 'Active' COMMENT 'Active, Archived',
  `pdate` datetime NOT NULL,
  `pip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `threads`
--

CREATE TABLE `threads` (
  `tid` int(11) NOT NULL,
  `tuid` int(11) NOT NULL,
  `ttitle` varchar(70) NOT NULL,
  `tsubtitle` varchar(100) NOT NULL,
  `ttext` text NOT NULL,
  `tstatus` varchar(8) NOT NULL COMMENT 'Active, Archived	',
  `tdate` datetime NOT NULL,
  `tip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `umail` varchar(255) NOT NULL,
  `upw` varchar(40) NOT NULL,
  `uprofilepic` varchar(50) NOT NULL,
  `ubio` varchar(40) NOT NULL,
  `udate` datetime NOT NULL,
  `ustatus` varchar(14) NOT NULL COMMENT 'Active, Deleted, Archived, Suspended ',
  `uperm` varchar(10) NOT NULL COMMENT 'Admin, User',
  `uip` varchar(40) NOT NULL,
  `ustrid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- A tábla indexei `logging`
--
ALTER TABLE `logging`
  ADD PRIMARY KEY (`oid`);

--
-- A tábla indexei `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`);

--
-- A tábla indexei `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pid`);

--
-- A tábla indexei `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`tid`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `logging`
--
ALTER TABLE `logging`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `login`
--
ALTER TABLE `login`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `posts`
--
ALTER TABLE `posts`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `threads`
--
ALTER TABLE `threads`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
