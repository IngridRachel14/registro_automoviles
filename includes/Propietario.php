<?php
class Propietario
{
    private $conn; // Conexión a la base de datos
    private $table_name = "propietario"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $nombre;
    public $tipo_propietario; // 'natural' o 'juridico'
    public $cedula;
    public $telefono;
    public $direccion;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Verifica si la cédula ya existe
    public function cedulaExiste()
    {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE cedula = :cedula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para registrar un nuevo propietario
    public function registrar()
    {
        // Validar que los campos requeridos no sean nulos o vacíos
        if (empty($this->nombre) || empty($this->tipo_propietario) || empty($this->cedula)) {
            throw new Exception("Error: uno o más campos requeridos no son válidos.");
        }
        
        // Consulta para insertar un nuevo propietario
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, tipo_propietario, cedula, telefono, direccion) 
                  VALUES (:nombre, :tipo_propietario, :cedula, :telefono, :direccion)";
        
        // Preparar la declaración
        $stmt = $this->conn->prepare($query);
        
        // Limpiar los datos para evitar inyección SQL
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->tipo_propietario = htmlspecialchars(strip_tags($this->tipo_propietario));
        $this->cedula = htmlspecialchars(strip_tags($this->cedula));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        
        // Enlazar los parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":tipo_propietario", $this->tipo_propietario);
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":direccion", $this->direccion);
        
        // Ejecutar la declaración y devolver el resultado
        return $stmt->execute();
    }
}
?>
