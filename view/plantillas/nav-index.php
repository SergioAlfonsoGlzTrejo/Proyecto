<nav>
   <h1><?= $titulo ?? "EkoBazar" ?></h1>
   <ul> 
      <?php if (!isset($_SESSION['user'])): ?>
         <li><a href="../../view/principal/login.php">Iniciar sesión</a></li>
         <li><a href="../../view/principal/formulario.php">Regístrate</a></li>
      <?php elseif ($_SESSION['user']['rol'] === 'cliente'): ?>
         <li><a href="../../view/principal/carrito.php"><i class="ph ph-shopping-cart"></i></a></li>
         <li style="font-weight: bold;">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</li>
         <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
      <?php elseif ($_SESSION['user']['rol'] === 'admin'): ?>
         <li><a href="../../view/admin/usuarios.php">Gestor de usuarios</a></li>
         <li><a href="../../view/admin/productos.php">Gestor de productos</a></li>
         <li style="font-weight: bold;">Hola, <?= $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos']; ?> 👋</li>
         <li><a href="../../controller/login/logout.php">Cerrar sesión</a></li>
      <?php endif; ?>
   </ul>
</nav>