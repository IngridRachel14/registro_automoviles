<?php
require '../vendor/autoload.php';
include '../includes/Database.php';

use Dompdf\Dompdf;

$database = new Database();
$db = $database->getConnection();

$placa = filter_input(INPUT_GET, 'placa', FILTER_SANITIZE_SPECIAL_CHARS);

if ($placa) {
    $query = "SELECT 
    p.nombre AS propietario_nombre,
    p.tipo_propietario AS propietario_tipo,
    p.cedula AS propietario_cedula,
    p.telefono AS propietario_telefono,
    p.direccion AS propietario_domicilio,
    a.vin,
    a.placa,
    m.nombre_marca AS marca_id, 
    md.nombre_modelo AS modelo_id,  
    a.anio,
    a.color,
    t.nombre_tipo AS vehiculo_tipo,
    a.capacidad_motor,
    a.num_cilindros,
    a.tipo_combustible,
    a.peso_bruto,
    a.transmision,
    s.nom_aseguradora,
    s.no_poliza,
    s.fecha_inicio,
    s.fecha_fin
FROM propietario p
LEFT JOIN automovil a ON p.id = a.propietario_id
LEFT JOIN seguro s ON a.id = s.placa_vehiculo
LEFT JOIN marca m ON a.marca_id = m.id  
LEFT JOIN modelo md ON a.modelo_id = md.id 
LEFT JOIN tipo_vehiculo t ON a.tipo_id = t.id 
WHERE a.placa = :placa";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':placa', $placa);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            ob_start();
            include('../templates/plantilla_pdf.php');
            $html = ob_get_clean();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('registro_vehicular.pdf', ['Attachment' => 1]);
        } else {
            echo "No se encontraron registros para la placa '{$placa}'.";
        }
    } else {
        echo "Error en la consulta.";
    }
} else {
    echo "Debe proporcionar una placa.";
}
?>