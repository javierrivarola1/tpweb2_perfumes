    <?php
    require_once 'config.php';

    class Autodeploy
    {
        protected $db;
  
        public function __construct()
        {
          try {
            $this->db = new PDO("mysql:host=" . MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
            $this->db->exec("CREATE DATABASE IF NOT EXISTS " . MYSQL_DB);
            $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8mb4", MYSQL_USER, MYSQL_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_deploy();
          } catch (PDOException $e) {
  
            echo "Error de conexión: " . $e->getMessage();
            exit;
          }
        }

        //Funciona la base de datos con una version antigua
        private function _deploy()
  
        {
          $query = $this->db->query('SHOW TABLES');
          $tables = $query->fetchAll();
          if (count($tables) == 0) {
  
            $sql = <<<END
                    -- phpMyAdmin SQL Dump
                    -- version 5.2.1
                    -- https://www.phpmyadmin.net/
                    --
                    -- Servidor: 127.0.0.1
                    -- Tiempo de generación: 15-10-2025 a las 23:47:38
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
                    -- Base de datos: `db_perfumeria`
                    --

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `marca`
                    --

                    CREATE TABLE `marca` (
                    `id` int(11) NOT NULL,
                    `nombre` text NOT NULL,
                    `origen` varchar(25) DEFAULT NULL,
                    `creador` varchar(50) DEFAULT NULL,
                    `año` int(4) DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Volcado de datos para la tabla `marca`
                    --

                    INSERT INTO `marca` (`id`, `nombre`, `origen`, `creador`, `año`) VALUES
                    (1, 'Antonio Banderas', 'españa', 'antonio banderas', 1960),
                    (2, 'Paco Rabanne', 'francia', 'familia puig', 1966),
                    (3, 'Carolina Herrera', 'estados unidos', 'carolina herrera', 1981);

                    -- --------------------------------------------------------

                    --
                    -- Estructura de tabla para la tabla `producto`
                    --

                    CREATE TABLE `producto` (
                    `id` int(11) NOT NULL,
                    `nombre` text NOT NULL,
                    `descripcion` text NOT NULL,
                    `marca` int(100) NOT NULL,
                    `sexo` char(3) NOT NULL,
                    `stock` tinyint(1) NOT NULL,
                    `precio` float NOT NULL,
                    `presentacion` int(3) DEFAULT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Volcado de datos para la tabla `producto`
                    --

                    INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `marca`, `sexo`, `stock`, `precio`, `presentacion`) VALUES
                    (1, 'Blue Seduction Antonio', 'Blue Seduction de Antonio Banderas es una fragancia de la familia olfativa Oriental Fougère para Hombres. Las Notas de Salida son melón, bergamota, menta y grosellas negras; las Notas de Corazón son agua de mar, manzana verde, capuchino, cardamomo y nuez moscada; las Notas de Fondo son notas amaderadas y ámbar.', 1, 'M', 1, 15000, 120),
                    (2, 'King of Seduction Absolute', 'King of Seduction Absolute de Antonio Banderas es una fragancia de la familia olfativa Amaderada Aromática para Hombres.\r\n Las Notas de Salida son toronja (pomelo), toronja (pomelo), ajenjo (absenta) y almendras verdes; las Notas de Corazón son notas marinas, lavanda y cardamomo; las Notas de Fondo son cuero, vetiver y musgo de roble.', 1, 'M', 1, 16000, 60),
                    (3, 'King of Seduction Antonio Banderas', 'King of Seduction de Antonio Banderas es una fragancia de la familia olfativa Amaderada Aromática para Hombres. Las Notas de Salida son piña, bergamota, melón, manzana verde y toronja (pomelo); las Notas de Corazón son notas marinas, jazmín, cardamomo y neroli; las Notas de Fondo son vetiver, almizcle blanco, cedro, gamuza y ámbar.', 1, 'M', 1, 16000, 60),
                    (4, 'Good Girl', 'Good Girl de Carolina Herrera es una fragancia de la familia olfativa Oriental Floral para Mujeres. Las Notas de Salida son almendra, café, bergamota y limón (lima ácida); las Notas de Corazón son nardos, jazmín sambac (sampaguita), flor de azahar del naranjo, rosa de Bulgaria (rosa Damascena de Bulgaria) y raíz de lirio; las Notas de Fondo son haba tonka, cacao, vainilla, praliné, sándalo, almizcle, ámbar, madera de cachemira, pachulí, canela y cedro.', 3, 'F', 1, 28000, 100),
                    (5, '212 VIP Rosé', '212 VIP Rosé de Carolina Herrera es una fragancia de la familia olfativa Floral Frutal para Mujeres.  Las Notas de Salida son Champagne Rosé y pimienta rosa; las Notas de Corazón son flor del duraznero (flor del melocotonero) y rosa; las Notas de Fondo son almizcle blanco y notas amaderadas.', 3, 'F', 1, 20000, 50),
                    (6, 'Carolina', 'Carolina de Carolina Herrera es una fragancia de la familia olfativa Almizcle Floral Amaderado para Mujeres. Las Notas de Salida son hojas del fresal salvaje, naranja amarga y cardamomo; las Notas de Corazón son frutas del bosque, rosa y pimienta; las Notas de Fondo son madera de cachemira, almizcle, ámbar y vainilla.', 3, 'F', 1, 25000, 100),
                    (7, 'Invictus Victory Elixir Rabanne', 'Invictus Victory Elixir de Rabanne es una fragancia de la familia olfativa Oriental Amaderada para Hombres. Esta fragrancia es nueva. Invictus Victory Elixir se lanzó en 2023. Las Notas de Salida son lavanda, cardamomo y pimienta negra; las Notas de Corazón son incienso y pachulí; las Notas de Fondo son vaina de vainilla y haba tonka.', 2, 'M', 1, 55000, 50),
                    (8, 'Olympéa Rabanne', 'Olympéa de Rabanne es una fragancia de la familia olfativa Oriental Floral para Mujeres. Las Notas de Salida son jazmín de agua, mandarina verde y flor de jengibre; las Notas de Corazón son vainilla y sal; las Notas de Fondo son madera de cachemira, ámbar gris y sándalo.', 2, 'F', 1, 21000, 50),
                    (9, '1 Million Royal Rabanne', '1 Million Royal de Rabanne es una fragancia de la familia olfativa Oriental Amaderada para Hombres.  Las Notas de Salida son cardamomo, naranja tangerina y bergamota; las Notas de Corazón son lavanda, salvia y hojas de violeta; las Notas de Fondo son benjuí, cedro y pachulí.', 2, 'U', 1, 23000, 100);

                    --
                    -- Índices para tablas volcadas
                    --

                    --
                    -- Indices de la tabla `marca`
                    --
                    ALTER TABLE `marca`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE KEY `nombre` (`nombre`) USING HASH;

                    --
                    -- Indices de la tabla `producto`
                    --
                    ALTER TABLE `producto`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE KEY `nombre` (`nombre`) USING HASH,
                    ADD KEY `marca` (`marca`);

                    --
                    -- AUTO_INCREMENT de las tablas volcadas
                    --

                    --
                    -- AUTO_INCREMENT de la tabla `marca`
                    --
                    ALTER TABLE `marca`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                    --
                    -- AUTO_INCREMENT de la tabla `producto`
                    --
                    ALTER TABLE `producto`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

                    --
                    -- Restricciones para tablas volcadas
                    --

                    --
                    -- Filtros para la tabla `producto`
                    --
                    ALTER TABLE `producto`
                    ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON UPDATE CASCADE;
                    COMMIT;

                    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                            
                  END;
  
  
            $this->db->exec($sql);
          }
        }

      }
