<!doctype html>
<html lang="en">

<head>
    <title>Objetos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
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

    table {
        color: black;
    }
</style>

<body>
    <table id="objectTable" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Object data will be loaded here dynamically -->
        </tbody>
    </table>
    <!-- Object Modal -->
    <div class="modal fade" id="objectModal" tabindex="-1" role="dialog" aria-labelledby="objectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="objectModalLabel">Detalles del objeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="objectDetails">
                    <!-- Object details will be displayed here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="guardarFavoritoBtn">Guardar en favoritos</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#objectTable').DataTable({
                ajax: {
                    url: 'https://pokeapi.co/api/v2/item/',
                    dataSrc: 'results'
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary" data-toggle="modal" data-target="#objectModal" data-id="' + data + '">Ver Objeto</button>';
                        }
                    }
                ]
            });

            // Triggered when the modal is shown
            $('#objectModal').on('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                const button = $(event.relatedTarget);

                // Extract data-id attribute from the button (assuming you set it to the object name)
                const objectName = button.data('id');

                // Fetch and display details
                fetchObjectDetails(objectName);
            });

            // Function to fetch object details and display in the modal
            function fetchObjectDetails(objectName) {
                // Make a GET request to the Pokémon API for the specific object
                $.get(`https://pokeapi.co/api/v2/item/${objectName}/`, function(data) {
                    // Ensure that the data is defined
                    if (data) {
                        // Extract relevant details from the API response
                        const name = data.name;
                        const cost = data.cost;
                        const flingPower = data.fling_power;
                        const flingEffect = data.fling_effect ? data.fling_effect.name : 'N/A';
                        const attributes = data.attributes ? data.attributes.map(attr => attr.name).join(', ') : 'N/A';
                        const category = data.category ? data.category.name : 'N/A';
                        const spriteUrl = data.sprites.default;

                        // Display details in the modal body
                        const modalBody = $('#objectDetails');
                        modalBody.html(`
        <img src="${spriteUrl}" alt="${name} Sprite" class="img-fluid mb-2">
        <p>Name: ${name}</p>
        <p>Cost: ${cost}</p>
        <p>Fling Power: ${flingPower}</p>
        <p>Fling Effect: ${flingEffect}</p>
        <p>Attributes: ${attributes}</p>
        <p>Category: ${category}</p>
    `);

                        // Almacenar el ID del Pokémon en un atributo de datos del botón
                        $('#guardarFavoritoBtn').data('idObjeto', data.id);
                    }

                });
            }
            // Manejar clic en el botón de guardar en favoritos
            $('#guardarFavoritoBtn').click(function() {
                var idObjeto = $(this).data('idObjeto');

                // Invocar script PHP para guardar en favoritos
                $.post('../acciones/guardar_objeto.php', {
                    idObjeto: idObjeto
                }, function(response) {
                    alert("Guardado con exito");
                    // Manejar la respuesta si es necesario
                    console.log(response);

                    // Cerrar el modal después de guardar en favoritos
                    $('#pokemonModal').modal('hide');
                });
            });
        });
    </script>
</body>

</html>