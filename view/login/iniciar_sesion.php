<?php session_start(); ?>

<?php include '../plantillas/header.php'; ?>

<?php if (isset($_GET) && $_GET['error']==1): ?>
<article>
   <i class="ph ph-x" style="color: red; font-size: 20px"></i> Correo o contraseña incorrectos
</article>
<?php endif; ?>

<article class="form">
  <h2 style="text-align: center;">Iniciar sesión</h2>

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

<?php include '../plantillas/footer.php'; ?>