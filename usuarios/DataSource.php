<?php

class DataSource {
    private $cadenaParaConexion;
    private $conexion;

    public function __construct() {
        try {
            // Cargar variables de entorno
            if (file_exists(__DIR__ . '/.env')) {
                $env = parse_ini_file(__DIR__ . '/.env');
                foreach ($env as $key => $value) {
                    putenv("$key=$value");
                }
            }

            // Obtener las credenciales de la DB
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $password = getenv('DB_PASS');

            // Configurar cadena de conexion
            $this->cadenaParaConexion = "mysql:host=$host;dbname=$dbname";

            // Crear conexión con la base de datos
            $this->conexion = new PDO($this->cadenaParaConexion, $user, $password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Permite traer un registro de la base de datos.
     * 
     * @param string $sql   Sentencia SQL
     * @param array $values Valores para la consulta
     * @return $tabla_datos Devuelve un registro de la base de datos
     */
    public function ejecutarConsulta($sql = "", $values = []) {
        if ($sql != "") {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute($values);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return 0;
        }
    }

    /**
     * Permite obtener un entero de las tablas afectadas.
     * 0 indica que no se realizó ninguna acción
     * 
     * @param string $sql               Sentencia SQL
     * @param array $values             Valores para la consulta
     * @return $numero_tablas_afectadas Devuelve un entero de las tablas afectadas
     */
    public function ejecutarActualizacion($sql = "", $values = []) {
        if ($sql != "") {
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute($values);
            return $consulta->rowCount();
        } else {
            return 0;
        }
    }
}