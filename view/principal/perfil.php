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
<title>Perfil</title>
<link rel="stylesheet" href="../../assets/css/principal/perfil.css">
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
    <main class="container">
    <i class="ph ph-user"></i>
    <a href="../principal/index.php" role="button"><i class="ph ph-arrow-left"></i> Volver al inicio</a>
    <?php include "../plantillas/header.php"; ?>
    <div class="perfil-container">
        <p class="titulo">Mi perfil</p>
        <div class="perfil-card">
            <p><strong>Nombre:</strong> <?= $usuario['nombre'] . ' ' . $usuario['apellidos'] ?></p>
            <p><strong>Correo:</strong> <?= $usuario['correo'] ?></p>
            <p><strong>Teléfono:</strong> <?= $usuario['telefono'] ?: "No especificado" ?></p>
            <p><strong>Dirección:</strong> <?= $usuario['direccion'] ?: "No especificado" ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?= $usuario['fecha_nacimiento'] ?></p>
            <p><strong>Edad:</strong> <?= date_diff(date_create($usuario['fecha_nacimiento']), date_create('now'))->y ?> años</p>
            <p><strong>Rol:</strong> <?= $_SESSION['user']['rol'] ?></p>
        </div>
    </div>
<?php include "../plantillas/footer.php"; ?>