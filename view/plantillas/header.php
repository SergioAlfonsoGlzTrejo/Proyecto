<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $titulo ?? "EkoBazar" ?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.red.min.css">
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css"/>
</head>
<body>
   <main class="container">
      <h1><?= $titulo ?? "EkoBazar" ?></h1>
      <nav>
      <ul>
        <?php if (isset($_SESSION['user'])): ?>
          <li style="font-weight: bold;">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</li>
          <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
        <?php else: ?>
          
          <li><a href="../../view/login/iniciar_sesion.php">Iniciar sesión</a></li>
          <li><a href="../../view/principal/formulario.php">Regístrate</a></li>
        <?php endif; ?>
      </ul>
      </nav>