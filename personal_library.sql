/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : personal_library

 Target Server Type    : MariaDB
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 12/09/2019 08:08:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE,
  UNIQUE INDEX `uq_admin_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '$2y$10$0X7IUIwIbs1CadRQIIY.fuy6FPJkzEISQT35OOIgESQPf2WEHITrC');
INSERT INTO `admin` VALUES (2, 'tester', 'TestSifra1');

-- ----------------------------
-- Table structure for author
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author`  (
  `author_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `birth_year` int(4) NULL DEFAULT NULL,
  `death_year` int(4) NULL DEFAULT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`author_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES (3, 'Ajzak', 'Marion', 1981, 0, 'asdasd', 0);
INSERT INTO `author` VALUES (4, 'Agata', 'Kristi', 1890, 1976, 'Najtrazenija spisateljica na svetu: samo su Biblija i Sekspirove drame stampane u vise primeraka od njenih dela. Njene knjige na engleskom jeziku prodate su u vise od milijardu primeraka, a jos toliko prodateo je u prevodu na stotinak svetskih jezika.', 0);
INSERT INTO `author` VALUES (5, 'Test', 'Ovde', 1820, 1980, 'Ziveo bas dugo', 0);
INSERT INTO `author` VALUES (6, 'Testic', 'Testic', 3000, 2000, 'Alihaw3liya 23o98ayu23 liakher ao9982lu3y laihj liauy293pu aio;sjdl;ioa8u 2p39ualikjsd ', 0);
INSERT INTO `author` VALUES (7, 'Unos ', 'Kroz sajt', 2019, 2222, 'Testiranje wooohooo', 0);
INSERT INTO `author` VALUES (8, 'AAA', 'bbbb', 1, 13, '7331', 0);
INSERT INTO `author` VALUES (9, 'Agataa', 'Kroz sajt', 1111, 2222, 'Zivela bas dugo...', 0);
INSERT INTO `author` VALUES (10, 'Agataa', 'Olbina', 12, 6, 'khjfry ', 0);

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `book_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `original_name⁯` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `publisher_id` int(11) UNSIGNED NOT NULL,
  `publishing_year` int(4) NULL DEFAULT NULL,
  `pages` int(4) UNSIGNED NOT NULL,
  `isbn` bigint(14) NULL DEFAULT NULL,
  `language` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `front_page_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_hidden` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`book_id`) USING BTREE,
  INDEX `fk_book_publisher_id`(`publisher_id`) USING BTREE,
  CONSTRAINT `fk_book_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES (1, 'Ubistvo u Mesopotamiji', 'Murder in Mesopotamia', '                    Ejmi Lederan je jasno da se nešto zlokobno dešava na arheološkom nalazištu u iračkom gradu Hasanijehu – nešto što ima veze s „Lepom Luizom”, suprugom slavnog arheologa doktora Lajdnera. Za nekoliko dana nalazište će posetiti Herkul Poaro. Ali ako se u obzir uzmu Luizine zastrašujuće halucinacije i napetost koja vlada među članovima ekspedicije a koja postaje gotovo nepodnošljiva, Poaro bi mogao da stigne prekasno......\r\n                \r\n                ', 1, 1936, 280, 9788679284112, 'Srpski', '1.jpg', 1, 0);
INSERT INTO `book` VALUES (2, 'Vrela srca', 'Warm bodies', 'R je mladić koji prolazi kroz egzistencijalnu krizu – on je zombi. Amerika je uništena ratom i bezumnom glađu nemrtvih, međutim, R žudi za još nečim osim za ukusom krvi i mozgova. On nema sećanja, nema identitet ni puls, ali ima snove i pomalo se razlikuje od svog drugara, M-a. Možda i može da pojede nekog čoveka s vremena na vreme, ali se ipak radije vozi pokretnim stepenicama na\r\nnapuštenom aerodromu, sluša Sinatru u svom udobnom boingu 747 koji zove domom, ili skuplja suvenire sa ruina civilizacije. A onda upoznaje Džuli.\r\nIsprva njegov zarobljenik, ona unosi eksploziju boja u inače turoban i siv pejzaž koji ga okružuje i nešto u njemu počinje da se budi. Ne želi da pojede ovu devojku – iako deluje vrlo ukusno – želi da je zaštiti. Ova neobična veza imaće nezamislive posledice, a njihov svet lišen života i nade neće se promeniti bez borbe.\r\nStrašna, zabavna i iznenađujuće dirljiva, Vrela srca pripovedaju o tome kako je biti živ i o tome kako je biti mrtav, ali i o onoj nejasnoj,\r\nmaglovitoj liniji između te dve dimenzije.', 1, 2010, 240, 9788610000054, 'Srpski', '2.jpg', 0, 0);
INSERT INTO `book` VALUES (3, 'Zagonetni slucaj Stajlz', 'The Mysterious Affair At Styles', 'Odnedavno su u selu Stajlz Sent Meri počele da se dešavaju čudne stvari. Evelin, stalna družbenica stare gospođe Ingltorp izjurila je iz kuće mrmljajući nešto o „čoporu grabljivaca”. Nakon toga se atmosfera nekako promenila. Njeno prisustvo je nekad ulivalo sigurnost, a sad je vazduh prosto odisao sumnjom i nadolazećim zlom.\r\n\r\nRazbijena šoljica za kafu, mrlja od voska i leja s begonijama – to je Poarou bilo dovoljno da pokaže svoju sad već legendarnu moć rasuđivanja.', 1, 1920, 296, 9788679283276, 'Srpski', '3.jpg', 0, 0);
INSERT INTO `book` VALUES (4, 'Testiranje dodavanja kroz sql ssdf fesr sdf ser sdf ser ', 'Testing dodavanja sql', '                                                            Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc sql upita\r\n                \r\n                \r\n                ', 1, 2000, 69, 12345678912345, 'Belugansk', '4.jpg', 0, 1);
INSERT INTO `book` VALUES (5, 'Testiranje dodavanja', 'Testing dodavanje', '                                        Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc generalizovanog modela\r\n                \r\n                ', 2, 2000, 69, 12345678912345, 'Belugansk', NULL, 0, 0);
INSERT INTO `book` VALUES (6, 'Testiranje', 'Testing', '                                                                                                                                                                                                        Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc alikhwerliawhe\r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                ', 1, 3001, 134, 12345678912345, 'Oompa Loompaish', '6.jpg', 0, 0);
INSERT INTO `book` VALUES (7, 'asd', '', 'asd', 1, 1, 1, 78945612307894, 'asd', NULL, 0, 1);
INSERT INTO `book` VALUES (8, 'Goran', 'asd', '                                                                                likajwe laiwhje aklsjd alwihjd \r\n                \r\n                \r\n                \r\n                ', 1, 123, 123, 1234567891234, '123asd', NULL, 0, 0);
INSERT INTO `book` VALUES (9, 'Kroz sajt', 'asd', 'asd', 1, 1, 123, 78945612307894, 'asd', NULL, 0, 0);
INSERT INTO `book` VALUES (10, 'Daljina među nama', 'The distance between us', 'Jednog hladnog februarskog popodneva, Stela ugleda čoveka koji joj ide u susret londonskom ulicom. Godinama nije videla njegovo lice, ali ga prepoznaje istog časa. Ili bar misli da ga je prepoznala. Istovremeno, na drugoj strani sveta, u vreme proslave kineske Nove godine, Džejk shvata da gužva oko njega postaje opasna. To je trenutak kada i Džejk i Stela, ne znajući da ono drugo postoji, beže od svojih života: Džejk u potragu za mestom toliko zabačenim da ga nema ni na jednoj karti, a Stela na jedno odredište u Škotskoj – čiji značaj razume samo njena sestra Nina.  DALJINA MEÐU NAMA je roman o paralelnim životima, izgubljenim identitetima, o vezi među sestrama i tajnim silama prošlosti. Iznad svega, ovo je ljubavna priča o dvoje ljudi koji se nikada nisu sreli. Privlačna, pronicljiva i vešta, ovo je najbolja knjiga Megi O’Farel do sada.', 1, 2004, 286, 978867928411, 'srpski', NULL, 0, 0);
INSERT INTO `book` VALUES (22, 'awea', 'a23a', 'aweawe', 1, 321, 123, 78945612307894, '123asd', '22.jpg', 0, 0);
INSERT INTO `book` VALUES (23, 'Kroz sajt', 'The distance between us', '', 1, 3001, 134, 78945612307894, '123asd', '23.jpg', 0, 0);

-- ----------------------------
-- Table structure for book_author
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author`  (
  `book_author_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`book_author_id`) USING BTREE,
  INDEX `fk_book_author_book_id`(`book_id`) USING BTREE,
  INDEX `fk_book_author_author_id`(`author_id`) USING BTREE,
  CONSTRAINT `fk_book_author_author_id` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_book_author_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES (1, 1, 4);
INSERT INTO `book_author` VALUES (2, 2, 3);
INSERT INTO `book_author` VALUES (3, 3, 4);
INSERT INTO `book_author` VALUES (4, 1, 5);

-- ----------------------------
-- Table structure for book_genre
-- ----------------------------
DROP TABLE IF EXISTS `book_genre`;
CREATE TABLE `book_genre`  (
  `book_genre_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` int(11) UNSIGNED NOT NULL,
  `genre_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`book_genre_id`) USING BTREE,
  INDEX `fk_book_genre_book_id`(`book_id`) USING BTREE,
  INDEX `fk_book_genre_genre_id`(`genre_id`) USING BTREE,
  CONSTRAINT `fk_book_genre_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_book_genre_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book_genre
-- ----------------------------
INSERT INTO `book_genre` VALUES (1, 2, 1);
INSERT INTO `book_genre` VALUES (2, 1, 2);
INSERT INTO `book_genre` VALUES (3, 1, 3);
INSERT INTO `book_genre` VALUES (4, 3, 2);
INSERT INTO `book_genre` VALUES (5, 3, 4);

-- ----------------------------
-- Table structure for book_placement
-- ----------------------------
DROP TABLE IF EXISTS `book_placement`;
CREATE TABLE `book_placement`  (
  `book_placement_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` int(11) UNSIGNED NOT NULL,
  `bookshelf_id` int(11) UNSIGNED NOT NULL,
  `placed_at` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`book_placement_id`) USING BTREE,
  INDEX `fk_book_placement_book_id`(`book_id`) USING BTREE,
  INDEX `fk_book_placement_bookshelf_id`(`bookshelf_id`) USING BTREE,
  CONSTRAINT `fk_book_placement_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_book_placement_bookshelf_id` FOREIGN KEY (`bookshelf_id`) REFERENCES `bookshelf` (`bookshelf_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book_placement
-- ----------------------------
INSERT INTO `book_placement` VALUES (1, 2, 2, '2019-05-30 17:10:07', 0);
INSERT INTO `book_placement` VALUES (2, 1, 4, '2019-05-30 17:10:38', 0);
INSERT INTO `book_placement` VALUES (3, 3, 6, '2019-05-30 17:10:54', 0);
INSERT INTO `book_placement` VALUES (4, 1, 3, '2019-06-02 14:20:17', 0);
INSERT INTO `book_placement` VALUES (5, 1, 4, '2019-09-09 01:47:15', 0);
INSERT INTO `book_placement` VALUES (6, 2, 4, '2019-09-09 01:50:19', 0);
INSERT INTO `book_placement` VALUES (7, 3, 4, '2019-06-05 10:15:32', 0);
INSERT INTO `book_placement` VALUES (8, 3, 4, '2019-09-08 01:00:26', 1);
INSERT INTO `book_placement` VALUES (9, 1, 2, '2019-09-12 07:14:37', 1);
INSERT INTO `book_placement` VALUES (10, 2, 1, '2019-04-30 22:16:58', 1);

-- ----------------------------
-- Table structure for bookshelf
-- ----------------------------
DROP TABLE IF EXISTS `bookshelf`;
CREATE TABLE `bookshelf`  (
  `bookshelf_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` int(11) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`bookshelf_id`) USING BTREE,
  INDEX `fk_bookshelf_room_id`(`room_id`) USING BTREE,
  CONSTRAINT `fk_bookshelf_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bookshelf
-- ----------------------------
INSERT INTO `bookshelf` VALUES (1, 1, 0);
INSERT INTO `bookshelf` VALUES (2, 1, 0);
INSERT INTO `bookshelf` VALUES (3, 2, 0);
INSERT INTO `bookshelf` VALUES (4, 2, 0);
INSERT INTO `bookshelf` VALUES (5, 2, 0);
INSERT INTO `bookshelf` VALUES (6, 3, 0);
INSERT INTO `bookshelf` VALUES (7, 3, 0);
INSERT INTO `bookshelf` VALUES (8, 2, 0);
INSERT INTO `bookshelf` VALUES (9, 5, 0);

-- ----------------------------
-- Table structure for genre
-- ----------------------------
DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre`  (
  `genre_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`genre_id`) USING BTREE,
  UNIQUE INDEX `uq_category_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of genre
-- ----------------------------
INSERT INTO `genre` VALUES (1, 'Fantastika', 'Fantasy description goes here', 0);
INSERT INTO `genre` VALUES (2, 'Misterija', 'Opis ovde', 0);
INSERT INTO `genre` VALUES (3, 'Kriminalna fikcija', 'Stavidi ovde treci opis', 0);
INSERT INTO `genre` VALUES (4, 'Triler', 'Jos opisa', 0);
INSERT INTO `genre` VALUES (5, 'Tester', 'Tester kao nijedan pre', 0);
INSERT INTO `genre` VALUES (6, 'Oopsies', 'Daisiesies', 0);

-- ----------------------------
-- Table structure for publisher
-- ----------------------------
DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher`  (
  `publisher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(74) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `founding_year` int(4) NULL DEFAULT NULL,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`publisher_id`) USING BTREE,
  UNIQUE INDEX `uq_publisher_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of publisher
-- ----------------------------
INSERT INTO `publisher` VALUES (1, 'Vulkan', 'Serbia', 'Beograd', 2013, 0);
INSERT INTO `publisher` VALUES (2, 'Mladinska Knjiga BEOGRAD', 'Serbia', 'Beograd', 2005, 0);
INSERT INTO `publisher` VALUES (3, 'Testing publishing', 'Anctarctica', 'Igloos', 267, 0);
INSERT INTO `publisher` VALUES (4, 'Kroz sajt', 'Grcka', 'Atina', 2017, 0);

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room`  (
  `room_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`room_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO `room` VALUES (1, 'Prva vrata niz levi hodnik', 0);
INSERT INTO `room` VALUES (2, 'Prva vrata niz desni hodnik', 0);
INSERT INTO `room` VALUES (3, 'Druga vrata sa leve strane', 0);
INSERT INTO `room` VALUES (4, 'Uz zid ka plafonu', 0);
INSERT INTO `room` VALUES (5, 'Iza ulaznih vrata', 0);

SET FOREIGN_KEY_CHECKS = 1;
