<?php session_start(); ?>

<?php include '../plantillas/header2.php'; ?>

<?php if (isset($_GET) && $_GET['error']==1): ?>
<article id="error1">
   <i class="ph ph-x"></i> Correo o contraseña incorrectos
</article>
<?php endif; ?>

<section class="login">
  <h2>Iniciar sesión</h2>
  <article class="form">
    <form action="../../controller/login/login.php" method="post">
      <fieldset>
        <label for="correo">Correo electrónico</label>
        <input type="correo" name="correo" id="correo" required />
      </fieldset>
      <fieldset>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required />
      </fieldset>
      <button type="submit">Iniciar sesión <i class="ph ph-arrow-right"></i></button>
      <a href="../../view/login/recuperar_contrasena.php">¿Olvidaste tu contraseña?</a>
    </form>
  </article>
</section>

<?php include '../plantillas/footer.php'; ?>