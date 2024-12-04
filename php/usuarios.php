<?php
   session_start();
   if (!isset($_SESSION['user'])) header('Location: login.php');

   require_once "db.php";
   $sql = "SELECT * FROM vista_usuarios";
   $query = $pdo->query($sql);
   $query->execute();

   $items = $query->fetchAll(PDO::FETCH_ASSOC);

   $titulo = "Gestor de usuarios";
   
   include_once "header.php";
?>
<article>
   <h2>Lista de usuarios</h2>
   <a href="formulario.php" role="button">Nuevo usuario</a>
   <?php if(isset($_GET) && $_GET['ok']==1): ?>
      <article>
         ✅ Nuevo usuario guardado con éxito 
      </article>
   <?php elseif(isset($_GET) && $_GET['ok']==2): ?>
      <article>
         ✅ Usuario actualizado con éxito 
      </article>
   <?php elseif(isset($_GET) && $_GET['ok']==3): ?>
      <article>
         ✅ Usuario eliminado con éxito 
      </article>
   <?php elseif(isset($_GET)): ?>   
      <article>
         ✅ Sesión iniciada correctamente
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
               <th>
                  <i class="ph ph-gear-six"></i>
                  Eliminar
               </th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($items as $item): ?>
               <tr>
                  <td><?= $item['nombre'] ?></td>
                  <td><?= $item['edad'] ?></td>
                  <td><?= $item['fecha_nacimiento'] ?></td>
                  <td><?= $item['correo'] ?></td>
                  <td><a href="eliminar.php?id=<?= $item['id'] ?>" role="button">Eliminar</a></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</article>
<?php
   include_once "footer.php";
?>