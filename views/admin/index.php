<h1 class="nombre-pag">Panel de Administración</h1>
<p class="descripcion-pag">Buscar Cita</p>

<div>
    <?php include_once __DIR__ . '/../templates/barra.php' ?>
</div>

<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>">
        </div>
    </form>
</div>

<div>
    <?php if(count($citas) === 0){
        echo '<h2>No hay citas para este día</h2>';
    } ?>
</div>

<div class="citas-admin">
    <ul class="citas">
        <?php $citaId = 0;
        foreach ($citas as $key=>$cita){
            if($citaId !== $cita->id){ 
                $total = 0;
        ?>
                <li>
                    <p>ID:<span> <?php echo $cita->id; ?></span></p>
                    <p>Hora:<span> <?php echo $cita->hora; ?></span></p>
                    <p>Cliente:<span> <?php echo $cita->cliente; ?></span></p>
                    <p>Email:<span> <?php echo $cita->email; ?></span></p>
                    <p>Teléfono:<span> <?php echo $cita->telefono; ?></span></p>
                </li>
                <h2>Servicios</h2>

            <?php $citaId = $cita->id;
            }; //fin del if ?>
            <p class="servicio"><?php echo $cita->servicio ." $". $cita->precio; ?></p>  
        <?php 
            $total += $cita->precio;
            $actual = $cita->id;
            $proximo = $citas[$key + 1]->id ?? 0;

            if(esUltimo($actual,$proximo)){ ?>
                <p class="total">Total: <span>$<?php echo $total; ?></span></p>

                <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
        <?php   } 
        }; //fin del foreach ?>
    </ul>

</div>

<?php
    $script = '<script src="build/js/buscador.js"></script>';
?>