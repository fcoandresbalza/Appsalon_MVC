<h1 class="nombre-pag">¿Olvidaste tu clave?</h1>
<p class="descripcion-pag">Introduce tu Email para Recuperar tu Password</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" method="POST" action="/olvidar">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Tu email" >
    </div>

    <input type="submit" value="Enviar Email" class="boton">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
</div>