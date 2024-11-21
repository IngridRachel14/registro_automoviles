<?php
class Seguro
{
    private $conn; // Conexión a la base de datos
    private $table_name = "seguro"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $nom_aseguradora;
    public $no_poliza;
    public $fecha_inicio;
    public $fecha_fin;
    public $placa_vehiculo;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Verifica si la cédula ya existe
    public function no_polizaExiste()
    {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE no_poliza = :no_poliza";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':no_poliza', $this->no_poliza);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Método para registrar un nuevo propietario
    public function registrar()
    {
        // Validar que los campos requeridos no sean nulos o vacíos
        if (empty($this->nom_aseguradora) || empty($this->fecha_inicio) || empty($this->fecha_fin) || empty($this->placa_vehiculo)) {
            throw new Exception("Error: uno o más campos requeridos no son válidos.");
        }

        // Consulta para insertar un nuevo propietario
        $query = "INSERT INTO " . $this->table_name . " 
        
                  (nom_aseguradora, no_poliza, fecha_inicio, fecha_fin, placa_vehiculo) 
                  VALUES (:nom_aseguradora, :no_poliza, :fecha_inicio, :fecha_fin, :placa_vehiculo)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->nom_aseguradora = htmlspecialchars(strip_tags($this->nom_aseguradora));
        $this->no_poliza = htmlspecialchars(strip_tags($this->no_poliza));
        $this->fecha_inicio = htmlspecialchars(strip_tags($this->fecha_inicio));
        $this->fecha_fin = htmlspecialchars(strip_tags($this->fecha_fin));
        $this->placa_vehiculo = htmlspecialchars(strip_tags($this->placa_vehiculo));

        // Enlazar los parámetros
        $stmt->bindParam(":nom_aseguradora", $this->nom_aseguradora);
        $stmt->bindParam(":no_poliza", $this->no_poliza);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":fecha_fin", $this->fecha_fin);
        $stmt->bindParam(":placa_vehiculo", $this->placa_vehiculo);

        // Ejecutar la declaración y devolver el resultado
        return $stmt->execute();
    }
}
?>