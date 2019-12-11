-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 11 月 07 日 14:15
-- サーバのバージョン： 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gomidahi`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gomidahi`
--

CREATE TABLE `gomidahi` (
  `ID` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date4` varchar(255) NOT NULL,
  `date5` varchar(255) NOT NULL,
  `date6` varchar(255) NOT NULL,
  `date7` varchar(255) NOT NULL,
  `date8` varchar(255) NOT NULL,
  `date9` varchar(255) NOT NULL,
  `date10` varchar(255) NOT NULL,
  `date11` varchar(255) NOT NULL,
  `date12` varchar(255) NOT NULL,
  `date1` varchar(255) NOT NULL,
  `date2` varchar(255) NOT NULL,
  `date3` varchar(255) NOT NULL,
  `biko` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gomidahi`
--

INSERT INTO `gomidahi` (`ID`, `name`, `time`, `date4`, `date5`, `date6`, `date7`, `date8`, `date9`, `date10`, `date11`, `date12`, `date1`, `date2`, `date3`, `biko`) VALUES
(1, '燃やすごみ', '午前8時30分まで', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '毎週月・木曜日', '年末特別収集日は12月30日、年始開始日は1月6日'),
(2, '雑誌・チラシ等', '午前8時30分まで', '10', '8', '5', '10', '7', '11', '9', '6', '11', '8', '5', '11', ''),
(3, '新聞紙・紙パック', '午前8時30分まで', '24', '22', '19', '24', '21', '25', '23', '20', '25', '22', '19', '25', ''),
(4, '段ボール', '午前8時30分まで', '3', '1,29', '26', '3,31', '28', '4', '2,30', '27', '4,29', '29', '26', '4', ''),
(5, 'ペットボトル（午前）', '午前8時30分まで', '17', '15', '12', '17', '14', '18', '16', '13', '18', '15', '12', '18', ''),
(6, 'ペットボトル（午後）', '午後0時30分まで', '3', '1,29', '26', '3,31', '28', '4', '2,30', '27', '4,30', '29', '26', '4', ''),
(7, 'カン', '午後0時30分まで', '17', '15', '12', '17', '14', '18', '16', '13', '18', '15', '12', '18', ''),
(8, 'ビン', '午後0時30分まで', '3', '1,29', '26', '3,31', '28', '4', '2,30', '27', '4,31', '29', '26', '4', ''),
(9, 'その他燃やさないごみ', '午後0時30分まで', '10,24', '8,22', '5,19', '10,24', '7,21', '11,25', '9,23', '6,20', '11,25', '8,22', '5,19', '11,25', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gomidahi`
--
ALTER TABLE `gomidahi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gomidahi`
--
ALTER TABLE `gomidahi`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
