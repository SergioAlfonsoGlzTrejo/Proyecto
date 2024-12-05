<?php
require_once "../../model/db.php";

if (isset($_GET['id'])){
   $sql = "DELETE FROM usuarios WHERE id = :id";
   $query = $pdo->prepare($sql);
   $query->execute(array($_GET['id']));
}

header("Location: ../../view/principal/usuarios.php?ok=3");