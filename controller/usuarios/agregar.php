<?php
   include_once "../../model/db.php";

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nombre = $_POST['nombre'] ?? null;
      $apellidos = $_POST['apellidos'] ?? null;
      $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
      $edad = date('Y') - $fecha_nacimiento;
      $correo = $_POST['correo'] ?? null;
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if(empty($nombre) || empty($edad) || empty($correo)) {
         header("Location: ../../view/principal/formulario.php?error=1");
         exit;
      }

      if(!is_numeric($edad) || $edad < 18) {
         header("Location: ../../view/principal/formulario.php?error=2");
         exit;
      }

      if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
         header("Location: ../../view/principal/formulario.php?error=3");
         exit;
      }

      // Guardar el usuario...
      try {
         $sql = "INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, correo, password) VALUES (:nombre, :apellidos, :fecha_nacimiento, :correo, :password)";
         $parametros = [
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':correo' => $correo,
            ':password' => $password,
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