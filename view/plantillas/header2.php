<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $titulo ?? "EkoBazar" ?></title>
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css"/>
   <link rel="stylesheet" type="text/css" href="../resources/css/iniciar_sesion.css"/>
   <script src="../resources/js/iniciar_sesion.js" defer></script>
</head>
<body>
  <nav>
     <h1><?= $titulo ?? "EkoBazar" ?></h1>
     <ul>
       <?php if (isset($_SESSION['user'])): ?>
         <li style="font-weight: bold;">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</li>
         <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
       <?php else: ?>
        <li><a href="../../view/principal/index.php">inicio</a></li>
         <li><a href="../../view/login/iniciar_sesion.php">Iniciar sesión</a></li>
         <li><a href="../../view/principal/formulario.php">Regístrate</a></li>
       <?php endif; ?>
     </ul>
  </nav>
  <main class="container">