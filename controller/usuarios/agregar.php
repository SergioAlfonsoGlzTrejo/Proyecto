<?php
   include_once "../../model/db.php";

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nombre = $_POST['nombre'] ?? null;
      $apellidos = $_POST['apellidos'] ?? null;
      $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
      $edad = date('Y') - $fecha_nacimiento;
      $telefono = $_POST['telefono'] ?? null;
      $correo = $_POST['correo'] ?? null;
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $direccion = $_POST['direccion'] ?? null;

      if(empty($nombre) || !is_numeric($edad) || empty($correo)) {
         if(isset($_GET['origen']) && $_GET['origen']==='admin') {
            header("Location: ../../view/formularios/usuarios.php?error=1&origen=admin");
         } else {
            header("Location: ../../view/formularios/usuarios.php?error=1");
         }
         
         exit;
      }

      if(!is_numeric($edad) || $edad < 18) {
         if(isset($_GET['origen']) && $_GET['origen']==='admin') {
            header("Location: ../../view/formularios/usuarios.php?error=2&origen=admin");
         } else {
            header("Location: ../../view/formularios/usuarios.php?error=2");
         }
         exit;
      }

      if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
         if(isset($_GET['origen']) && $_GET['origen']==='admin') {
            header("Location: ../../view/formularios/usuarios.php?error=3&origen=admin");
         } else {
            header("Location: ../../view/formularios/usuarios.php?error=3");
         }
         exit;
      }

      // Guardar el usuario...
      try {
         $sql = "INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, telefono, correo, password, direccion) VALUES (:nombre, :apellidos, :fecha_nacimiento, :telefono, :correo, :password, :direccion)";
         $parametros = [
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':password' => $password,
            ':direccion' => $direccion,
         ];
         $query = $pdo->prepare($sql);
         $query->execute($parametros);
         header("Location: ../../view/principal/usuarios.php?ok=1");
         exit;
      } catch (PDOException $e) {
         die("Error al guardar el usuario: " . $e->getMessage());
      }
   }
?>