<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';

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
            <h2 class="text-xl text-center font-bold">Obtener Registro Vehicular</h2>
        </div>

        <div class="mt-4 mb-6">
            <form action="includes/generar_registro.php" method="get">
                <div id="seccion1" class="flex flex-col items-center justify-center w-full">
                    <label for="placa"></label>
                    <select id="placa" name="placa"
                        class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-4" required>
                        <option value="" disabled selected>Selecciona la Placa del automovil</option>
                        <?php foreach ($placas as $automovil): ?>
                            <option value="<?= $automovil['placa'] ?>"><?= $automovil['placa'] ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <button type="submit"
                        class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">Generar
                        PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('templates/footer.php'); ?>