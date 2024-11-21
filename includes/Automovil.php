<?php
class Automovil
{
    private $conn; // Conexión a la base de datos
    private $table_name = "automovil"; // Nombre de la tabla


    // Propiedades de la clase
    public $id;
    public $placa;
    public $marca;
    public $modelo;
    public $anio;
    public $color;
    public $num_motor;
    public $num_chasis;
    public $tipo;
    public $propietario;
    public $vin;
    public $capacidad_motor;
    public $num_cilindros;
    public $tipo_combustible;
    public $peso_bruto;
    public $transmision;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Verifica si la placa ya existe
    public function placaExiste()
    {
        $query = "SELECT COUNT(*) FROM automovil WHERE placa = :placa";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica si el número de motor ya existe
    public function numMotorExiste()
    {
        $query = "SELECT COUNT(*) FROM automovil WHERE num_motor = :num_motor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':num_motor', $this->num_motor);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica si el número de chasis ya existe
    public function numChasisExiste()
    {
        $query = "SELECT COUNT(*) FROM automovil WHERE num_chasis = :num_chasis";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':num_chasis', $this->num_chasis);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function vinExiste()
    {
        $query = "SELECT COUNT(*) FROM automovil WHERE vin = :vin";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':vin', $this->vin);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    // Verifica si el ID de un tipo existe
    public function verificarExistenciaTipo()
    {
        $query = "SELECT COUNT(*) FROM tipo_vehiculo WHERE id = :tipo_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tipo_id', $this->tipo);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica si el ID de una marca existe
    public function verificarExistenciaMarca()
    {
        $query = "SELECT COUNT(*) FROM marca WHERE id = :marca_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':marca_id', $this->marca);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica si el ID de un modelo existe
    public function verificarExistenciaModelo()
    {
        $query = "SELECT COUNT(*) FROM modelo WHERE id = :modelo_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':modelo_id', $this->modelo);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica si el ID de un propietario existe
    public function verificarExistenciaPropietario()
    {
        $query = "SELECT COUNT(*) FROM propietario WHERE id = :propietario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':propietario_id', $this->propietario);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }


    // Método para registrar un nuevo automóvil
    public function registrar()
    {
        // Verificar que los IDs existan en la base de datos
        if (!$this->verificarExistenciaTipo()) {
            throw new Exception("El tipo de vehículo con ID {$this->tipo} no existe.");
        }
        if (!$this->verificarExistenciaMarca()) {
            throw new Exception("La marca con ID {$this->marca} no existe.");
        }
        if (!$this->verificarExistenciaModelo()) {
            throw new Exception("El modelo con ID {$this->modelo} no existe.");
        }
        if (!$this->verificarExistenciaPropietario()) {
            throw new Exception("El propietario con ID {$this->propietario} no existe.");
        }

        // Consulta para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " 
              (placa, anio, color, num_motor, num_chasis, tipo_id, marca_id, modelo_id, propietario_id, vin, capacidad_motor, num_cilindros, tipo_combustible, peso_bruto, transmision) 
              VALUES (:placa, :anio, :color, :num_motor, :num_chasis, :tipo_id, :marca_id, :modelo_id, :propietario_id, :vin, :capacidad_motor, :num_cilindros, :tipo_combustible, :peso_bruto, :transmision)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->num_motor = htmlspecialchars(strip_tags($this->num_motor));
        $this->num_chasis = htmlspecialchars(strip_tags($this->num_chasis));
        $this->vin = htmlspecialchars(strip_tags($this->vin));
        $this->capacidad_motor = htmlspecialchars(strip_tags($this->capacidad_motor));
        $this->num_cilindros = htmlspecialchars(strip_tags($this->num_cilindros));
        $this->tipo_combustible = htmlspecialchars(strip_tags($this->tipo_combustible));
        $this->peso_bruto = htmlspecialchars(strip_tags($this->peso_bruto));
        $this->transmision = htmlspecialchars(strip_tags($this->transmision));

        // Enlazar los parámetros
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":num_motor", $this->num_motor);
        $stmt->bindParam(":num_chasis", $this->num_chasis);
        $stmt->bindParam(":tipo_id", $this->tipo);
        $stmt->bindParam(":marca_id", $this->marca);
        $stmt->bindParam(":modelo_id", $this->modelo);
        $stmt->bindParam(":propietario_id", $this->propietario);
        $stmt->bindParam(":vin", $this->vin);
        $stmt->bindParam(":capacidad_motor", $this->capacidad_motor);
        $stmt->bindParam(":num_cilindros", $this->num_cilindros);
        $stmt->bindParam(":tipo_combustible", $this->tipo_combustible);
        $stmt->bindParam(":peso_bruto", $this->peso_bruto);
        $stmt->bindParam(":transmision", $this->transmision);

        // Ejecutar la declaración y devolver el resultado
        return $stmt->execute();
    }

}
?>