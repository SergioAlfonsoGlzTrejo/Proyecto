<?php
   include_once "header.php";
?>

<?php if(isset($_GET) && $_GET['error']): ?>
   <article>
      <?php
      switch ($_GET['error']) {
         case 1:
            echo "⨉ Todos los campos son requeridos";
         break;
         case 2:
            echo "⨉ La edad debe ser mayor de 18";
         break;
         case 3:
            echo "⨉ El correo electrónico no es válido";
         break;
      }
      ?>
   </article>
<?php endif; ?>

<form action="agregar.php" method="post">
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
   <fieldset>
      <label for="correo">Correo electrónico</label>
      <input type="text" id="correo" name="correo" required>
   </fieldset>
   <fieldset>
      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" required />
   </fieldset>
   <fieldset>
      <button type="submit">
         <i class="ph ph-paper-plane-right"></i>
         Enviar
      </button>
   </fieldset>
</form>

<?php
   include_once "footer.php";
?>