<?php include 'header.php'; ?>

<?php
// ---- Lógica para Subir Imagen (se mantiene igual) ----
$upload_msg = '';
if (isset($_POST['submit_upload'])) {
    // ... (El código PHP para subir archivos que ya tenías se queda aquí sin cambios)
    $target_dir = "../uploads/";
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png'];

    if (in_array($imageFileType, $allowed_types)) {
        if (!file_exists($target_file)) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO imagenes (nombre_archivo) VALUES (?)");
                $stmt->bind_param("s", $filename);
                if ($stmt->execute()) {
                    $upload_msg = '<div class="alert alert-success">La imagen ' . htmlspecialchars($filename) . ' ha sido subida.</div>';
                } else {
                    $upload_msg = '<div class="alert alert-danger">Error al guardar en la base de datos.</div>';
                }
                $stmt->close();
            } else {
                $upload_msg = '<div class="alert alert-danger">Hubo un error al subir tu archivo.</div>';
            }
        } else {
            $upload_msg = '<div class="alert alert-warning">El archivo ya existe.</div>';
        }
    } else {
        $upload_msg = '<div class="alert alert-danger">Solo se permiten archivos JPG, JPEG y PNG.</div>';
    }
}

// ---- Lógica para Eliminar Imagen (se mantiene igual) ----
if (isset($_POST['delete_image'])) {
    // ... (El código PHP para eliminar archivos que ya tenías se queda aquí sin cambios)
    $id_to_delete = $_POST['image_id'];
    $filename_to_delete = $_POST['image_name'];
    $filepath = '../uploads/' . $filename_to_delete;

    $stmt = $conn->prepare("DELETE FROM imagenes WHERE id = ?");
    $stmt->bind_param("i", $id_to_delete);
    if ($stmt->execute()) {
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        $upload_msg = '<div class="alert alert-success">Imagen eliminada correctamente.</div>';
    } else {
        $upload_msg = '<div class="alert alert-danger">Error al eliminar la imagen de la base de datos.</div>';
    }
    $stmt->close();
}
?>

<h1 class="text-center mb-4">Gestionar Imágenes</h1>

<?= $upload_msg ?>

<div class="card mb-4">
    <div class="card-header">Subir Nueva Imagen</div>
    <div class="card-body">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
                <button class="btn btn-primary" type="submit" name="submit_upload">Subir Imagen</button>
            </div>
            <div class="form-text">Solo archivos .jpg, .jpeg, .png</div>
        </form>
    </div>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-md-8">
         <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input class="form-control" type="search" placeholder="Buscar imágenes en tiempo real..." id="adminSearchInput">
        </div>
    </div>
</div>

<h2 class="mt-5">Imágenes Subidas</h2>
<hr>
<div class="row" id="adminGalleryGrid">
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('adminSearchInput');
        const galleryGrid = document.getElementById('adminGalleryGrid');

        function renderImages(images) {
            galleryGrid.innerHTML = ''; 

            if (images.length === 0) {
                galleryGrid.innerHTML = '<div class="col-12"><p class="text-center text-muted">No se encontraron imágenes.</p></div>';
                return;
            }

            images.forEach(image => {
                const imagePath = `../uploads/${image.nombre_archivo}`;
                
                const col = document.createElement('div');
                col.className = 'col-lg-3 col-md-4 col-sm-6 gallery-item';
                col.innerHTML = `
                    <div class="card">
                        <img src="${imagePath}" class="card-img-top" alt="${image.nombre_archivo}">
                        <div class="card-body text-center">
                            <h6 class="card-title text-truncate">${image.nombre_archivo}</h6>
                            <form action="index.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta imagen?');">
                                <input type="hidden" name="image_id" value="${image.id}">
                                <input type="hidden" name="image_name" value="${image.nombre_archivo}">
                                <button type="submit" name="delete_image" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                galleryGrid.appendChild(col);
            });
        }

        async function searchImages(term = '') {
            try {
                // Fíjate que ahora la ruta a search.php es diferente
                const response = await fetch(`../search.php?term=${encodeURIComponent(term)}`);
                const images = await response.json();
                renderImages(images);
            } catch (error) {
                console.error('Error al buscar imágenes:', error);
                galleryGrid.innerHTML = '<div class="col-12"><p class="text-center text-danger">Error al cargar las imágenes.</p></div>';
            }
        }

        searchInput.addEventListener('keyup', () => {
            searchImages(searchInput.value);
        });

        // Carga inicial
        searchImages();
    });
</script>

<?php include 'footer.php'; ?>