<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../principal/login.php');
    exit;
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../principal/index.php?warning=1');
    exit;
}

require_once "../../controller/usuarios/editar.php";
include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/editar_usuarios.css">
<title>Editar perfil</title>
<script src="../recursos/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <p class="titulo">Editar perfil</p>
    <a href="../admin/usuarios.php" role="button"><i class="ph ph-arrow-left"></i> Volver al panel de usuarios</a>
    <div>
        <form action="../../controller/usuarios/editar.php" method="POST">
            <div class="form-info">
                <div>
                    <fieldset>
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
                    </fieldset>
                    <fieldset>
                        <label for="apellidos">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?= $usuario['apellidos'] ?>" required>
                    </fieldset>
                    <fieldset>
                        <label for="correo">Correo electrónico</label>
                        <input type="email" id="correo" name="correo" value="<?= $usuario['correo'] ?>" required>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="<?= $usuario['telefono'] ?>">
                    </fieldset>
                    <fieldset>
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>" required>
                    </fieldset>
                    <fieldset class="direccion">
                        <label for="direccion">Dirección</label>
                        <textarea id="direccion" name="direccion" rows="3"><?= $usuario['direccion'] ?></textarea>
                    </fieldset>
                </div>
            </div>
            <div class="botones">
                <button type="submit" class="btn-guardar"><i class="ph ph-check"></i> Guardar cambios</button>
                <a class="btn-cancelar" href="../admin/usuarios.php?info=1" class="btn-cancelar"><i class="ph ph-x"></i> Cancelar</a>
            </div>
        </form>
    </div>
<?php include_once "../plantillas/footer.php"; ?>