SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database name:
--
use ics325;
-- --------------------------------------------------------

--
-- Make sure to drop any redundant tables.
--

DROP TABLE IF EXISTS puzzle_words;
DROP TABLE IF EXISTS puzzles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS characters;
DROP TABLE IF EXISTS words;

-- --------------------------------------------------------
--
-- Table structure for table users
--

CREATE TABLE users (
  user_email varchar(100) COMMENT 'email address is the key',
  username varchar(50) NOT NULL COMMENT 'if the user doesn''t want to display the user name',
  user_password varchar(65) NOT NULL COMMENT 'for storing the password',
  id_verified tinyint(1) NOT NULL COMMENT '0 for false, 1 for true',
  activation_token varchar(25) NOT NULL  COMMENT 'for storing the activation code when the users register or forget password',
  role tinyint(1) NOT NULL COMMENT '0 for ADMIN, 1 for registered user',
  primary key (user_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table users
--

INSERT INTO users (user_email, username, user_password, id_verified, activation_token, role) VALUES
('fm2584uk@metrostate.edu', 'prashant', SHA1('password'), 1, '753951', 0),
('hp6449qy@metrostate.edu', 'tyler', SHA1('password'), 1, '1234', 0),
('test', 'test', 'test', 1, '751', 0),
('user', 'user', 'user', 1, '751433', 1);

-- --------------------------------------------------------
--
-- Table structure for table words
--

CREATE TABLE words (
  word_id int AUTO_INCREMENT,
  word_value varchar(75) NOT NULL COMMENT 'words that have been added',
  rep_id int NOT NULL COMMENT 'for storing the ID of the representative',
  primary key (word_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE words AUTO_INCREMENT=35;
ALTER TABLE words
  ADD CONSTRAINT rep_id_fk FOREIGN KEY (rep_id) REFERENCES words (word_id) ON UPDATE CASCADE;

--
-- Dumping data for table words
--

INSERT INTO words (word_id, word_value, rep_id) VALUES
(1, 'mutter', 1),
(2, 'mumble', 1),
(3, 'take', 3),
(4, 'remove', 3),
(5, 'atrocious', 5),
(6, 'bad', 5),
(7, 'archaic', 7),
(8, 'old', 7),
(9, 'commence', 9),
(10, 'begin', 9),
(11, 'number', 11),
(12, 'amount', 11),
(13, 'mat', 1),
(14, 'mad', 1),
(15, 'took', 3),
(16, 'run', 3),
(17, 'action', 5),
(18, 'bold', 5),
(19, 'arrow', 7),
(20, 'ocean', 7),
(21, 'come', 9),
(22, 'bargin', 9),
(23, 'numb', 11),
(24, 'aim', 11),
(25, 'no', 11),
(26, 'far', 5),
(27, 'hold', 5),
(28, 'jump', 7),
(29, 'pull', 7),
(30, 'queen', 9),
(31, 'stop', 9),
(32, 'xray', 11),
(33, 'yawn', 11),
(34, 'zoo', 11);

-- --------------------------------------------------------
--
-- Table structure for table characters
--

CREATE TABLE characters (
  word_id int,
  character_index tinyint NOT NULL,
  character_value varchar(7) NOT NULL,
  primary key (word_id, character_index, character_value)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE characters
  ADD CONSTRAINT word_id_fk FOREIGN KEY (word_id) REFERENCES words (word_id) ON UPDATE CASCADE;

INSERT INTO characters (word_id, character_index, character_value) VALUES
(1, 0, 'm'), (1, 1, 'u'), (1, 2, 't'), (1, 3, 't'), (1, 4, 'e'), (1, 5, 'r'),
(2, 0, 'm'), (2, 1, 'u'), (2, 2, 'm'), (2, 3, 'b'), (2, 4, 'l'), (2, 5, 'e'),
(3, 0, 't'), (3, 1, 'a'), (3, 2, 'k'), (3, 3, 'e'),
(4, 0, 'r'), (4, 1, 'e'), (4, 2, 'm'), (4, 3, 'o'), (4, 4, 'v'), (4, 5, 'e'),
(5, 0, 'a'), (5, 1, 't'), (5, 2, 'r'), (5, 3, 'o'), (5, 4, 'c'), (5, 5, 'i'), (5, 6, 'o'), (5, 7, 'u'), (5, 8, 's'),
(6, 0, 'b'), (6, 1, 'a'), (6, 2, 'd'),
(7, 0, 'a'), (7, 1, 'r'), (7, 2, 'c'), (7, 3, 'h'), (7, 4, 'a'), (7, 5, 'i'), (7, 6, 'c'),
(8, 0, 'o'), (8, 1, 'l'), (8, 2, 'd'),
(9, 0, 'c'), (9, 1, 'o'), (9, 2, 'm'), (9, 3, 'm'), (9, 4, 'e'), (9, 5, 'n'), (9, 6, 'c'), (9, 7, 'e'),
(10, 0, 'b'), (10, 1, 'e'), (10, 2, 'g'), (10, 3, 'i'), (10, 4, 'n'),
(11, 0, 'n'), (11, 1, 'u'), (11, 2, 'm'), (11, 3, 'b'), (11, 4, 'e'), (11, 5, 'r'),
(12, 0, 'a'), (12, 1, 'm'), (12, 2, 'o'), (12, 3, 'u'), (12, 4, 'n'), (12, 5, 't'),
(13, 0, 'm'), (13, 1, 'a'), (13, 2, 't'),
(14, 0, 'm'), (14, 1, 'a'), (14, 2, 'd'),
(15, 0, 't'), (15, 1, '0'), (15, 2, '0'), (15, 3, 'k'),
(16, 0, 'r'), (16, 1, 'u'), (16, 2, 'n'),
(17, 0, 'a'), (17, 1, 'c'), (17, 2, 't'), (17, 3, 'i'), (17, 4, 'o'), (17, 5, 'n'),
(18, 0, 'b'), (18, 1, '0'), (18, 2, 'l'), (18, 3, 'd'),
(19, 0, 'a'), (19, 1, 'r'), (19, 2, 'r'), (19, 3, 'o'), (19, 4, 'w'),
(20, 0, 'o'), (20, 1, 'c'), (20, 2, 'e'),(20, 3, 'a'), (20, 4, 'n'),
(21, 0, 'c'), (21, 1, 'o'), (21, 2, 'm'), (9, 3, 'e'), 
(22, 0, 'b'), (22, 1, 'a'), (22, 2, 'r'), (22, 3, 'g'), (22, 4, 'i'), (22, 5, 'n'),
(23, 0, 'n'), (23, 1, 'u'), (23, 2, 'm'), (23, 3, 'b'),
(24, 0, 'a'), (24, 1, 'i'), (24, 2, 'm'),
(25, 3, 'n'), (25, 1, 'o'),
(26, 0, 'f'), (26, 1, 'a'),(26, 2, 'r'),
(27, 0, 'h'), (27, 1, 'o'), (27, 2, 'l'), (27, 3, 'd'),
(28, 0, 'j'), (28, 1, 'u'), (28, 2, 'm'), (28, 3, 'p'),
(29, 0, 'p'), (29, 1, 'u'), (29, 2, 'l'), (29, 3, 'l'),
(30, 0, 'q'), (30, 1, 'u'), (30, 2, 'e'), (30, 3, 'e'), (30, 4, 'n'),
(31, 0, 's'), (31, 1, 't'), (31, 2, 'o'), (31, 3, 'p'),
(32, 0, 'x'), (32, 1, 'r'), (32, 2, 'a'), (32, 3, 'y'),
(33, 0, 'y'), (33, 1, 'a'), (33, 2, 'w'), (33, 3, 'n'),
(34, 0, 'z'), (34, 1, 'o'), (34, 2, 'o');

-- --------------------------------------------------------
--
-- Table structure for table puzzles
--

CREATE TABLE puzzles (
  puzzle_id int NOT NULL AUTO_INCREMENT,
  puzzle_name varchar(75) NOT NULL,
  creator_email varchar(100) NOT NULL,
  primary key (puzzle_id),
  key (creator_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE words AUTO_INCREMENT=3;
ALTER TABLE puzzles
  ADD CONSTRAINT creator_email_fk FOREIGN KEY (creator_email) REFERENCES users (user_email) ON UPDATE CASCADE;
--
-- Dumping data for table puzzles
--

INSERT INTO puzzles (puzzle_id, puzzle_name, creator_email) VALUES
(1, 'metro', 'fm2584uk@metrostate.edu'),
(2, 'nice', 'hp6449qy@metrostate.edu');

-- --------------------------------------------------------
--
-- Table structure for table puzzle_words
--

CREATE TABLE puzzle_words (
  puzzle_id int,
  word_id int,
  position_in_name tinyint,
  clue_id int,
  primary key (puzzle_id, word_id, position_in_name),
  FOREIGN KEY (word_id)
  REFERENCES words (word_id) ON UPDATE CASCADE,
  key (puzzle_id),
  key (word_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE puzzle_words
  ADD CONSTRAINT puzzle_id_fk FOREIGN KEY (puzzle_id) REFERENCES puzzles (puzzle_id) ON UPDATE CASCADE;
--
-- Dumping data for table puzzle_words
--
-- 'mutter,remove,atrocious,archaic,commence'
-- 'number,archaic,commence,remove'

INSERT INTO puzzle_words (puzzle_id, word_id, position_in_name, clue_id) VALUES
(1,1,0,1),
(1,4,1,1),
(1,5,2,1),
(1,7,3,1),
(1,9,4,1),
(2,11,0,1),
(2,7,1,1),
(2,9,2,1),
(2,4,3,1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
