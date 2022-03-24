<h1 class="nombre-pag">Actualizar Servicio</h1>
<p class="descripcion-pag">Cambia los datos para actualizar un servicio</p>

<?php 

    @include_once __DIR__ . '/../templates/barra.php'; 
    @include_once __DIR__ . '/../templates/alertas.php';

?>


<form class="formulario" method="POST">
    <?php @include_once __DIR__ . '/formulario.php';?>
    <input type="submit" class="boton" value="Actualizar Servicio">

</form>