<?php
require_once "../../model/db.php";

if (isset($_GET['id'])) {
    try {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $_GET['id']]);
        header("Location: ../../view/principal/productos.php?ok=3");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}