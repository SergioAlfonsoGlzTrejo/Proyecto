<?php
require_once "db.php";

if (isset($_GET['id'])){
   $sql = "DELETE FROM usuarios WHERE id = :id";
   $query = $pdo->prepare($sql);
   $query->execute(array($_GET['id']));
}

header("Location: usuarios.php?ok=3");