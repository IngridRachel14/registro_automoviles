<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Consulta para obtener marcas y tipos
$queryMarcas = "SELECT id, nombre_marca FROM marca";
$queryTipos = "SELECT id, nombre_tipo FROM tipo_vehiculo";
$queryPropietarios = "SELECT id, cedula FROM propietario";

$stmtMarcas = $db->prepare($queryMarcas);
$stmtMarcas->execute();
$marcas = $stmtMarcas->fetchAll(PDO::FETCH_ASSOC);

$stmtTipos = $db->prepare($queryTipos);
$stmtTipos->execute();
$tipos = $stmtTipos->fetchAll(PDO::FETCH_ASSOC);

$stmtPropietarios = $db->prepare($queryPropietarios);
$stmtPropietarios->execute();
$propietarios = $stmtPropietarios->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include('templates/header.php'); ?>

<div class="flex flex-col justify-center items-center mx-auto">
    <div class="w-full md:w-1/4 rounded bg-white p-6 md:mx-2 shadow-xl mb-16">
        <div class="mt-4 mb-6">
            <h2 class="text-xl text-center font-bold">Formulario para Registrar Automóvil</h2>
        </div>

        <div class="mt-4 mb-6">

            <form id="formulario" action="procesar_registro.php" method="post">
                <!-- Primera sección -->
                <div id="seccion1" class="flex flex-col items-center justify-center w-full">
                    <label for="placa"></label>
                    <input type="text" id="placa" name="placa" required
                        class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg  mb-2"
                        placeholder="Ingresa la Placa del automovil" pattern="[A-Za-z0-9]{1,}"
                        title="La placa debe contener solo caracteres alfanuméricos" required><br>

                    <label for="anio"></label>
                    <input type="number" id="anio" name="anio"
                        class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-2"
                        placeholder="Ingresa el Año del automovil" required><br>

                    <label for="color"></label>
                    <input type="text" id="color" name="color"
                        class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                        placeholder="Ingresa el Color del automovil" required><br>

                    <label for="num_motor"></label>
                    <input type="text" id="num_motor" name="num_motor"
                        class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                        placeholder="Ingresa el Número de Motor del automovil" required><br>

                    <label for="num_chasis"></label>
                    <input type="text" id="num_chasis" name="num_chasis"
                        class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                        placeholder="Ingresa el Número de Chasis del automovil" required><br>

                    <select id="marca" name="marca"
                        class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-2" required>
                        <option value="" disabled selected>Selecciona la Marca del Vehículo</option>
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?= $marca['id'] ?>"><?= $marca['nombre_marca'] ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <select id="modelo" name="modelo"
                        class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-2" required>
                        <option value="" disabled selected>Selecciona el Modelo del Vehículo</option>
                    </select><br>

                    <select id="tipo" name="tipo"
                        class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-4" required>
                        <option value="" disabled selected>Selecciona el Tipo de Vehículo</option>
                        <?php foreach ($tipos as $tipo): ?>
                            <option value="<?= $tipo['id'] ?>"><?= $tipo['nombre_tipo'] ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <button type="button" id="siguiente1"
                        class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5""
                        onclick=" mostrarSeccion2()">Siguiente</button>
                </div>

                <!-- Segunda sección (oculta inicialmente) -->
                <div id="seccion2" style="display: none;" class="flex flex-col">
                    <div class="flex flex-col items-center justify-center">
                        <select id="propietario" name="propietario"
                            class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-2" required>
                            <option value="" disabled selected>Selecciona el Propietario del Vehículo</option>
                            <?php foreach ($propietarios as $propietario): ?>
                                <option value="<?= $propietario['id'] ?>"><?= $propietario['cedula'] ?></option>
                            <?php endforeach; ?>
                        </select><br>

                        <label for="vin"></label>
                        <input type="text" id="vin" name="vin"
                            class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-2"
                            placeholder="Ingresa el VIN del automóvil" required><br>

                        <label for="capacidad_motor"></label>
                        <input type="number" step="0.01" id="capacidad_motor" name="capacidad_motor"
                            class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-2"
                            placeholder="Ingresa la Capacidad del Motor (L)" required><br>

                        <label for="num_cilindros"></label>
                        <input type="number" id="num_cilindros" name="num_cilindros"
                            class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-2"
                            placeholder="Ingresa el Número de Cilindros" required><br>

                        <label for="tipo_combustible"></label>
                        <select id="tipo_combustible" name="tipo_combustible"
                            class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-2" required>
                            <option value="" disabled selected>Selecciona el Tipo de Combustible</option>
                            <option value="Gasolina">Gasolina</option>
                            <option value="Diésel">Diésel</option>
                            <option value="Eléctrico">Eléctrico</option>
                            <option value="Híbrido">Híbrido</option>
                        </select><br>

                        <label for="peso_bruto"></label>
                        <input type="number" step="0.01" id="peso_bruto" name="peso_bruto"
                            class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-2"
                            placeholder="Ingresa el Peso Bruto (kg)" required><br>

                        <label for="transmision"></label>
                        <select id="transmision" name="transmision"
                            class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-2" required>
                            <option value="" disabled selected>Selecciona la Transmisión</option>
                            <option value="Manual">Manual</option>
                            <option value="Automática">Automática</option>
                            <option value="Semi-Automática">Semi-Automática</option>
                        </select><br>

                        <div class="flex flex-row">
                            <button type="button" id="atras1"
                                class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 mr-5"
                                onclick="mostrarSeccion1()">Atrás</button>
                            <input type="submit" value="Registrar"
                                class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 justify-center">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Función para mostrar la primera sección
    function mostrarSeccion1() {
        document.getElementById("seccion2").style.display = "none"; // Ocultar la segunda sección
        document.getElementById("seccion1").style.display = "block"; // Mostrar la primera sección
    }

    // Función para mostrar la segunda sección
    function mostrarSeccion2() {
        document.getElementById("seccion1").style.display = "none"; // Ocultar la primera sección
        document.getElementById("seccion2").style.display = "block"; // Mostrar la segunda sección
    }

    // Función para mostrar la primera sección
    function mostrarSeccion1() {
        document.getElementById("seccion2").style.display = "none"; // Ocultar la segunda sección
        const seccion1 = document.getElementById("seccion1");
        seccion1.style.display = "flex"; // Asegurarse de que sea visible
        seccion1.style.justifyContent = "center"; // Mantener el centrado
    }

    document.getElementById('marca').addEventListener('change', function () {
        const marcaId = this.value;
        const modeloSelect = document.getElementById('modelo');

        // Limpiar el select de modelos
        modeloSelect.innerHTML = '<option value="" disabled selected>Selecciona el Modelo del Vehículo</option>';

        if (marcaId) {
            fetch(`get_modelos.php?marca_id=${marcaId}`) // Eliminar espacio extra aquí
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error); // Manejar errores del servidor
                    } else {
                        data.forEach(modelo => {
                            const option = document.createElement('option');
                            option.value = modelo.id;
                            option.textContent = modelo.nombre_modelo;
                            modeloSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

</script>
<?php include('templates/footer.php'); ?>