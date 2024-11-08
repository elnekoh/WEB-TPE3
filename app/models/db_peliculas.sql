-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2024 a las 21:07:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--
CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `clasificacion_por_edad` varchar(255) DEFAULT 'Sin clasificar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`, `descripcion`, `clasificacion_por_edad`) VALUES
(1, 'Acción', 'Acción. Generalmente son películas que aportan un toque de adrenalina. Incluyen acrobacias físicas, persecuciones rescates y batallas, lo que las caracteriza principalmente.', 'Sin clasificar'),
(3, 'Drama', 'Drama is the specific mode of fiction represented in performance: a play, opera, mime, ballet, etc., performed in a theatre, or on radio or television. ', 'Sin clasificar'),
(4, 'Terror', 'género que pretende o tiene la capacidad de asustar, causar miedo o aterrorizar sus lectores o espectadores e inducir sentimientos de horror y terror.', 'Sin clasificar'),
(5, 'Ciencia ficcion', 'Science fiction is a genre of speculative fiction, which typically deals with imaginative and futuristic concepts such as advanced science and technology, space exploration, time travel, parallel universes, and extraterrestrial life. It is related to', 'Sin clasificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `director` varchar(250) NOT NULL,
  `anio` int(11) NOT NULL,
  `descripcion` varchar(510) NOT NULL DEFAULT 'Sin descripcion.',
  `path_img` varchar(50) NOT NULL DEFAULT 'no_picture_avaible.png',
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `director`, `anio`, `descripcion`, `path_img`, `id_genero`) VALUES
(1, 'Rapidos y Furiosos 5', 'Justin Lin', 2011, 'Fast & Furious [también conocida como Rápidos y furiosos en Hispanoamérica y The Fast and the Furious en España] es una franquicia de medios estadounidense centrada en una serie de películas de acción que se ocupan en gran medida de automóviles.', 'rapidosyfuriosos.jpg', 1),
(2, 'The Whale', 'Darren Aronofsky', 2022, 'Un profesor de inglés, un tipo solitario que sufre obesidad mórbida, intenta restablecer el contacto con su hija en busca de perdón.', 'thewhale.jpg', 3),
(3, 'La Bruja de Blair', 'Adam Wingard', 2016, 'Tres estudiantes de cine se pierden en un bosque habitado por una bruja, durante su investigación de la leyenda.', 'labruja.jpg', 4),
(4, 'Interestellar', 'Christopher Nolan', 2014, 'Gracias a un descubrimiento, un grupo de científicos y exploradores, encabezados por Cooper, se embarcan en un viaje espacial para encontrar un lugar con las condiciones necesarias para reemplazar a la Tierra y comenzar una nueva vida allí.', 'interstellar.jpg', 5),
(14, 'Matrix', 'Lana y Lilly Wachowski', 1999, 'Un experto en computadoras descubre que su mundo es una simulación total creada con maliciosas intenciones por parte de la ciberinteligencia.', 'matrix.jpg', 5),
(15, 'Volver al futuro', 'Robert Zemeckis', 1985, 'Una máquina del tiempo transporta a un adolescente a los años 50, cuando sus padres todavía estudiaban en la secundaria.', 'volveralfuturo.jpg', 5),
(16, 'El origen', 'Christopher Nolan', 2010, 'Dom Cobb es un ladrón con una extraña habilidad para entrar a los sueños de la gente y robarles los secretos de sus subconscientes. Su habilidad lo ha vuelto muy popular en el mundo del espionaje corporativo, pero ha tenido un gran costo en la gente que ama. Cobb obtiene la oportunidad de redimirse cuando recibe una tarea imposible: plantar una idea en la mente de una persona. Si tiene éxito, será el crimen perfecto, pero un enemigo se anticipa a sus movimientos.', 'elorigen.jpg', 5),
(17, 'El planeta de los simios', 'Franklin Schaffner', 1968, 'Un astronauta llega a un planeta del futuro, donde los simios son muy inteligentes y dominan a los humanos.', 'elplanetadelossimios.jpg', 5),
(18, ' Star Wars: episodio VI - el retorno del Jedi', 'Richard Marquand', 1983, 'Luke Skywalker, ahora un experimentado caballero Jedi, intenta descubrir la identidad de Darth Vader.', 'starwars.jpg', 5),
(19, 'Atlas', 'Brad Peyton', 2024, 'Una brillante analista de datos que desconfía profundamente de la inteligencia artificial descubre que puede ser su única esperanza cuando una misión para capturar a un robot renegado sale mal.', 'atlas.jpg', 5),
(20, ' Otro día para matar', 'Chad Stahelski', 2014, 'La ciudad de Nueva York se llena de balas cuando John Wick, un exasesino a sueldo, regresa de su retiro para enfrentar a los mafiosos rusos, liderados por Viggo Tarasov, que destruyeron todo aquello que él amaba y pusieron precio a su cabeza.', 'otrodiaparamatar.jpg', 1),
(21, 'Batman: el caballero de la noche', 'Christopher Nolan', 2008, 'Batman tiene que mantener el equilibrio entre el heroísmo y el vigilantismo para pelear contra un vil criminal conocido como el Guasón, que pretende sumir Ciudad Gótica en la anarquía.', 'batman.jpg', 1),
(22, 'Terminator', 'James Cameron', 1985, 'Un asesino cibernético del futuro es enviado a Los Ángeles para matar a la mujer que procreará a un líder.', 'terminator.jpg', 1),
(23, ' Iron Man: el hombre de hierro', 'Jon Favreau', 2008, 'Un empresario millonario construye un traje blindado y lo usa para combatir el crimen y el terrorismo.', 'ironman.jpg', 1),
(24, 'Máxima velocidad', 'Jan de Bont', 1994, 'Un oficial de policía debe detener un autobús metropolitano en el que un psicópata colocó una bomba, la cual explotará si el vehículo baja de los 80 kilómetros por hora.', 'maximavelocidad.jpg', 1),
(25, ' Búsqueda implacable', 'Pierre Morel', 2008, 'El exagente de las fuerzas especiales de élite Bryan Millis se ve enredado en la trama de una organización criminal cuando intenta salvar a su hija Kim, pero solo tiene 96 horas para rescatarla antes de perder el rastro.', 'busqueda.jpg', 1),
(26, 'Siniestro', 'Scott Derrickson', 2012, 'Ellison Oswald, escritor de historias criminales, está en una mala racha; no ha tenido un éxito en más de 10 años y está desesperado. Cuando descubre una película que muestra las muertes de una familia, él promete resolver el misterio. Ellison y su familia se mudan a la casa de las víctimas y se pone a trabajar. Sin embargo, cuando unas imágenes antiguas y otras pistas apuntan a una presencia sobrenatural. Ellison descubre que vivir en esa casa podría costarles la vida.', 'siniestro.jpg', 4),
(27, 'El resplandor', 'Stanley Kubrick', 1980, 'Jack Torrance se convierte en cuidador de invierno en el Hotel Overlook, en Colorado, con la esperanza de vencer su bloqueo con la escritura. Se instala allí junto con su esposa, Wendy, y su hijo, Danny, que está plagado de premoniciones psíquicas. Mientras la escritura de Jack no fluye y las visiones de Danny se vuelven más preocupantes, Jack descubre oscuros secretos del hotel y comienza a convertirse en un maníaco homicida, empeñado en aterrorizar a su familia.', 'elresplandor.jpg', 4),
(28, 'Smile', 'Parker Finn', 2022, 'Tras presencia el dramático incidente sufrido por un paciente, la Dra. Cotter empieza a experimentar hechos aterradores sin explicación aparente. A medida que el horror se adueña de su vida, comprende que la respuesta está en su propio pasado.', 'smile.jpg', 4),
(29, 'Sueño de fuga', 'Frank Darabont', 1995, 'Un hombre inocente es enviado a una corrupta penitenciaria de Maine en 1947 y sentenciado a dos cadenas perpetuas por un doble asesinato.', 'sueniodefuga.jpg', 3),
(30, 'Diecisiete', 'Daniel Sánchez Arévalo', 2019, 'Héctor es un joven de 17 años poco comunicativo que se encuentra internado en un centro de menores. Durante una terapia con perros, establece un vínculo especial con uno de ellos, pero todo cambia cuando la perra es adoptada.', 'diescisiete.jpg', 3),
(31, 'Parásitos', 'Bong Joon-ho', 2019, 'Tanto Gi Taek como su familia están sin trabajo. Cuando su hijo mayor, Gi Woo, empieza a impartir clases particulares en la adinerada casa de los Park, las dos familias, que tienen mucho en común pese a pertenecer a dos mundos totalmente distintos, entablan una relación de resultados imprevisibles.', 'parasitos.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `role`) VALUES
(1, 'webadmin', '$2y$10$NjX5u7fa4Ld00VoRc.Ttqusfc2leaztkjVxYfpNUoKjkfMTxqUmNK', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Generofk` (`id_genero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
