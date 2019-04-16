CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uid` int(11) NOT NULL,
  `uniqueid` TEXT NULL,
  `content` varchar(240) NOT NULL,
  `date` datetime NOT NULL
);