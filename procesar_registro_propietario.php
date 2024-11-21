<?php
// Incluir archivos de conexión y clase Propietario
include 'includes/Database.php';
include 'includes/Propietario.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection(); // Asegúrate de tener la conexión correctamente

// Crear una instancia de la clase Propietario
$propietario = new Propietario($db);

// Inicializar el mensaje
$mensaje = "";

// Obtener los datos del formulario con verificación
$propietario->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$propietario->tipo_propietario = isset($_POST['tipo_propietario']) ? $_POST['tipo_propietario'] : null;
$propietario->cedula = isset($_POST['cedula']) ? $_POST['cedula'] : null;
$propietario->telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$propietario->direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;

// Verificar si la cédula ya existe
if ($propietario->cedulaExiste()) {
    $mensaje = "cedula";
} else {
    // Registrar el propietario si no hay conflictos
    if ($propietario->registrar()) {
        $mensaje = "exito";
    } else {
        $mensaje = "error";
    }
}
?>

<!-- DISEÑO -->
<?php include('templates/header.php'); ?>
<br><br><br><br>
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 flex flex-col items-center">
        <h2 class="text-2xl font-bold mb-4 text-center">Registro Exitoso</h2>
        <img src="resources/Exito.png" alt="img-EXITO" class="w-24 flex justify-center mb-2">
        <p>El propietario ha sido registrado con éxito.</p>
        <button id="closeModal" class="mt-4 bg-[#1A5564] text-white py-2 px-4 rounded">Aceptar</button>
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
                window.location.href = 'registrar_propietario.php'; // Cambiar a tu archivo de registro de propietario
            });
            setTimeout(() => {
                window.location.href = 'registrar_propietario.php'; // Cambiar a tu archivo de registro de propietario
            }, 5000);
        } else if (mensaje === 'cedula') {
            alert('La cédula ya está registrada. Por favor, elija una cédula diferente.');
            window.location.href = 'registrar_propietario.php'; // Cambiar a tu archivo de registro de propietario
        } else if (mensaje === 'error') {
            alert('Error al registrar el propietario.');
            window.location.href = 'registrar_propietario.php'; // Cambiar a tu archivo de registro de propietario
        }
    });
</script>
