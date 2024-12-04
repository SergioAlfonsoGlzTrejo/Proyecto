<?php
   include_once "db.php";

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nombre = $_POST['nombre'] ?? null;
      $apellidos = $_POST['apellidos'] ?? null;
      $edad = $_POST['edad'] ?? null;
      $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
      $correo = $_POST['correo'] ?? null;

      if(empty($nombre) || empty($edad) || empty($correo)) {
         header("Location: formulario.php?error=1");
         exit;
      }

      if(!is_numeric($edad) || $edad < 18) {
         header("Location: formulario.php?error=2");
         exit;
      }

      if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
         header("Location: formulario.php?error=3");
         exit;
      }

      // Guardar el usuario...
      try {
         $sql = "INSERT INTO usuarios (nombre, apellidos, edad, fecha_nacimiento, correo) VALUES (:nombre, :apellidos, :edad, :fecha_nacimiento, :correo)";
         $query = $pdo->prepare($sql);
         $query->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':edad' => $edad,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':correo' => $correo,
         ]);
         header("Location: usuarios.php?ok=1");
         exit;
      } catch (PDOException $e) {
         die("Error al guardar el usuario: " . $e->getMessage());
      }
   }
?>