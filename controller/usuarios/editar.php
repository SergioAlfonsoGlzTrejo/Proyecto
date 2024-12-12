<?php
session_start();
require_once "../../model/db.php";

$usuario_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    if (empty($nombre) || empty($apellidos) || empty($correo) || empty($fecha_nacimiento)) {
        header("Location: ../../view/formularios/editar_usuarios.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            UPDATE usuarios 
            SET nombre = ?, apellidos = ?, correo = ?, telefono = ?, direccion = ?, fecha_nacimiento = ?
            WHERE id = ?
        ");
        $stmt->execute([$nombre, $apellidos, $correo, $telefono, $direccion, $fecha_nacimiento, $usuario_id]);
        header("Location: ../../view/principal/perfil.php");
        exit;
    } catch (Exception $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
        header("Location: ../../view/admin/usuarios.php?error=1");
        exit;
    }
}

$stmt = $pdo->prepare("SELECT nombre, apellidos, correo, telefono, direccion, fecha_nacimiento FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuario no encontrado.");
}