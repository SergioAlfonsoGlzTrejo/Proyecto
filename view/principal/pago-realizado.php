<?php session_start();
   include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/pago-realizado.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <a class="atras" href="index.php"><i class="ph ph-house"></i> Volver al inicio</a>
    <section>
        <p class="titulo animacion-degradado1">¡Gracias por tu compra!</p>
        <p class="texto">Tu pago ha sido procesado exitosamente.</p>
    </section>
    <img src="../../assets/img/pix-happy.png" alt="¡Felicidades!">
<?php include '../plantillas/footer.php'; ?>