
CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `pais` varchar(99) NOT NULL,
  `fronteira` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `paises` (`id`, `pais`, `fronteira`) VALUES
(1, 'Brasil', 'Argentina,Colômbia,Egito'),
(2, 'Argentina', 'Brasil,Colômbia'),
(3, 'Colômbia', 'Brasil,México'),
(4, 'México', 'Colômbia,EUA'),
(5, 'EUA', 'México,Rússia,Reino Unido'),
(6, 'Reino Unido', 'EUA,França,Alemanha'),
(7, 'França', 'Alemanha,Reino Unido,Egito'),
(8, 'Alemanha', 'França,Reino Unido,Egito,Rússia'),
(9, 'Egito', 'França,Alemanha,Brasil,África do Sul'),
(10, 'África do Sul', 'Egito'),
(11, 'Rússia', 'Alemanha,China,EUA'),
(12, 'China', 'Rússia');

CREATE TABLE `randnames` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `randnames` (`id`, `name`) VALUES
(1, 'Eric the Red'),
(2, 'Thomas Jefferson'),
(3, 'John Adams'),
(4, 'Sargon the Great'),
(5, 'Nikola Juriši?'),
(6, 'Margaret Thatcher'),
(7, 'Bill Clinton'),
(8, 'Harry S. Truman'),
(9, 'Sultan Mehmed II'),
(10, 'Frederick the Great'),
(11, 'Gustavus Adolphus of Sweden'),
(12, 'Ashoka the Great'),
(13, 'Woodrow Wilson'),
(14, 'James Monroe'),
(15, 'Moses'),
(16, 'Barack Obama'),
(17, 'Maximilian I, Holy Roman Emperor'),
(18, 'Cleopatra'),
(19, 'Charles V, Holy Roman Emperor'),
(20, 'John F. Kennedy'),
(21, 'Franklin Delano Roosevelt, Jr.'),
(22, 'Sultan II. Abdulhamid Khan'),
(23, 'Benito Mussolini'),
(24, 'Alexander The Great'),
(25, 'Charles de Gaulle'),
(26, 'Josip Broz Tito'),
(27, 'atilla the hun'),
(28, 'Hammurabi'),
(29, 'Queen Victoria'),
(30, 'Vladimir Lenin'),
(31, 'Widukind'),
(32, 'Augustus Caesar'),
(33, 'Queen Isabella of Spain'),
(34, 'Emperor Meiji'),
(35, 'Baldwin I. of Jerusalem'),
(36, 'Otto von Bismarck'),
(37, 'Joseph Stalin'),
(38, 'Vladimir Putin'),
(39, 'George Washington'),
(40, 'Charlemagne'),
(41, 'Ronald Reagan'),
(42, 'Leif Ericson'),
(43, 'Benjamin Franklin'),
(44, 'Winston Churchill'),
(45, 'Julius Caesar'),
(46, 'Dmitry Donskoy'),
(47, 'Selim I'),
(48, 'Catherine the Great'),
(49, 'Empress Jingu'),
(50, 'Ramses II'),
(51, 'Vladimir Lenin'),
(52, 'Justinian I'),
(53, 'Niccolo Machiavelli'),
(54, 'Gerold, Prefect of Bavaria'),
(55, 'Elizabeth I of England'),
(56, 'Suleyman The Magnificent'),
(57, 'Darius The Great'),
(58, 'Frederick the Great'),
(59, 'Allama Muhammad Iqbal'),
(60, 'William I.'),
(61, 'Imran Khan'),
(62, 'Karl Marx'),
(63, 'Henry VII, Holy Roman Emperor'),
(64, 'Pepin the Short'),
(65, 'Hannibal'),
(66, 'Pontiac'),
(67, 'Augustus II the Strong'),
(68, 'Richard I. of England'),
(69, 'Martin Luther King Jr.'),
(70, 'Franklin D. Roosevelt'),
(71, 'Simon Bolivar Buckner'),
(72, 'Mikhail Gorbachev'),
(73, 'Mao Zedong'),
(74, 'Tupac Yupanqui'),
(75, 'Abraham Lincoln'),
(76, 'Ahmad Shah Masoud National Hero'),
(77, 'Xerxes the Great'),
(78, 'Salah al-Din'),
(79, 'William the Conqueror'),
(80, 'Anwar Sadat'),
(81, 'Ho Chi Minh'),
(82, 'CYRUS the GREAT'),
(83, 'Sun Tzu'),
(84, 'T. E. Lawrence of Arabia'),
(85, 'Crazy Horse'),
(86, 'Moctezuma I'),
(87, 'Mother Teresa'),
(88, 'Fidel Castro'),
(89, 'Mustafa Kemal Atatürk'),
(90, 'Theoderic the Great'),
(91, 'Che Guevara'),
(92, 'Boudicca'),
(93, 'Napoleon Bonaparte'),
(94, 'Philip II of Macedon'),
(95, 'Nelson Mandela'),
(96, 'Kubla Khan'),
(97, 'Alexander The Great'),
(98, 'Bill Clinton'),
(99, 'CYRUS the GREAT'),
(100, 'Mahatma Gandhi');


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(99) NOT NULL,
  `domain` text NOT NULL,
  `botDomain` text NOT NULL,
  `botName` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;




ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `randnames`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `randnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
