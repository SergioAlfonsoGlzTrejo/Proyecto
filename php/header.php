<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $titulo ?? "PHP Demo" ?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.jade.min.css">
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css"/>
</head>
<body>
   <main class="container">
      <h1><?= $titulo ?? "PHP Demo" ?></h1>
      <nav>
      <ul>
        <?php if (isset($_SESSION['user'])): ?>
          <li>Hola <?= $_SESSION['user']['nombre'] ?></li>
          <li><a href="logout.php">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="login.php">Iniciar sesión</a></li>
          <li><a href="formulario.php">Registrarse</a></li>
        <?php endif; ?>
      </ul>
      </nav>