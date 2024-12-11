<nav>
   <a href="../../view/principal/index.php">
      <h1><?= $titulo ?? "EkoBazar" ?></h1>
   </a>
   <ul> 
      <?php if (!isset($_SESSION['user'])): ?>
         <li><a href="../../view/principal/login.php">Iniciar sesión</a></li>
         <li><a href="../../view/principal/formulario.php">Regístrate</a></li>
      <?php elseif ($_SESSION['user']['rol'] === 'cliente'): ?>
         <li><a href="../../view/principal/carrito.php"><i class="ph ph-shopping-cart"></i> Carrito</a></li>
         <li style="font-weight: bold;"><a href="perfil.php">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</a></li>
         <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
      <?php elseif ($_SESSION['user']['rol'] === 'admin'): ?>
         <li><a class="animacion-degradado2" href="../admin/panel.php">Panel de administración</a></li>
         <li style="font-weight: bold;"><a href="perfil.php">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</a></li>
         <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
      <?php endif; ?>
   </ul>
</nav>