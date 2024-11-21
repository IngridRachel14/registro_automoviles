<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Seguro.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Consulta para obtener marcas y tipos
$queryPlacas = "SELECT id, placa FROM automovil";

$stmtPlacas = $db->prepare($queryPlacas);
$stmtPlacas->execute();
$placas = $stmtPlacas->fetchAll(PDO::FETCH_ASSOC);
?>



<?php include('templates/header.php'); ?>

<div class="flex flex-col justify-center items-center mx-auto">
    <div class="w-full md:w-1/4 rounded bg-white p-6 md:mx-2 shadow-xl mb-16">
        <div class="mt-4 mb-6">
            <h2 class="text-xl text-center font-bold">Formulario para Registrar Seguro</h2>
        </div>

        <div class="mt-4 mb-6">
            <form id="formulario" action="procesar_registro_seguro.php" method="post"
                class="flex flex-col items-center">

                <label for="nombre"></label>
                <select id="placa_vehiculo" name="placa_vehiculo"
                    class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-4" required>
                    <option value="" disabled selected>Selecciona la placa del Vehículo</option>
                    <?php foreach ($placas as $automovil): ?>
                        <option value="<?= $automovil['id'] ?>"><?= $automovil['placa'] ?></option>
                    <?php endforeach; ?>
                </select><br>

                <select id="aseguradora" name="aseguradora"
                    class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-4" required>
                    <option value="" disabled selected>Selecciona la aseguradora</option>
                    <option value="asssa">ASSA Compañía de Seguros</option>
                    <option value="mapfre">MAPFRE Panamá</option>
                    <option value="seguros_suramericana">Seguros Suramericana</option>
                    <option value="internacional_de_seguros">Internacional de Seguros (IS)</option>
                    <option value="generali">Generali Panamá</option>
                    <option value="federacion_de_seguros">FEDPA Seguros</option>
                    <option value="pan_american_life">Pan-American Life Insurance</option>
                    <option value="seguros_americana">Seguros América</option>
                    <option value="oceania_de_seguros">Oceánica de Seguros</option>
                    <option value="seguros_central">Seguros Central</option>
                    <option value="atlantic_panama">Atlantic Security Panamá</option>
                    <option value="seguros_vanguardia">Seguros Vanguardia</option>
                    <option value="otro">Otra (Especificar)</option>
                </select><br>

                <label for="aseguradora_otra"></label>
                <input type="text" name="aseguradora_otra" id="aseguradora_otra"
                    placeholder="Especifique la aseguradora" style="display:none;"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg  mb-4"
                    placeholder="Ingresa el Nombre de su Aseguradora" required><br>

                <label for="no_poliza"></label>
                <input type="text" id="no_poliza" name="no_poliza"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa el Número de Poliza" required><br>

                <label for="fecha_inicio"></label>
                <input type="date" id="fecha_inicio" name="fecha_inicio"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa la Fecha de Inicio del tiempo del Seguro" required><br>

                <label for="fecha_fin"></label>
                <input type="date" id="fecha_fin" name="fecha_fin"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa la Fecha de Finalización del tiempo del Seguro" required><br>

                <input type="submit" value="Registrar"
                    class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
            </form>
        </div>
    </div>
</div>
<?php include('templates/footer.php'); ?>

<script>
    document.getElementById('aseguradora').addEventListener('change', function () {
        if (this.value === 'otro') {
            document.getElementById('aseguradora_otra').style.display = 'block';
            document.getElementById('aseguradora_otra').required = true; // Hacer que sea obligatorio si se elige "Otra"
        } else {
            document.getElementById('aseguradora_otra').style.display = 'none';
            document.getElementById('aseguradora_otra').required = false;
        }
    });
</script>