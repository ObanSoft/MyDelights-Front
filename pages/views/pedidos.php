<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pedidos.css">
</head>
<body>
    <?php
    include '../../components/navbar.php';
    session_start();

    if (!isset($_SESSION['token'])) {
        echo "<script>alert('Debe iniciar sesión para acceder a esta página.'); window.location.href = '/login.php';</script>";
        exit;
    }

    $userToken = $_SESSION['token'];
    ?>

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Mis Pedidos</h1>

        <!-- Campo para buscar pedido por ID -->
        <div class="mb-6">
            <label for="buscar-pedido" class="block text-sm font-medium text-gray-700">Buscar Pedido por ID</label>
            <div class="flex mt-2">
                <input type="text" id="buscar-pedido" class="rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 flex-grow" placeholder="Introduce el ID del pedido">
                <button onclick="buscarPedido()" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Buscar</button>
            </div>
        </div>

        <!-- Contenedor de pedidos -->
        <div id="pedidos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>

    <script>
        const token = "<?php echo htmlspecialchars($userToken, ENT_QUOTES, 'UTF-8'); ?>";

        // Cargar todos los pedidos del usuario
        async function cargarPedidos() {
            const container = document.getElementById('pedidos-container');

            try {
                const response = await fetch('http://localhost/couth_server/MyDelights-Back/pedidos/ver_pedido.php', {
                    method: 'GET',
                    headers: {
                        'Authorization': token
                    }
                });

                const data = await response.json();

                if (data.success) {
                    renderPedidos(data.data);
                } else {
                    container.innerHTML = `<p class="text-red-600">Error: ${data.message}</p>`;
                }
            } catch (error) {
                console.error('Error al cargar los pedidos:', error);
                container.innerHTML = '<p class="text-red-600">Hubo un error al cargar los pedidos. Intenta nuevamente más tarde.</p>';
            }
        }

        // Buscar un pedido por ID
        async function buscarPedido() {
            const buscarInput = document.getElementById('buscar-pedido');
            const id = buscarInput.value.trim();
            const container = document.getElementById('pedidos-container');

            if (!id) {
                alert("Por favor, ingresa un ID de pedido.");
                return;
            }

            try {
                const response = await fetch(`http://localhost/couth_server/MyDelights-Back/admin/pedidos/ver_pedido_id.php?id=${id}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': token
                    }
                });

                const data = await response.json();

                if (data.success) {
                    renderPedidos([data.data]);
                } else {
                    container.innerHTML = `<p class="text-red-600">Error: ${data.message}</p>`;
                }
            } catch (error) {
                console.error('Error al buscar el pedido:', error);
                container.innerHTML = '<p class="text-red-600">Hubo un error al buscar el pedido. Intenta nuevamente más tarde.</p>';
            }
        }

        // Renderizar pedidos
        function renderPedidos(pedidos) {
            const container = document.getElementById('pedidos-container');
            container.innerHTML = '';

            if (pedidos.length === 0) {
                container.innerHTML = '<p class="text-gray-600">No se encontraron pedidos.</p>';
                return;
            }

            pedidos.forEach(pedido => {
                const card = `
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-lg font-bold text-red-600 mb-2">Pedido #${pedido.pedido_id}</h2>
                        <p class="text-gray-700"><span class="font-bold">Estado:</span> <span class="font-medium text-blue-500">${pedido.estado}</span></p>
                        <p class="text-gray-700"><span class="font-bold">Total:</span> <span class="text-red-600">$${parseFloat(pedido.total).toFixed(2)}</span></p>
                        <p class="text-gray-700"><span class="font-bold">Fecha:</span> ${new Date(pedido.creado_en).toLocaleDateString()}</p>
                        <h3 class="text-md font-semibold text-gray-800 mt-4 mb-2">Platos:</h3>
                        <ul class="list-disc list-inside text-gray-800 font-medium">
                            ${pedido.platos.map(plato => `
                                <li>${plato.nombre_plato} - <span class="text-gray-600">$${parseFloat(plato.costo).toFixed(2)}</span></li>
                            `).join('')}
                        </ul>
                        <div class="mt-4 flex justify-between">
                            <button onclick="actualizarEstadoPedido(${pedido.pedido_id}, 'Aceptado')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Confirmar</button>
                            <button onclick="actualizarEstadoPedido(${pedido.pedido_id}, 'Rechazado')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Rechazar</button>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }

        // Actualizar estado del pedido
        async function actualizarEstadoPedido(id, estado) {
            try {
                const response = await fetch('http://localhost/couth_server/MyDelights-Back/admin/pedidos/editar_estado_pedido.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': token
                    },
                    body: JSON.stringify({ id, estado })
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    cargarPedidos(); // Recargar los pedidos
                } else {
                    alert(`Error: ${data.message}`);
                }
            } catch (error) {
                console.error('Error al actualizar el estado del pedido:', error);
                alert('Hubo un error al actualizar el estado del pedido. Intenta nuevamente más tarde.');
            }
        }

        cargarPedidos();
    </script>
</body>
</html>