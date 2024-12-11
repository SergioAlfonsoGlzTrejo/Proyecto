<nav>
   <a href="../../view/principal/index.php">
     <h1><?= $titulo ?? "EkoBazar" ?></h1>
   </a>
   <ul>
     <?php if (isset($_SESSION['user'])): ?>
       <li style="font-weight: bold;"><a href="../principal/perfil.php">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</a></li>
       <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
     <?php else: ?>
       <li><a href="../../view/principal/login.php">Iniciar sesión</a></li>
       <li><a href="../../view/formularios/usuarios.php">Registrarse</a></li>
     <?php endif; ?>
   </ul>
</nav>