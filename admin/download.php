<?php
// ARCHIVO: admin/download.php
// Este archivo permite descargar imágenes desde el panel de administrador

session_start();
require_once '../config/database.php';

// Proteger la página: solo usuarios autenticados pueden descargar
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(403);
    die('Error: Acceso denegado. Debes iniciar sesión.');
}

// Verificar que se haya especificado un archivo
if (isset($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filepath = '../uploads/' . $filename;

    // Verificar que el archivo existe
    if (file_exists($filepath)) {
        // Verificar que el archivo existe en la base de datos (seguridad adicional)
        $stmt = $conn->prepare("SELECT id FROM imagenes WHERE nombre_archivo = ?");
        $stmt->bind_param("s", $filename);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Headers para forzar la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            
            // Limpiar el buffer de salida
            ob_clean();
            flush();
            
            // Leer y enviar el archivo
            readfile($filepath);
            exit;
        } else {
            http_response_code(404);
            die('Error: El archivo no está registrado en la base de datos.');
        }
        
        $stmt->close();
    } else {
        http_response_code(404);
        die('Error: El archivo no existe en el servidor.');
    }
} else {
    http_response_code(400);
    die('Error: No se especificó ningún archivo.');
}

$conn->close();
?>