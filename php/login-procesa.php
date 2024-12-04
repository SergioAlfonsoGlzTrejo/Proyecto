<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $correo = $_POST['correo'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM usuarios WHERE correo = :correo";
  $stmt = $pdo->prepare($sql);

  $stmt->execute([':correo' => $correo]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header('Location: usuarios.php');
  } else {
    header('Location: login.php?error=1');
  }
}