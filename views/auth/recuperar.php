<h1 class="nombre-pag"> Reestablecer Password</h1>
<p class="descripcion-pag">Escribe tu nueva contraseña</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if ($error) return; ?>
<form class="formulario" method="POST">
    
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Tu Password">
    </div>

    
    <input type="submit" value="Guardar nuevo password" class="boton">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>