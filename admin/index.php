<?php include 'header.php'; ?>

<?php
// ---- Lógica para Subir Imagen Individual ----
$upload_msg = '';
if (isset($_POST['submit_upload'])) {
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

// ---- Lógica para Subir Múltiples Imágenes ----
if (isset($_POST['submit_upload_bulk'])) {
    $target_dir = "../uploads/";
    $allowed_types = ['jpg', 'jpeg', 'png'];
    
    $total_files = count($_FILES['filesToUpload']['name']);
    $uploaded_count = 0;
    $error_count = 0;
    $existing_count = 0;
    $error_messages = [];
    
    for ($i = 0; $i < $total_files; $i++) {
        // Verificar si hay error en la subida
        if ($_FILES['filesToUpload']['error'][$i] != 0) {
            $error_count++;
            continue;
        }
        
        $filename = basename($_FILES['filesToUpload']['name'][$i]);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Verificar tipo de archivo
        if (!in_array($imageFileType, $allowed_types)) {
            $error_messages[] = $filename . ' (formato no permitido)';
            $error_count++;
            continue;
        }
        
        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            $existing_count++;
            continue;
        }
        
        // Intentar subir el archivo
        if (move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO imagenes (nombre_archivo) VALUES (?)");
            $stmt->bind_param("s", $filename);
            if ($stmt->execute()) {
                $uploaded_count++;
            } else {
                $error_count++;
                $error_messages[] = $filename . ' (error en BD)';
            }
            $stmt->close();
        } else {
            $error_count++;
            $error_messages[] = $filename . ' (error al mover archivo)';
        }
    }
    
    // Mostrar resumen de la subida masiva
    $upload_msg = '<div class="alert alert-info"><strong>Resumen de subida masiva:</strong><br>';
    $upload_msg .= '✅ Archivos subidos exitosamente: ' . $uploaded_count . '<br>';
    if ($existing_count > 0) {
        $upload_msg .= '⚠️ Archivos que ya existían: ' . $existing_count . '<br>';
    }
    if ($error_count > 0) {
        $upload_msg .= '❌ Archivos con error: ' . $error_count . '<br>';
        if (!empty($error_messages)) {
            $upload_msg .= '<small>Detalles: ' . implode(', ', $error_messages) . '</small>';
        }
    }
    $upload_msg .= '</div>';
}

// ---- Lógica para Eliminar Imagen ----
if (isset($_POST['delete_image'])) {
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

<!-- Pestañas para cambiar entre subida individual y masiva -->
<ul class="nav nav-tabs mb-4" id="uploadTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="single-tab" data-bs-toggle="tab" data-bs-target="#single-upload" type="button" role="tab">
            <i class="bi bi-file-earmark-image"></i> Subir una imagen
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="bulk-tab" data-bs-toggle="tab" data-bs-target="#bulk-upload" type="button" role="tab">
            <i class="bi bi-file-earmark-images"></i> Subir múltiples imágenes
        </button>
    </li>
</ul>

<div class="tab-content" id="uploadTabContent">
    <!-- Subida Individual -->
    <div class="tab-pane fade show active" id="single-upload" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-upload"></i> Subir Nueva Imagen
            </div>
            <div class="card-body">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" accept=".jpg,.jpeg,.png" required>
                        <button class="btn btn-primary" type="submit" name="submit_upload">
                            <i class="bi bi-upload"></i> Subir Imagen
                        </button>
                    </div>
                    <div class="form-text">Solo archivos .jpg, .jpeg, .png</div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Subida Masiva -->
    <div class="tab-pane fade" id="bulk-upload" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-cloud-upload"></i> Subir Múltiples Imágenes
            </div>
            <div class="card-body">
                <form action="index.php" method="post" enctype="multipart/form-data" id="bulkUploadForm">
                    <div class="mb-3">
                        <label for="filesToUpload" class="form-label">Selecciona varias imágenes:</label>
                        <input type="file" class="form-control" name="filesToUpload[]" id="filesToUpload" accept=".jpg,.jpeg,.png" multiple required>
                        <div class="form-text">
                            Puedes seleccionar múltiples archivos. Solo se permiten formatos: .jpg, .jpeg, .png
                        </div>
                    </div>
                    
                    <!-- Vista previa de archivos seleccionados -->
                    <div id="filePreview" class="mb-3" style="display: none;">
                        <h6>Archivos seleccionados (<span id="fileCount">0</span>):</h6>
                        <div id="fileList" class="alert alert-light" style="max-height: 200px; overflow-y: auto;">
                        </div>
                    </div>
                    
                    <button class="btn btn-success" type="submit" name="submit_upload_bulk" id="bulkUploadBtn">
                        <i class="bi bi-cloud-upload"></i> Subir Todas las Imágenes
                    </button>
                </form>
            </div>
        </div>
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
        const filesToUpload = document.getElementById('filesToUpload');
        const filePreview = document.getElementById('filePreview');
        const fileList = document.getElementById('fileList');
        const fileCount = document.getElementById('fileCount');

        // Preview de archivos seleccionados en subida masiva
        if (filesToUpload) {
            filesToUpload.addEventListener('change', function() {
                const files = this.files;
                
                if (files.length > 0) {
                    filePreview.style.display = 'block';
                    fileCount.textContent = files.length;
                    
                    let listHTML = '<ul class="list-unstyled mb-0">';
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const fileSize = (file.size / 1024).toFixed(2); // KB
                        listHTML += `<li><i class="bi bi-file-image text-success"></i> ${file.name} <small class="text-muted">(${fileSize} KB)</small></li>`;
                    }
                    listHTML += '</ul>';
                    
                    fileList.innerHTML = listHTML;
                } else {
                    filePreview.style.display = 'none';
                }
            });
        }

        function renderImages(images) {
            galleryGrid.innerHTML = ''; 

            if (images.length === 0) {
                galleryGrid.innerHTML = '<div class="col-12"><p class="text-center text-muted">No se encontraron imágenes.</p></div>';
                return;
            }

            images.forEach(image => {
                const imagePath = `../uploads/${image.nombre_archivo}`;
                const downloadUrl = `download.php?file=${encodeURIComponent(image.nombre_archivo)}`;
                
                const col = document.createElement('div');
                col.className = 'col-lg-3 col-md-4 col-sm-6 gallery-item';
                col.innerHTML = `
                    <div class="card">
                        <img src="${imagePath}" class="card-img-top" alt="${image.nombre_archivo}">
                        <div class="card-body text-center">
                            <h6 class="card-title text-truncate">${image.nombre_archivo}</h6>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="${downloadUrl}" class="btn btn-success btn-sm" title="Descargar imagen">
                                    <i class="bi bi-download"></i> Descargar
                                </a>
                                <form action="index.php" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta imagen?');">
                                    <input type="hidden" name="image_id" value="${image.id}">
                                    <input type="hidden" name="image_name" value="${image.nombre_archivo}">
                                    <button type="submit" name="delete_image" class="btn btn-danger btn-sm" title="Eliminar imagen">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                galleryGrid.appendChild(col);
            });
        }

        async function searchImages(term = '') {
            try {
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