<?php
require_once "../../model/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $precio = $_POST['precio'];
    $precio_mayoreo = $_POST['precio_mayoreo'] ?? null;
    $imagen_url = $_POST['imagen_url'] ?? null;
    $stock = $_POST['stock'] ?? null;

    if (!empty($_FILES['archivo']['name'])) {
        $nombreArchivo = basename($_FILES['archivo']['name']);
        $rutaDestino = "../../uploads/" . $nombreArchivo;
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {
            $imagen_url = $rutaDestino;
        }
    }

    try {
        if (isset($_POST['id'])) {
            $sql = "UPDATE productos SET nombre = :nombre, marca = :marca, descripcion = :descripcion, 
                    precio = :precio, precio_mayoreo = :precio_mayoreo, imagen_url = :imagen_url, stock = :stock
                    WHERE id = :id";
            $parametros = [
                'nombre' => $nombre,
                'marca' => $marca,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'precio_mayoreo' => $precio_mayoreo,
                'imagen_url' => $imagen_url,
                'stock' => $stock,
                'id' => $_POST['id']
            ];
        } else {
            $sql = "INSERT INTO productos (nombre, marca, descripcion, precio, precio_mayoreo, imagen_url, stock) 
                    VALUES (:nombre, :marca, :descripcion, :precio, :precio_mayoreo, :imagen_url, :stock)";
            $parametros = [
                'nombre' => $nombre,
                'marca' => $marca,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'precio_mayoreo' => $precio_mayoreo,
                'imagen_url' => $imagen_url
            ];
        }
    
        $query = $pdo->prepare($sql);
        $query->execute($parametros);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    header("Location: ../../view/admin/productos.php?ok=1");
    exit();
}