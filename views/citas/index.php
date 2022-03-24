<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h1 class="nombre-pag">Citas</h1>
<p class="descripcion-pag">Introduce tus datos y elige tus servicios</p>


<div id="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige los servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Datos y fecha</h2>
        <p class="text-center">Coloca tus datos y fecha de la cita</p>
        
        <form class="formulario" action="">

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" 
                value="<?php echo $nombre; ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" placeholder="Tu nombre" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" placeholder="Tu nombre">
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>">

        </form> 
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que los datos sean correctos</p>
        
    </div>


    <div class="paginacion">
        <button id="anterior" class="boton"> &laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script = "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script src='build/js/app.js'></script>
    "
?>