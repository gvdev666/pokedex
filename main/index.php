<?php
session_start();
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" />

    <style>
        body {
            background: linear-gradient(to right, #3498db, #e74c3c);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            margin-top: 20px;
            border-radius: 10px;
        }

        #pokemon-table {
            width: 100%;
        }

        /* Estilo para las imágenes en la tabla */
        .pokemon-image {
            max-width: 50px;
            /* Puedes ajustar el tamaño según tus preferencias */
            max-height: 50px;
        }

        .modal {
            color: black;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Pokedex</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="pokemon.php">Mis Pokemones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="objetos.php">Tienda de Objetos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mis_objetos.php">Mis Objetos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- DataTable Card Container with AOS Animation -->
        <div class="card" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-body">
                <!-- DataTable -->
                <table id="pokemon-table" class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar detalles del Pokémon -->
    <div class="modal fade" id="pokemonModal" tabindex="-1" role="dialog" aria-labelledby="pokemonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pokemonModalLabel">Detalles del Pokémon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="pokemonDetails">
                    <!-- Contenido del modal -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarFavoritoBtn">Guardar en favoritos</button>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- AOS JS -->
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

    <script>
        AOS.init(); // Inicializar AOS

        $(document).ready(function() {
            // Configurar DataTable
            $('#pokemon-table').DataTable({
                ajax: {
                    url: 'https://pokeapi.co/api/v2/pokemon/',
                    dataSrc: 'results'
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: function(row) {
                            return '<button class="btn btn-primary" onclick="openPokemonModal(\'' + row.name + '\')">Abrir Pokédex</button>';
                        }
                    }
                ],
                pageLength: 5,
            });

            // Obtener tipos de Pokémon y mostrarlos en la lista
            getPokemonTypes();
        });

        function openPokemonModal(pokemonName) {
            // Obtener detalles del Pokémon por nombre
            $.get('https://pokeapi.co/api/v2/pokemon/' + pokemonName + '/', function(pokemonData) {
                // Construir contenido del modal
                var modalContent = '<p>Nombre: ' + pokemonData.name + '</p>';
                modalContent += '<img class="pokemon-image" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' + pokemonData.id + '.png" alt="Pokemon Image">';

                // Obtener el ID del stat más alto
                var highestStatId = pokemonData.stats.reduce(function(prev, current) {
                    return (prev.base_stat > current.base_stat) ? prev : current;
                }).stat.url.split('/').slice(-2, -1)[0];

                // Obtener detalles del stat más alto
                $.get('https://pokeapi.co/api/v2/stat/' + highestStatId + '/', function(statData) {
                    modalContent += '<p>Highest Stat: ' + statData.name + '</p>';
                });

                // Obtener detalles de la characteristic
                $.get('https://pokeapi.co/api/v2/characteristic/' + pokemonData.id + '/', function(characteristicData) {
                    modalContent += '<p>Characteristic: ' + characteristicData.highest_stat.name + '</p>';
                    modalContent += '<p>Description: ' + characteristicData.descriptions[0].description + '</p>';

                    // Actualizar el contenido del modal
                    $('#pokemonDetails').html(modalContent);

                    // Almacenar el ID del Pokémon en un atributo de datos del botón
                    $('#guardarFavoritoBtn').data('idPokemon', pokemonData.id);

                    // Mostrar el modal
                    $('#pokemonModal').modal('show');
                });
            });
        }

        // Manejar clic en el botón de guardar en favoritos
        $('#guardarFavoritoBtn').click(function() {
            var idPokemon = $(this).data('idPokemon');

            // Invocar script PHP para guardar en favoritos
            $.post('../acciones/guardar_favorito.php', {
                idPokemon: idPokemon
            }, function(response) {
                alert("Guardado con exito");
                // Manejar la respuesta si es necesario
                console.log(response);

                // Cerrar el modal después de guardar en favoritos
                $('#pokemonModal').modal('hide');
            });
        });



        function getPokemonTypes() {
            $.get('https://pokeapi.co/api/v2/type/', function(types) {
                var typesList = $('#types-list');

                types.results.forEach(function(type) {
                    var listItem = $('<li class="list-group-item">' + type.name + '</li>');
                    typesList.append(listItem);
                });
            });
        }

        // Función para extraer el ID del Pokémon desde la URL
        function getPokemonIdFromUrl(url) {
            var match = url.match(/\/(\d+)\/$/);
            return match ? match[1] : '';
        }
    </script>

</body>

</html>