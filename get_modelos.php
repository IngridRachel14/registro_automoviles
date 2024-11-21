<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/Database.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Obtener el ID de la marca desde la solicitud
$marca_id = isset($_GET['marca_id']) ? intval($_GET['marca_id']) : 0;

if ($marca_id) {
    // Consulta para obtener los modelos de la marca seleccionada
    $queryModelos = "SELECT id, nombre_modelo FROM modelo WHERE marca_id = :marca_id";
    $stmt = $db->prepare($queryModelos);
    $stmt->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Establecer el tipo de contenido a JSON
        header('Content-Type: application/json');

        // Verificar si se encontraron modelos
        if ($modelos) {
            echo json_encode($modelos); // Enviar los modelos en formato JSON
        } else {
            echo json_encode([]); // Devolver un JSON vacío si no se encontraron modelos
        }
    } else {
        // En caso de fallo en la ejecución de la consulta
        echo json_encode(['error' => 'Error en la ejecución de la consulta']);
    }
} else {
    // Si no hay un ID de marca, devolver un JSON vacío o un mensaje de error
    echo json_encode(['error' => 'ID de marca no válido']);
}
?>
