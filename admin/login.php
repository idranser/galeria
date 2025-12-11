<?php
// ARCHIVO: admin/login.php (ACTUALIZADO)

session_start(); // <-- AÑADIR ESTA LÍNEA AL INICIO DE TODO

require_once '../config/database.php';

// Si ya está logueado, redirigir al panel de admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

$error_msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST["username"])) || empty(trim($_POST["password"]))) {
        $error_msg = 'Por favor, ingrese usuario y contraseña.';
    } else {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        // Preparar la consulta para evitar inyección SQL
        $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                // Verificar si el usuario existe
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        // Verificar la contraseña
                        if (password_verify($password, $hashed_password)) {
                            // Contraseña correcta, iniciar sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header("location: index.php");
                            exit;
                        } else {
                            // Contraseña incorrecta
                            $error_msg = 'La contraseña que ingresaste no es válida.';
                        }
                    }
                } else {
                    // Usuario no encontrado
                    $error_msg = 'No se encontró ninguna cuenta con ese nombre de usuario.';
                }
            } else {
                $error_msg = '¡Uy! Algo salió mal. Por favor, inténtalo de nuevo más tarde.';
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Acceso Administrador</h2>
        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="../index.php">Volver a la galería pública</a>
        </div>
    </div>
</body>
</html>