<?php
// Archivo: search.php

// 1. Conexión a la base de datos
require_once 'config/database.php';

// 2. Preparar el array de resultados
$imagenes = [];

// 3. Obtener el término de búsqueda de forma segura
if (isset($_GET['term']) && !empty(trim($_GET['term']))) {
    $search_term = $conn->real_escape_string(trim($_GET['term']));
    
    // 4. Construir y ejecutar la consulta
    $sql = "SELECT * FROM imagenes WHERE nombre_archivo LIKE '%$search_term%' ORDER BY fecha_subida DESC";
    $result = $conn->query($sql);

    // 5. Llenar el array con los resultados
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagenes[] = $row;
        }
    }
} else {
    // Si no hay término de búsqueda, devolver todas las imágenes
    $sql = "SELECT * FROM imagenes ORDER BY fecha_subida DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagenes[] = $row;
        }
    }
}

$conn->close();

// 6. Devolver los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($imagenes);
?>