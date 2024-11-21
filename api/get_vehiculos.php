<?php
// Configurar cabeceras para devolver JSON
header("Content-Type: application/json; charset=UTF-8");

// Incluir el archivo de conexión a la base de datos
require '../includes/Database.php';

try {
    //  conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // consulta SQL
    $query = "SELECT 
        p.nombre AS propietario_nombre,
        p.tipo_propietario AS propietario_tipo,
        p.cedula AS propietario_cedula,
        p.telefono AS propietario_telefono,
        p.direccion AS propietario_domicilio,
        a.vin,
        a.placa,
        m.nombre_marca AS marca, 
        md.nombre_modelo AS modelo,  
        a.anio,
        a.color,
        t.nombre_tipo AS tipo_vehiculo,
        a.capacidad_motor,
        a.num_cilindros,
        a.tipo_combustible,
        a.peso_bruto,
        a.transmision,
        s.nom_aseguradora AS aseguradora,
        s.no_poliza AS numero_poliza,
        s.fecha_inicio AS seguro_inicio,
        s.fecha_fin AS seguro_fin
    FROM propietario p
    LEFT JOIN automovil a ON p.id = a.propietario_id
    LEFT JOIN seguro s ON a.id = s.placa_vehiculo
    LEFT JOIN marca m ON a.marca_id = m.id  
    LEFT JOIN modelo md ON a.modelo_id = md.id 
    LEFT JOIN tipo_vehiculo t ON a.tipo_id = t.id";

    // Preparar y ejecutar la consulta
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Comprobar si hay resultados
    if ($stmt->rowCount() > 0) {
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array asociativo

        // Devolver los datos como JSON
        echo json_encode([
            "success" => true,
            "data" => $registros
        ]);
    } else {
        // No se encontraron registros
        echo json_encode([
            "success" => false,
            "message" => "No se encontraron registros vehiculares."
        ]);
    }
} catch (Exception $e) {
    // Manejar errores
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>
