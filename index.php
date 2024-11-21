<?php include('templates/header.php'); ?>

<div class="flex flex-col md:flex-row justify-center items-center mx-40 mb-24">
    <div class="w-full rounded bg-white p-6 md:mx-2 shadow-xl">
        <h1 class="mt-6 text-[#ff0000] text-3xl font-bold md:text-4xl text-center">Bienvenido al Sistema de Gestión de
            Automóviles</h1>
        <br><br><br>
        <div class="flex flex-wrap justify-center mb-8">

            <!-- Botón de registrar un nuevo propietario -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4">
                <img src="resources/propietario.png" alt="PROPI" class="w-10">
                <a href="registrar_propietario.php"
                    class="text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Registrar un Nuevo Propietario
                </a>
            </div>

            <!-- Botón de registrar un nuevo automóvil -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4">
                <img src="resources/coche2.png" alt="AUTO" class="w-14">
                <a href="registrar_automovil.php"
                    class="text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Registrar un Nuevo Automóvil
                </a>
            </div>

            <!-- Botón de registrar un seguro -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4">
                <img src="resources/seguro-de-auto.png" alt="AUTO" class="w-14">
                <a href="registrar_seguro.php"
                    class="text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Registrar un Seguro
                </a>
            </div>

            <!-- Botón de registrar registro vehicular -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4 mr-12">
                <img src="resources/registro-vehicular.png" alt="AUTO" class="w-12">
                <a href="obtener_registro_vehicular.php"
                    class="text-black font-medium rounded-lg text-sm px-7 py-4 text-center">
                    Obtener Registro Vehicular
                </a>
            </div>

            <!-- Botón de consultar registros vehiculares (JSON) -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4">
                <img src="resources/json-icon.png" alt="JSON" class="w-12">
                <a href="api/get_vehiculos.php" target="_blank"
                    class="text-black font-medium rounded-lg text-sm px-8 py-4 text-center">
                    Consultar Registros JSON
                </a>
            </div>

            <!-- Botón de administrar automóviles -->
            <div class="flex items-center bg-[#ffde59] p-3 rounded-lg shadow-md hover:bg-[#dbc04f] mr-7 mb-4">
                <img src="resources/crud.png" alt="ADMI-AUTO" class="w-10">
                <a href="crud.php" class="text-black font-medium rounded-lg text-sm px-3 py-4 text-center">
                    Administrar Automóviles
                </a>
            </div>
        </div>
    </div>


</div>
</div>

<?php include('templates/footer.php'); ?>