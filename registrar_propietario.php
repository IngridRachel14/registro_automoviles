<?php include('templates/header.php'); ?>

<div class="flex flex-col justify-center items-center mx-auto">
    <div class="w-full md:w-1/4 rounded bg-white p-6 md:mx-2 shadow-xl mb-16">
        <div class="mt-4 mb-6">
            <h2 class="text-xl text-center font-bold">Formulario para Registrar Propietario</h2>
        </div>

        <div class="mt-4 mb-6">
            <form id="formulario" action="procesar_registro_propietario.php" method="post" class="flex flex-col items-center">

                <label for="nombre"></label>
                <input type="text" id="nombre" name="nombre" required
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg  mb-2"
                    placeholder="Ingresa el nombre del Propietario" required><br>

                <select id="tipo_propietario" name="tipo_propietario"
                    class="w-full md:w-4/5 border-2 text-gray-900 text-sm p-2 rounded-lg mb-4" required>
                    <option value="" disabled selected>Selecciona el  del Tipo de Propietario</option>
                    <option value="natural">Natural</option>
                    <option value="juridico">Juridico</option>
                </select><br>

                <label for="cedula"></label>
                <input type="text" id="cedula" name="cedula"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa el Cédula del Propietario" required><br>

                <label for="telefono"></label>
                <input type="tel" id="telefono" name="telefono"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa el Número Celular del Propietario" required><br>

                <label for="dericcion"></label>
                <input type="text" id="direccion" name="direccion"
                    class="w-full md:w-4/5 border-2 border-[#444444] text-gray-900 text-sm p-2 rounded-lg mb-4"
                    placeholder="Ingresa la Dirección del Propietario" required><br>

                <input type="submit" value="Registrar"
                    class="text-black bg-[#ffde59] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
            </form>
        </div>
    </div>
</div>
<?php include('templates/footer.php'); ?>