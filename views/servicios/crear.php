<h1 class="nombre-pag">Crear Servicio</h1>
<p class="descripcion-pag">Llena los datos para crear un nuevo servicio</p>

<?php 

    @include_once __DIR__ . '/../templates/barra.php'; 
    @include_once __DIR__ . '/../templates/alertas.php';

?>

<form action="/servicios/crear" class="formulario" method="POST">
    <?php @include_once __DIR__ . '/formulario.php';?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>