<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

// Inicializar el mensaje
$mensaje = "";

// Obtener los datos del formulario
$automovil->placa = $_POST['placa'];
$automovil->marca = $_POST['marca'];
$automovil->modelo = $_POST['modelo'];
$automovil->anio = $_POST['anio'];
$automovil->color = $_POST['color'];
$automovil->num_motor = $_POST['num_motor'];
$automovil->num_chasis = $_POST['num_chasis'];
$automovil->tipo = $_POST['tipo'];
$automovil->propietario = $_POST['propietario'];
$automovil->vin = $_POST['vin'];
$automovil->capacidad_motor = $_POST['capacidad_motor'];
$automovil->num_cilindros = $_POST['num_cilindros'];
$automovil->tipo_combustible = $_POST['tipo_combustible'];
$automovil->peso_bruto = $_POST['peso_bruto'];
$automovil->transmision = $_POST['transmision'];

// Verificar si la placa ya existe
if ($automovil->placaExiste()) {
    $mensaje = "placa";
}
// Verificar si el número de motor ya existe
elseif ($automovil->numMotorExiste()) {
    $mensaje = "num_motor";
}
// Verificar si el número de chasis ya existe
elseif ($automovil->numChasisExiste()) {
    $mensaje = "num_chasis";
} elseif ($automovil->vinExiste()) {
    $mensaje = "vin";
}else {
    // Registrar el automóvil si no hay conflictos
    if ($automovil->registrar()) {
        $mensaje = "exito";
    } else {
        $mensaje = "error";
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
            <p>El automóvil ha sido registrado con éxito.</p>
            <button id="closeModal" class="mt-4 bg-[#1A5564] text-white py-2 px-4 rounded">Aceptar</button>
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
                window.location.href = 'registrar_automovil.php';
            });
            setTimeout(() => {
                window.location.href = 'registrar_automovil.php';
            }, 5000);
        } else if (mensaje === 'placa') {
            alert('La placa ya está registrada. Por favor, elija una placa diferente.');
            window.location.href = 'registrar_automovil.php';
        } else if (mensaje === 'num_motor') {
            alert('El número de motor ya está registrado. Por favor, elija un número de motor diferente.');
            window.location.href = 'registrar_automovil.php';
        } else if (mensaje === 'num_chasis') {
            alert('El número de chasis ya está registrado. Por favor, elija un número de chasis diferente.');
            window.location.href = 'registrar_automovil.php';
        } else if (mensaje === 'vin') {
            alert('El código VIN ya está registrado. Por favor, elija un código diferente.');
            window.location.href = 'registrar_automovil.php';
        } else if (mensaje === 'error') {
            alert('Error al registrar el automóvil.');
            window.location.href = 'registrar_automovil.php';
        }
    });
</script>