<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Conexión
$database = new Database();
$db = $database->getConnection();

// Verificar si se ha enviado una solicitud de búsqueda
$busqueda = "";
$resultados = [];

// Método Eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_eliminar'])) {
    $id_eliminar = htmlspecialchars(strip_tags($_POST['id_eliminar']));

    // Consulta para eliminar
    $query_eliminar = "DELETE FROM automovil WHERE id = :id_eliminar";

    // Preparar la declaración
    $stmt_eliminar = $db->prepare($query_eliminar);
    $stmt_eliminar->bindParam(':id_eliminar', $id_eliminar);

    // Ejecutar la declaración
    if ($stmt_eliminar->execute()) {
        echo json_encode(['success' => true, 'message' => 'Automóvil eliminado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el automóvil.']);
    }
    exit;
}

// Cargar los registros o realizar búsqueda específica
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscador'])) {
    // Realizar búsqueda
    $busqueda = htmlspecialchars(strip_tags($_POST['buscador']));

    // consulta de búsqueda
    $query = "SELECT * FROM automovil WHERE placa LIKE :busqueda OR marca_id LIKE :busqueda OR modelo_id LIKE :busqueda";

    // Preparar la declaración
    $stmt = $db->prepare($query);

    // buscar coincidencias
    $busqueda_param = "%" . $busqueda . "%";
    $stmt->bindParam(':busqueda', $busqueda_param);

    // Ejecutar la declaración
    $stmt->execute();

    // Obtener los resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Cargar todos los registros
    $query = "SELECT * FROM automovil";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Método Actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_actualizar'])) {
    $id_actualizar = htmlspecialchars(strip_tags($_POST['id_actualizar']));
    $placa = htmlspecialchars(strip_tags($_POST['placa']));
    $marca = htmlspecialchars(strip_tags($_POST['marca']));
    $modelo = htmlspecialchars(strip_tags($_POST['modelo']));
    $anio = htmlspecialchars(strip_tags($_POST['anio']));
    $color = htmlspecialchars(strip_tags($_POST['color']));
    $num_motor = htmlspecialchars(strip_tags($_POST['num_motor']));
    $num_chasis = htmlspecialchars(strip_tags($_POST['num_chasis']));
    $tipo = htmlspecialchars(strip_tags($_POST['tipo']));
    $propietario = htmlspecialchars(strip_tags($_POST['propietario']));

    // Consulta para actualizar
    $query_actualizar = "UPDATE automovil SET 
        placa = :placa,
        marca_id = :marca,
        modelo_id = :modelo,
        anio = :anio,
        color = :color,
        num_motor = :num_motor,
        num_chasis = :num_chasis,
        tipo_id = :tipo,
        propietario_id = :propietario 
        WHERE id = :id_actualizar";

    // Preparar la declaración
    $stmt_actualizar = $db->prepare($query_actualizar);
    $stmt_actualizar->bindParam(':placa', $placa);
    $stmt_actualizar->bindParam(':marca', $marca);
    $stmt_actualizar->bindParam(':modelo', $modelo);
    $stmt_actualizar->bindParam(':anio', $anio);
    $stmt_actualizar->bindParam(':color', $color);
    $stmt_actualizar->bindParam(':num_motor', $num_motor);
    $stmt_actualizar->bindParam(':num_chasis', $num_chasis);
    $stmt_actualizar->bindParam(':tipo', $tipo);
    $stmt_actualizar->bindParam(':propietario', $propietario);
    $stmt_actualizar->bindParam(':id_actualizar', $id_actualizar);

    // Ejecutar la declaración
    if ($stmt_actualizar->execute()) {
        echo json_encode(['success' => true, 'message' => 'Automóvil actualizado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el automóvil.']);
    }
    exit;
}


// Verificar si se ha enviado una solicitud de obtener datos para actualización
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = htmlspecialchars(strip_tags($_GET['id']));

    // Consulta para obtener datos del automóvil
    $query = "SELECT * FROM automovil WHERE id = :id";

    // Preparar la declaración
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);

    // Ejecutar la declaración
    $stmt->execute();

    // Obtener los resultados
    $automovil = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($automovil) {
        echo json_encode(['success' => true, 'automovil' => $automovil]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Automóvil no encontrado.']);
    }
    exit;
}
?>

<!-- DISEÑO -->

<?php include('templates/header.php'); ?>

<!-- Formulario para insertar datos -->
<h2 class="text-2xl font-bold mb-4 ml-8">Actualizar Automóvil</h2>
<form id="formActualizar" class="flex flex-col space-y-4">
    <input type="hidden" id="id_actualizar" name="id_actualizar" value="">
    <div class="flex flex-row">
        <!-- Otros campos del formulario -->
        <div class="ml-28">
            <label for="placa" class="block text-sm font-medium text-gray-700">Placa</label>
            <input id="placa" name="placa" type="text"
                class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                style="border-color: #575757" placeholder="  Placa">
        </div>
        <div class="ml-28">
            <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
            <input id="marca" name="marca" type="text"
                class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                style="border-color: #575757" placeholder="  Marca">
        </div>
        <div class="ml-28">
            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
            <input id="modelo" name="modelo" type="text"
                class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                style="border-color: #575757" placeholder="  Modelo">
        </div>
        <div class="ml-28">
            <label for="anio" class="block text-sm font-medium text-gray-700">Año</label>
            <input id="anio" name="anio" type="text"
                class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                style="border-color: #575757" placeholder="  Año">
        </div>
        <div class="ml-28">
            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
            <input id="color" name="color" type="text"
                class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                style="border-color: #575757" placeholder="  Color">
        </div>
    </div>
    <div>
        <div class="flex flex-row">
            <div class="ml-28">
                <label for="num_motor" class="block text-sm font-medium text-gray-700">Número de Motor</label>
                <input id="num_motor" name="num_motor" type="text"
                    class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                    style="border-color: #575757" placeholder="  Número de Motor">
            </div>
            <div class="ml-28">
                <label for="num_chasis" class="block text-sm font-medium text-gray-700">Número de Chasis</label>
                <input id="num_chasis" name="num_chasis" type="text"
                    class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                    style="border-color: #575757" placeholder="  Número de Chasis">
            </div>
            <div class="ml-28">
                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Vehículo</label>
                <input id="tipo" name="tipo" type="text"
                    class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                    style="border-color: #575757" placeholder="  Tipo de Vehículo">
            </div>
            <div class="ml-28">
                <label for="propietario" class="block text-sm font-medium text-gray-700">Propietario</label>
                <input id="propietario" name="propietario" type="text"
                    class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                    style="border-color: #575757" placeholder="  Propietario">
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <button id="btnActualizar" type="button"
            class="bg-[#ffde59] px-4 py-2 font-bold rounded-full text-[#1A5564] mt-4"
            style="width: 180px; color: black">
            Guardar
        </button>
    </div>
</form>

<!-- Contenido del CRUD -->
<section class="flex flex-col flex-grow px-8">

    <h2 class="text-2xl font-bold">CRUD</h2>

    <!-- Selector de tablas -->
    <div>
        <div class="flex justify-between mb-4 mt-6">
            <div>
                <label for="bd">Seleccionar tabla:</label>
                <select name="bd" id="tablas" onchange="location = this.value;"
                    class="bg-white border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                    style="border-color: #575757">
                    <option value="crud.php">Automovil</option>
                </select>
            </div>
            <div>
                <form method="post" action="">
                    <label for="buscador">Buscar:</label>
                    <input id="buscador" name="buscador" type="text"
                        class="border-2 border-gray-300 text-gray-900 text-sm rounded-full p-1.5"
                        style="border-color: #575757" value="<?php echo htmlspecialchars($busqueda); ?>">
                    <button type="submit" id="btnBuscar" class="bg-[#ffde59] px-4 py-2 mt-1 ml-2 font-bold rounded-full"
                        style="color: black">
                        Buscar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tablas -->
    <div class="overflow-x-auto mb-14">
        <table class="min-w-full bg-white mx-auto border-2 border-gray-300 rounded-lg shadow-lg text-center"
            id="cuerpoTabla">
            <thead class="bg-[#1A5564] text-white">
                <tr>
                    <th class="py-3 px-4">Placa</th>
                    <th class="py-3 px-4">Marca</th>
                    <th class="py-3 px-4">Modelo</th>
                    <th class="py-3 px-4">Año</th>
                    <th class="py-3 px-4">Color</th>
                    <th class="py-3 px-4">N° de Motor</th>
                    <th class="py-3 px-4">N° de Chasis</th>
                    <th class="py-3 px-4">Tipo</th>
                    <th class="py-3 px-4">Propietario</th>
                    <th class="py-3 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if (!empty($resultados)): ?>
                    <?php foreach ($resultados as $row): ?>
                        <tr id="row-<?php echo $row['id']; ?>">
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['placa']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['marca_id']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['modelo_id']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['anio']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['color']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['num_motor']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['num_chasis']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['tipo_id']); ?></td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($row['propietario_id']); ?></td>
                            <td class="py-3 px-4">
                                <!-- Botón para eliminar el automóvil -->
                                <button class="bg-red-500 text-white px-4 py-1 rounded-full"
                                    onclick="eliminarAutomovil(<?php echo $row['id']; ?>)">Eliminar</button>
                                <button class="bg-blue-500 text-white px-4 py-1 rounded-full"
                                    onclick="editarAutomovil(<?php echo $row['id']; ?>)">Actualizar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="py-3 px-4 text-center">No se encontraron resultados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include('templates/footer.php'); ?>

<!-- Código JavaScript -->
<script>
    function eliminarAutomovil(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este automóvil?')) {
            const formData = new FormData();
            formData.append('id_eliminar', id);

            fetch('crud.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Eliminar la fila de la tabla
                    const row = document.getElementById(`row-${id}`);
                    row.parentNode.removeChild(row);
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al intentar eliminar el automóvil.');
            });
        }
    }

    function editarAutomovil(id) {
        fetch(`crud.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const automovil = data.automovil;
                document.getElementById('id_actualizar').value = automovil.id;
                document.getElementById('placa').value = automovil.placa;
                document.getElementById('marca').value = automovil.marca_id;
                document.getElementById('modelo').value = automovil.modelo_id;
                document.getElementById('anio').value = automovil.anio;
                document.getElementById('color').value = automovil.color;
                document.getElementById('num_motor').value = automovil.num_motor;
                document.getElementById('num_chasis').value = automovil.num_chasis;
                document.getElementById('tipo').value = automovil.tipo_id;
                document.getElementById('propietario').value = automovil.propietario_id;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al intentar obtener los datos del automóvil.');
        });
    }

    document.getElementById("btnActualizar").addEventListener("click", function () {
    const form = document.getElementById("formActualizar");
    const formData = new FormData(form);

    // Enviar los datos del formulario usando Fetch API
    fetch('crud.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la red');
        }
        return response.json(); // Convertir la respuesta a JSON
    })
    .then(data => {
        alert(data.message); // Muestra el mensaje de éxito o error
        if (data.success) {
            // Aquí puedes redirigir o recargar la tabla de automóviles si es necesario
            location.reload(); // Recargar la página para mostrar los cambios
        }
    })
    .catch(error => {
        console.error('Error:', error); // Manejo de errores
        alert('Ha ocurrido un error al actualizar el automóvil.'); // Mensaje de error al usuario
    });
});

</script>
