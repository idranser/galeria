<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">🖼️ Galería Pública</a>
            <div class="d-flex">
                <a href="admin/login.php" class="btn btn-outline-light">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                </a>
            </div>
        </div>
    </nav>

    <div class="container gallery-container">
        <h1 class="text-center mb-4">Equipos de fútbol</h1>

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input class="form-control" type="search" placeholder="Buscar imágenes en tiempo real..." id="searchInput">
                </div>
            </div>
        </div>

        <div class="row" id="galleryGrid">
            </div>
    </div>

    <footer class="text-center py-4 bg-dark text-white">
        <p>&copy; 2025 Galería TV Bolivia</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const galleryGrid = document.getElementById('galleryGrid');

            // Función para renderizar las imágenes en la grilla
            function renderImages(images) {
                galleryGrid.innerHTML = ''; // Limpiar la galería actual

                if (images.length === 0) {
                    galleryGrid.innerHTML = '<div class="col-12"><p class="text-center text-muted">No se encontraron imágenes.</p></div>';
                    return;
                }

                images.forEach(image => {
                    const imagePath = `uploads/${image.nombre_archivo}`;
                    const downloadUrl = `public/download.php?file=${encodeURIComponent(image.nombre_archivo)}`;
                    
                    const col = document.createElement('div');
                    col.className = 'col-lg-3 col-md-4 col-sm-6 gallery-item';
                    col.innerHTML = `
                        <div class="card">
                            <img src="${imagePath}" class="card-img-top" alt="${image.nombre_archivo}">
                            <div class="card-body text-center">
                                <h6 class="card-title text-truncate">${image.nombre_archivo}</h6>
                                <a href="${downloadUrl}" class="btn btn-success btn-sm">
                                    <i class="bi bi-download"></i> Descargar
                                </a>
                            </div>
                        </div>
                    `;
                    galleryGrid.appendChild(col);
                });
            }

            // Función para buscar imágenes
            async function searchImages(term = '') {
                try {
                    const response = await fetch(`search.php?term=${encodeURIComponent(term)}`);
                    const images = await response.json();
                    renderImages(images);
                } catch (error) {
                    console.error('Error al buscar imágenes:', error);
                    galleryGrid.innerHTML = '<div class="col-12"><p class="text-center text-danger">Error al cargar las imágenes.</p></div>';
                }
            }

            // Evento que se dispara cada vez que el usuario teclea en la barra
            searchInput.addEventListener('keyup', () => {
                searchImages(searchInput.value);
            });

            // Carga inicial de todas las imágenes cuando la página carga
            searchImages();
        });
    </script>
</body>
</html>