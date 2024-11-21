<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Auto PTY</title>
    <style>
        /*body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            /* Cambié el fondo gris a blanco */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .header {
            background-color: #1d4b8c;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid #e0c080;
        }

        .header img {
            width: 60px;
            height: 60px;
        }

        .header h1 {
            font-size: 32px;
            color: white;
            text-align: center;
            margin: 0;
        }

        /* Container para contenido */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Titulos*/
        h2 {
            font-size: 24px;
            color: #1d4b8c;
            margin-bottom: 10px;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            /* Asegura que la tabla tenga fondo blanco */
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-heading {
            font-weight: bold;
            color: #444;
        }
    </style>
</head>

<body>

    <!-- Encabezado-->
    <div class="header">
        <h1>REGISTRAR AUTO PTY</h1>
    </div>

    <!-- Contenido-->
    <div class="container">
        <!-- Sección de Propietario-->
        <section>
            <h2>Datos del Propietario</h2>
            <table>
                <tr>
                    <th class="table-heading">Nombre</th>
                    <td><?= htmlspecialchars($result['propietario_nombre'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Cédula</th>
                    <td><?= htmlspecialchars($result['propietario_cedula'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Tipo</th>
                    <td><?= htmlspecialchars($result['propietario_tipo'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Domicilio</th>
                    <td><?= htmlspecialchars($result['propietario_domicilio'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Teléfono</th>
                    <td><?= htmlspecialchars($result['propietario_telefono'] ?? 'N/A') ?></td>
                </tr>
            </table>
        </section>

        <!-- Seccion de Vehículo -->
        <section>
            <h2>Datos del Vehículo</h2>
            <table>
                <tr>
                    <th class="table-heading">VIN</th>
                    <td><?= htmlspecialchars($result['vin'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Placa</th>
                    <td><?= htmlspecialchars($result['placa'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Marca</th>
                    <td><?= htmlspecialchars($result['marca_id'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Modelo</th>
                    <td><?= htmlspecialchars($result['modelo_id'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Año</th>
                    <td><?= htmlspecialchars($result['anio'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Color</th>
                    <td><?= htmlspecialchars($result['color'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Tipo</th>
                    <td><?= htmlspecialchars($result['vehiculo_tipo'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Motor (cc)</th>
                    <td><?= htmlspecialchars($result['capacidad_motor'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Cilindros</th>
                    <td><?= htmlspecialchars($result['num_cilindros'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Combustible</th>
                    <td><?= htmlspecialchars($result['tipo_combustible'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Peso Bruto</th>
                    <td><?= htmlspecialchars($result['peso_bruto'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Transmisión</th>
                    <td><?= htmlspecialchars($result['transmision'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Aseguradora</th>
                    <td><?= htmlspecialchars($result['nom_aseguradora'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Póliza</th>
                    <td><?= htmlspecialchars($result['no_poliza'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="table-heading">Vigencia</th>
                    <td><?= htmlspecialchars($result['fecha_inicio'] ?? 'N/A') ?> -
                        <?= htmlspecialchars($result['fecha_fin'] ?? 'N/A') ?>
                    </td>
                </tr>
            </table>
        </section>
    </div>

</body>

</html>