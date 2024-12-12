<?php
   session_start();
   include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/registrarse.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-index.php'; ?>
</head>
<body>
<main class="container">

<?php if(isset($_GET) && $_GET['origen']==='admin'): ?>
   <a href="../../view/admin/usuarios.php" role="button"><i class="ph ph-arrow-left"></i> Volver al panel de usuarios</a>
<?php endif; ?>

<?php if(isset($_GET) && $_GET['error']==1): ?>
   <article id="error1" class="error">
      <i class="ph ph-x"></i> Todos los campos son requeridos
   </article>
<?php elseif(isset($_GET) && $_GET['error']==2): ?>
   <article id="error2" class="error">
      <i class="ph ph-x"></i> La edad debe ser mayor de 18
   </article>
<?php elseif(isset($_GET) && $_GET['error']==3): ?>
   <article id="error3" class="error">
      <i class="ph ph-x"></i> El correo electrónico no es válido
   </article>
<?php elseif(isset($_GET) && $_GET['info']==1): ?>
   <article id="info1" class="info">
      <i class="ph ph-info"></i> Operación cancelada
   </article>
<?php endif; ?>

<h2 style="text-align: center;">
   <?php 
      if(isset($_GET) && $_GET['origen']==='admin'):
         echo "Nuevo usuario";
      else:
         echo "Regístrate";
      endif;
   ?>
</h2>
<form action="../../controller/usuarios/agregar.php?origen=admin" method="post">
   <div class="form-info">
      <div>
         <fieldset>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
         </fieldset>
         <fieldset>
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" required>
         </fieldset>
         <fieldset>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
         </fieldset>
      </div>
      <div>
         <fieldset>
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" required>
         </fieldset>
         <fieldset>
            <label for="correo">Correo electrónico</label>
            <input type="text" id="correo" name="correo" required>
         </fieldset>
         <fieldset>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
         </fieldset>
      </div>
   </div>
   <fieldset>
      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" name="direccion" required>
   </fieldset>
   <fieldset>
      <button type="submit">Crear cuenta</button>
   </fieldset>
</form>

<?php
   include_once "../plantillas/footer.php";
?>