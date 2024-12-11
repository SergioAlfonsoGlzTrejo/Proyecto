<?php session_start();
   if (!isset($_SESSION['user'])) {
      header('Location: ../principal/login.php?info=1');
  } elseif ($_SESSION['user']['rol'] !== 'admin') {
      header('Location: ../principal/index.php?warning=1');
  }

  include_once "../../view/plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/admin/panel.css">
<script src="../../assets/js/alertas.js" defer></script>
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <a href="../principal/index.php" role="button"><i class="ph ph-arrow-left"></i> Volver al inicio</a>
    <article>
        <section>
            <p class="animacion-degradado1">Panel de administración</p>
            <img src="../../assets/img/admin.png" alt="admin">
        </section>
        <section class="opciones">
            <a class="opcion" href="../admin/usuarios.php">
                <i class="ph ph-user"></i>
                <div>
                    <h2>Usuarios</h2>
                    <p>Listar, añadir, editar y eliminar usuarios</p>
                </div>
            </a>
            <a class="opcion" href="../admin/productos.php">
                <i class="ph ph-backpack"></i>
                <div>
                    <h2>Productos</h2>
                    <p>Añadir, editar y eliminar productos</p>
                </div>
            </a>
            <a class="opcion" href="../admin/reportes.php">
                <i class="ph ph-files"></i>
                <div>
                    <h2>Reportes</h2>
                    <p>Generar reportes de pagos y ventas con filtros de fecha, usuarios y productos</p>
                </div>
            </a>
        </section>
    </article>
<?php include_once '../plantillas/footer.php'; ?>