<?php session_start(); include '../plantillas/header.php'; ?>
<link rel="stylesheet" href="../recursos/css/login.css">
<script src="../recursos/js/alertas.js" defer></script>
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">

<?php if (isset($_GET) && $_GET['ok']==1): ?>
   <article id="ok1" class="ok">
      <i class="ph ph-check"></i> Sesión cerrada correctamente
   </article>
<?php elseif (isset($_GET) && $_GET['error']==1): ?>
<article id="error1" class="error">
   <i class="ph ph-x"></i> Correo o contraseña incorrectos
</article>
<?php elseif (isset($_GET) && $_GET['info']==1): ?>
<article id="info1" class="info">
   <i class="ph ph-info"></i> No has iniciado sesión
</article>
<?php elseif (isset($_GET) && $_GET['warning']==1): ?>
<article id="warning1" class="warning">
   <i class="ph ph-warning"></i> No tienes permiso para acceder a ese contenido
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