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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.red.min.css">
<link rel="stylesheet" href="../recursos/css/common.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">

<article>
   <h2>Lista de usuarios</h2>
   <a href="formulario.php" role="button">Nuevo usuario</a>
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
   <?php elseif(isset($_GET)): ?>   
      <article class="ok">
         <i class="ph ph-check"></i> Sesión iniciada correctamente
      </article>
   <?php endif; ?>
   <div class="overflow-auto">
      <table class="table">
         <thead>
            <tr>
               <th>Nombre</th>
               <th>Edad</th>
               <th>Fecha de nacimiento</th>
               <th>Correo electrónico</th>
               <th>Eliminar</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($items as $item): ?>
               <tr>
                  <td><?= $item['nombre'] ?></td>
                  <td><?= $item['edad'] ?></td>
                  <td><?= $item['fecha_nacimiento'] ?></td>
                  <td><?= $item['correo'] ?></td>
                  <td>
                     <?php if($item['rol']==='admin'): ?>
                        <button class="desactivado" type="button" disabled><i class="ph ph-trash"></i> Eliminar</button>
                     <?php else: ?>
                        <a href="../../controller/usuarios/eliminar.php?id=<?= $item['id'] ?>" role="button"><i class="ph ph-trash"></i> Eliminar</a>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</article>