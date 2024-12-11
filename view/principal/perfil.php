<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php?info=1');
    exit;
}

require_once "../../model/db.php";

$usuario_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT nombre, apellidos, correo, telefono, direccion, fecha_nacimiento FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuario no encontrado.");
}

include_once "../plantillas/header.php";
?>
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../recursos/css/perfil.css">
</head>
<body>
    <main class="container">
    <?php include "../plantillas/header.php"; ?>
    <div class="perfil-container">
        <h1>Mi Perfil</h1>
        <div class="perfil-card">
            <p><strong>Nombre:</strong> <?= $usuario['nombre'] . ' ' . $usuario['apellidos'] ?></p>
            <p><strong>Correo:</strong> <?= $usuario['correo'] ?></p>
            <p><strong>Teléfono:</strong> <?= $usuario['telefono'] ?: "No especificado" ?></p>
            <p><strong>Dirección:</strong> <?= $usuario['direccion'] ?: "No especificado" ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?= $usuario['fecha_nacimiento'] ?></p>
        </div>
        <a href="../principal/index.php" class="btn-regresar">Volver al inicio</a>
    </div>
<?php include "../plantillas/footer.php"; ?>