CREATE DATABASE IF NOT EXISTS `cookbook` DEFAULT CHARSET=utf8;
USE `cookbook`;

DROP TABLE IF EXISTS `recipes`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `role`) VALUES
(1, 'chef', 'chef@cookbook.local', 'admin'),
(2, 'guest', 'guest@cookbook.local', 'user');

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `text` text NOT NULL,
  `servings` int(11) NOT NULL DEFAULT 1,
  `calories_per_serving` int(11) NOT NULL DEFAULT 0,
  `cook_time` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recipes` (`author_id`, `name`, `ingredients`, `text`, `servings`, `calories_per_serving`, `cook_time`) VALUES
(1, 'Классический борщ',
 "Свёкла — 2 шт\nКартофель — 4 шт\nКапуста — 300 г\nМорковь — 1 шт\nЛук — 1 шт\nГовядина — 400 г",
 "Сварить мясной бульон.\nДобавить картофель и капусту.\nСделать зажарку из свёклы, моркови и лука.\nСоединить, варить 15 минут, дать настояться.",
 6, 180, 90),
(1, 'Сырники',
 "Творог — 500 г\nЯйцо — 1 шт\nМука — 4 ст. л.\nСахар — 2 ст. л.\nСоль — щепотка",
 "Смешать творог, яйцо, сахар и муку.\nСформировать сырники.\nОбжарить на среднем огне до румяной корочки.",
 4, 250, 25),
(1, 'Овощной салат',
 "Огурцы — 2 шт\nПомидоры — 2 шт\nПерец — 1 шт\nЗелень\nОливковое масло",
 "Нарезать овощи кубиками.\nДобавить зелень.\nЗаправить оливковым маслом, посолить.",
 2, 120, 10),
(1, 'Куриный суп с лапшой',
 "Курица — 500 г\nЛапша — 150 г\nМорковь — 1 шт\nЛук — 1 шт\nКартофель — 3 шт",
 "Сварить бульон из курицы.\nДобавить картофель и зажарку.\nЗа 7 минут до готовности всыпать лапшу.",
 5, 160, 60);
