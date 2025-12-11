<?php
// ARCHIVO: config/database.php (ACTUALIZADO)

// Configuración de la base de datos
$db_host = 'localhost';
$db_name = 'vidabyte_galeriadb'; // Asegúrate que sea el nombre de tu BD en Banahosting
$db_user = 'vidabyte_usergaleriadb';       // ¡CAMBIA ESTO! Usa el usuario de BD de Banahosting
$db_pass = 'u*dj_K3dCh3=';           // ¡CAMBIA ESTO! Usa la contraseña de BD de Banahosting

// Crear conexión
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Chequear conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// NO MÁS CÓDIGO DE SESIÓN AQUÍ
?>