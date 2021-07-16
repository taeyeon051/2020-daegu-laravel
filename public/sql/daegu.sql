-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 21-07-16 11:57
-- 서버 버전: 10.1.40-MariaDB
-- PHP 버전: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `daegu`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_image` varchar(200) NOT NULL,
  `writer_name` varchar(100) NOT NULL,
  `target` varchar(20) NOT NULL,
  `create_date` date NOT NULL,
  `meeting_week` varchar(50) NOT NULL,
  `meeting_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `meetings`
--

INSERT INTO `meetings` (`id`, `book_name`, `book_image`, `writer_name`, `target`, `create_date`, `meeting_week`, `meeting_time`) VALUES
(1, '페인트', '페인트.jpg', '이희영', '초등학생', '2019-04-19', '월요일', '11:00~13:00'),
(2, '체리새우', '체리새우.jpg', '황영미', '초등학생', '2019-01-28', '화요일', '13:00~15:00'),
(3, '시간을 파는 상점', '시간을 파는 상점.jpg', '김선영', '초등학생', '2012-04-10', '수요일', '15:00~17:00'),
(4, '아몬드', '아몬드.jpg', '손원평', '초등학생', '2017-03-31', '목요일', '10:00~12:00'),
(5, '완득이', '완득이.jpg', '김려령', '초등학생', '2008-03-17', '금요일', '14:00~16:00'),
(6, '단편소설 베스트35', '단편소설 베스트35.jpg', '김형주', '중학생', '2015-07-13', '월요일', '11:00~13:00'),
(7, '그들도 아이였다', '그들도 아이였다.jpg', '김은우', '중학생', '2018-03-25', '화요일', '13:00~15:00'),
(8, '십대를 위한 실패수업', '십대를 위한 실패수업.jpg', '정화진', '중학생', '2019-06-12', '수요일', '15:00~17:00'),
(9, '중학국어 비문학 독해 한권으로 끝내기', '중학국어 비문학 독해 한권으로 끝내기.jpg', '정문경', '중학생', '2019-06-05', '목요일', '10:00~12:00'),
(10, '바다소', '바다소.jpg', '양태은', '중학생', '2018-06-10', '금요일', '14:00~16:00'),
(11, '선생님과 함께 읽는 우리 소설', '선생님과 함께 읽는 우리 소설.jpg', '권순긍', '고등학생', '2011-05-03', '월요일', '11:00~13:00'),
(12, '스프링벅', '스프링벅.jpg', '배유안', '고등학생', '2008-10-13', '화요일', '13:00~15:00'),
(13, '생각한다는것', '생각한다는것.jpg', '고병권', '고등학생', '2010-03-31', '수요일', '15:00~17:00'),
(14, '개똥 세개', '개똥 세개.jpg', '강수돌', '고등학생', '2013-07-30', '목요일', '10:00~12:00'),
(15, '아이는 사춘기 엄마는 성장기', '아이는 사춘기 엄마는 성장기.jpg', '이윤정', '고등학생', '2010-03-26', '금요일', '14:00~16:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `mdate` date NOT NULL,
  `mtime` time NOT NULL,
  `content` text NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userId` varchar(150) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPwd` varchar(150) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `student` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`userId`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
