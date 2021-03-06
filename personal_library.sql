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
  `original_name???` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
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
INSERT INTO `book` VALUES (1, 'Ubistvo u Mesopotamiji', 'Murder in Mesopotamia', '                    Ejmi Lederan je jasno da se ne??to zlokobno de??ava na arheolo??kom nalazi??tu u ira??kom gradu Hasanijehu ??? ne??to ??to ima veze s ???Lepom Luizom???, suprugom slavnog arheologa doktora Lajdnera. Za nekoliko dana nalazi??te ??e posetiti Herkul Poaro. Ali ako se u obzir uzmu Luizine zastra??uju??e halucinacije i napetost koja vlada me??u ??lanovima ekspedicije a koja postaje gotovo nepodno??ljiva, Poaro bi mogao da stigne prekasno......\r\n                \r\n                ', 1, 1936, 280, 9788679284112, 'Srpski', '1.jpg', 1, 0);
INSERT INTO `book` VALUES (2, 'Vrela srca', 'Warm bodies', 'R je mladi?? koji prolazi kroz egzistencijalnu krizu ??? on je zombi. Amerika je uni??tena ratom i bezumnom gla??u nemrtvih, me??utim, R ??udi za jo?? ne??im osim za ukusom krvi i mozgova. On nema se??anja, nema identitet ni puls, ali ima snove i pomalo se razlikuje od svog drugara, M-a. Mo??da i mo??e da pojede nekog ??oveka s vremena na vreme, ali se ipak radije vozi pokretnim stepenicama na\r\nnapu??tenom aerodromu, slu??a Sinatru u svom udobnom boingu 747 koji zove domom, ili skuplja suvenire sa ruina civilizacije. A onda upoznaje D??uli.\r\nIsprva njegov zarobljenik, ona unosi eksploziju boja u ina??e turoban i siv pejza?? koji ga okru??uje i ne??to u njemu po??inje da se budi. Ne ??eli da pojede ovu devojku ??? iako deluje vrlo ukusno ??? ??eli da je za??titi. Ova neobi??na veza ima??e nezamislive posledice, a njihov svet li??en ??ivota i nade ne??e se promeniti bez borbe.\r\nStra??na, zabavna i iznena??uju??e dirljiva, Vrela srca pripovedaju o tome kako je biti ??iv i o tome kako je biti mrtav, ali i o onoj nejasnoj,\r\nmaglovitoj liniji izme??u te dve dimenzije.', 1, 2010, 240, 9788610000054, 'Srpski', '2.jpg', 0, 0);
INSERT INTO `book` VALUES (3, 'Zagonetni slucaj Stajlz', 'The Mysterious Affair At Styles', 'Odnedavno su u selu Stajlz Sent Meri po??ele da se de??avaju ??udne stvari. Evelin, stalna dru??benica stare gospo??e Ingltorp izjurila je iz ku??e mrmljaju??i ne??to o ?????oporu grabljivaca???. Nakon toga se atmosfera nekako promenila. Njeno prisustvo je nekad ulivalo sigurnost, a sad je vazduh prosto odisao sumnjom i nadolaze??im zlom.\r\n\r\nRazbijena ??oljica za kafu, mrlja od voska i leja s begonijama ??? to je Poarou bilo dovoljno da poka??e svoju sad ve?? legendarnu mo?? rasu??ivanja.', 1, 1920, 296, 9788679283276, 'Srpski', '3.jpg', 0, 0);
INSERT INTO `book` VALUES (4, 'Testiranje dodavanja kroz sql ssdf fesr sdf ser sdf ser ', 'Testing dodavanja sql', '                                                            Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc sql upita\r\n                \r\n                \r\n                ', 1, 2000, 69, 12345678912345, 'Belugansk', '4.jpg', 0, 1);
INSERT INTO `book` VALUES (5, 'Testiranje dodavanja', 'Testing dodavanje', '                                        Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc generalizovanog modela\r\n                \r\n                ', 2, 2000, 69, 12345678912345, 'Belugansk', NULL, 0, 0);
INSERT INTO `book` VALUES (6, 'Testiranje', 'Testing', '                                                                                                                                                                                                        Ovo je test sa kojim testiram dodavanje nove knjige uz pomoc alikhwerliawhe\r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                \r\n                ', 1, 3001, 134, 12345678912345, 'Oompa Loompaish', '6.jpg', 0, 0);
INSERT INTO `book` VALUES (7, 'asd', '', 'asd', 1, 1, 1, 78945612307894, 'asd', NULL, 0, 1);
INSERT INTO `book` VALUES (8, 'Goran', 'asd', '                                                                                likajwe laiwhje aklsjd alwihjd \r\n                \r\n                \r\n                \r\n                ', 1, 123, 123, 1234567891234, '123asd', NULL, 0, 0);
INSERT INTO `book` VALUES (9, 'Kroz sajt', 'asd', 'asd', 1, 1, 123, 78945612307894, 'asd', NULL, 0, 0);
INSERT INTO `book` VALUES (10, 'Daljina me??u nama', 'The distance between us', 'Jednog hladnog februarskog popodneva, Stela ugleda ??oveka koji joj ide u susret londonskom ulicom. Godinama nije videla njegovo lice, ali ga prepoznaje istog ??asa. Ili bar misli da ga je prepoznala. Istovremeno, na drugoj strani sveta, u vreme proslave kineske Nove godine, D??ejk shvata da gu??va oko njega postaje opasna. To je trenutak kada i D??ejk i Stela, ne znaju??i da ono drugo postoji, be??e od svojih ??ivota: D??ejk u potragu za mestom toliko zaba??enim da ga nema ni na jednoj karti, a Stela na jedno odredi??te u ??kotskoj ??? ??iji zna??aj razume samo njena sestra Nina.  DALJINA ME??U NAMA je roman o paralelnim ??ivotima, izgubljenim identitetima, o vezi me??u sestrama i tajnim silama pro??losti. Iznad svega, ovo je ljubavna pri??a o dvoje ljudi koji se nikada nisu sreli. Privla??na, pronicljiva i ve??ta, ovo je najbolja knjiga Megi O???Farel do sada.', 1, 2004, 286, 978867928411, 'srpski', NULL, 0, 0);
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
