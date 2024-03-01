<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mi Perfil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" />

    <style>
        /* Paleta de colores */
        :root {
            --primary-color: #3498db;
            /* Azul */
            --secondary-color: #2ecc71;
            /* Verde */
            --background-color: #ecf0f1;
            /* Fondo */
        }

        /* Estilos para la sección de perfil */
        .profile-section {
            background-color: var(--background-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Estilo para la imagen de perfil */
        .profile-image {
            max-width: 150px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4">Mi Perfil</h1>

        <div class="profile-section" data-aos="fade-up" data-aos-duration="1000">
            <div class="row">
                <div class="col-md-4">
                    <!-- Obtener datos de la sesión para mostrar el avatar correspondiente -->
                    <?php
                    $genero = isset($_SESSION['genero']) ? $_SESSION['genero'] : 'hombre'; // Por defecto, asumimos 'hombre' si no se proporciona
                    $avatar_url = ($genero === 'mujer') ? 'mujer.png' : 'hombre.png';

                    ?>
                    <img src="<?php echo $avatar_url; ?>" alt="Avatar" class="profile-image mx-auto d-block">
                </div>
                <div class="col-md-8">
                    <h2><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Nombre Desconocido'; ?></h2>
                    <p>Correo Electrónico: <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Correo Desconocido'; ?></p>
                    <!-- Otros detalles del perfil -->
                </div>
                <div class="mt-4">
                    <!-- Botón para cerrar sesión -->
                    <a href="destroy.php" class="btn btn-danger">Cerrar Sesión</a>

                    <!-- Botón para eliminar la cuenta (se recomienda confirmación) -->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#confirmDeleteModal">Eliminar Cuenta</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación para eliminar la cuenta -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación de Cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="../acciones/delete_account.php" class="btn btn-danger">Eliminar Cuenta</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS y AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        AOS.init(); // Inicializar AOS
    </script>

</body>

</html>