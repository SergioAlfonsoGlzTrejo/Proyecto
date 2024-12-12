<?php
   session_start();
   if (!isset($_SESSION['user'])) {
      header('Location: ../principal/login.php?info=1');
  } elseif ($_SESSION['user']['rol'] !== 'admin') {
      header('Location: ../principal/index.php?warning=1');
  }

   require_once "../../model/db.php";
   $sql = "SELECT * FROM vista_usuarios";
   $query = $pdo->query($sql);
   $query->execute();

   $items = $query->fetchAll(PDO::FETCH_ASSOC);

   $titulo = "Gestor de usuarios";
   
   include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/admin/usuarios.css">
<script src="../../assets/js/alertas.js" defer></script>
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
<a href="../admin/panel.php" role="button"><i class="ph ph-arrow-left"></i> Volver al panel de administración</a>
<article>
   <?php if(isset($_GET) && $_GET['ok']==1): ?>
      <article class="ok">
         <i class="ph ph-check"></i> Usuario creado con éxito
      </article>
   <?php elseif(isset($_GET) && $_GET['ok']==2): ?>
      <article class="ok">
         <i class="ph ph-check"></i> Usuario actualizado con éxito
      </article>
   <?php elseif(isset($_GET) && $_GET['ok']==3): ?>
      <article class="ok">
         <i class="ph ph-check"></i> Usuario eliminado con éxito
      </article>
   <?php elseif(isset($_GET) && $_GET['error']==1): ?>
      <article class="error">
         <i class="ph ph-x"></i> Ocurrió un error al crear el usuario
      </article>
   <?php elseif(isset($_GET) && $_GET['info']==1): ?>
      <article id="info1" class="info">
         <i class="ph ph-info"></i> Operación cancelada
      </article>
   <?php endif; ?>
   <div class="overflow-auto">
      <section>
         <p>Lista de usuarios</p>
         <a href="../formularios/usuarios.php?origen=admin" role="button">Nuevo usuario</a>
      </section>
      <table class="table">
         <thead>
            <tr>
               <th>Nombre</th>
               <th>Correo electrónico</th>
               <th>Opciones</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($items as $item): ?>
               <tr>
                  <td><?= $item['nombre'] ?></td>
                  <td><?= $item['correo'] ?></td>
                  <td>
                     <?php if($item['rol']==='admin'): ?>
                        <p><i class="ph ph-pencil"></i> Editar</p>
                        <p><i class="ph ph-trash"></i> Eliminar</p>
                     <?php else: ?>
                        <a href="../../view/formularios/editar_usuarios.php?id=<?= $item['id'] ?>" role="button"><i class="ph ph-pencil"></i> Editar</a>
                        <a href="../../controller/usuarios/eliminar.php?id=<?= $item['id'] ?>" role="button"><i class="ph ph-trash"></i> Eliminar</a>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</article>
<?php include_once "../plantillas/footer.php"?>