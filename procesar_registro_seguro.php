<?php
// Incluir archivos de conexión y clase Seguro
include 'includes/Database.php';
include 'includes/Seguro.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Seguro
$seguro = new Seguro($db);

// Inicializar el mensaje
$mensaje = "";

// Obtener los datos del formulario
$aseguradora = $_POST['aseguradora'];

// Si la aseguradora seleccionada es "otro", tomar el valor de aseguradora_otra
if ($aseguradora === 'otro') {
    $aseguradora = $_POST['aseguradora_otra'];  // Tomar el valor de 'aseguradora_otra'
}

// Asignar el valor de aseguradora al objeto $seguro
$seguro->nom_aseguradora = $aseguradora;
$seguro->no_poliza = $_POST['no_poliza'];
$seguro->fecha_inicio = $_POST['fecha_inicio'];
$seguro->fecha_fin = $_POST['fecha_fin'];
$seguro->placa_vehiculo = $_POST['placa_vehiculo'];

// Verificar si la placa del vehículo existe en la tabla automovil
$queryPlacaExistente = "SELECT COUNT(*) FROM automovil WHERE id = :placa_vehiculo";
$stmtPlaca = $db->prepare($queryPlacaExistente);
$stmtPlaca->bindParam(':placa_vehiculo', $_POST['placa_vehiculo']);
$stmtPlaca->execute();
$placaExistente = $stmtPlaca->fetchColumn();

if ($placaExistente == 0) {
    $mensaje = "La placa del vehículo no existe en la base de datos.";
} else {
    // Asignar los valores al objeto $seguro
    $seguro->nom_aseguradora = $aseguradora;
    $seguro->no_poliza = $_POST['no_poliza'];
    $seguro->fecha_inicio = $_POST['fecha_inicio'];
    $seguro->fecha_fin = $_POST['fecha_fin'];
    $seguro->placa_vehiculo = $_POST['placa_vehiculo'];

    // Verificar si el número de póliza ya existe
    if ($seguro->no_polizaExiste()) {
        $mensaje = "no_poliza"; // Si la póliza ya existe
    } else {
        // Registrar el seguro si no hay conflictos
        try {
            if ($seguro->registrar()) {
                $mensaje = "exito";
            } else {
                $mensaje = "error";
            }
        } catch (Exception $e) {
            $mensaje = "error";
            echo "Error al registrar: " . $e->getMessage(); // Mostrar el mensaje de error específico
        }
    }
}
?>

<!-- DISEÑO -->
<?php include('templates/header.php'); ?>
<br><br><br><br>
<div class="flex items-center justify-center min-h-screen bg-gray-200">
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full flex flex-col items-center justify-center">
            <h2 class="text-2xl font-bold mb-4 text-center">Registro Exitoso</h2>
            <img src="resources/Exito.png" alt="img-EXITO" class="w-24 flex justify-center mb-2">
            <p>El seguro ha sido registrado con éxito.</p>
            <button id="closeModal" class="mt-4 bg-[#1A5564] text-white py-2 px-4 rounded">Aceptar</button>
        </div>
    </div>

    <!-- Modal Error -->
    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full flex flex-col items-center justify-center">
            <h2 class="text-2xl font-bold mb-4 text-center">Error</h2>
            <p>El número de póliza ya está registrado. Por favor, ingrese otro número de póliza.</p>
            <button id="closeErrorModal" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Aceptar</button>
        </div>
    </div>
</div>

<br><br><br><br><br><br><br><br>
<?php include('templates/footer.php'); ?>
<!-- FIN DEL DISEÑO -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mensaje = '<?php echo $mensaje; ?>';

        if (mensaje === 'exito') {
            var modal = document.getElementById('successModal');
            modal.classList.remove('hidden');
            document.getElementById('closeModal').addEventListener('click', function () {
                window.location.href = 'registrar_seguro.php'; // Redirigir al formulario de registro de seguro
            });
            setTimeout(() => {
                window.location.href = 'registrar_seguro.php'; // Redirigir después de 5 segundos
            }, 5000);
        } else if (mensaje === 'no_poliza') {
            var errorModal = document.getElementById('errorModal');
            errorModal.classList.remove('hidden');
            document.getElementById('closeErrorModal').addEventListener('click', function () {
                window.location.href = 'registrar_seguro.php'; // Redirigir al formulario para intentar nuevamente
            });
        } else if (mensaje === 'error') {
            alert("Hubo un problema al registrar el seguro. Inténtalo de nuevo.");
        }
    });
</script>