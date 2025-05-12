<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/platos.css">
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

    <div class="platos-container" id="platos-container"></div>

    <button id="toggle-cart-button" class="toggle-cart-button show">
        🛒
    </button>

    <div class="cart-container hidden" id="cart-container">
        <h2>CARRITO DE COMPRAS</h2>
        <div id="cart-items"></div>
        <div class="cart-footer">
            <p id="total-cost">Total: $0.00</p>
            <button id="checkout-button" class="checkout-button">PEDIR</button>
        </div>
    </div>

    <div id="popup-modal" tabindex="-1" class=" fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <div class="text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">¿Estás seguro de que deseas realizar el pedido?</h3>
            <div class="flex justify-center gap-4">
                <button id="confirm-pedido-button" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium">
                    CONFIRMAR
                </button>
                <button id="cancel-pedido-button" class="px-5 py-2.5 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium">
                    CANCELAR
                </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const token = "<?php echo htmlspecialchars($userToken, ENT_QUOTES, 'UTF-8'); ?>";

        const cart = []; 

        async function cargarPlatos() {
            const contenedor = document.getElementById('platos-container');

            try {
                const response = await fetch('http://localhost/couth_server/MyDelights-Back/platos/buscar_plato.php');
                const data = await response.json();

                if (data.success && data.data) {
                    const platos = data.data;

                    platos.forEach(plato => {
                        const card = `
                            <div class="card">
                                <a href="#">
                                    <img class="card-image" src="../../images/${plato.imagen_url}" alt="Imagen de ${plato.nombre}" />
                                </a>
                                <div class="card-content">
                                    <a href="#">
                                        <h5 class="card-title">${plato.nombre}</h5>
                                    </a>
                                    <p class="card-description">${plato.descripcion}</p>
                                    <p class="card-cost">Costo: $${parseFloat(plato.costo).toFixed(2)}</p>
                                    <button class="card-button" onclick="agregarAlCarrito('${plato.nombre}', ${plato.costo})">
                                        COTIZAR
                                    </button>
                                </div>
                            </div>
                        `;
                        contenedor.innerHTML += card;
                    });
                } else {
                    contenedor.innerHTML = '<p>No hay platos disponibles en este momento.</p>';
                }
            } catch (error) {
                console.error('Error al cargar los platos:', error);
                contenedor.innerHTML = '<p>Error al cargar los platos. Inténtalo más tarde.</p>';
            }
        }

        function agregarAlCarrito(nombre, costo) {
            const itemIndex = cart.findIndex(item => item.nombre === nombre);
            if (itemIndex !== -1) {
                cart[itemIndex].cantidad += 1;
            } else {
                cart.push({ nombre, costo, cantidad: 1 });
            }
            actualizarCarrito();
        }

        function actualizarCarrito() {
            const cartItems = document.getElementById('cart-items');
            const totalCost = document.getElementById('total-cost');

            cartItems.innerHTML = ''; 
            let total = 0;

            cart.forEach(item => {
                total += item.costo * item.cantidad;
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <span>${item.nombre} (x${item.cantidad})</span>
                        <span>$${(item.costo * item.cantidad).toFixed(2)}</span>
                        <button onclick="eliminarDelCarrito('${item.nombre}')">ELIMINAR </button>
                    </div>
                `;
            });

            totalCost.innerText = `Total: $${total.toFixed(2)}`;
        }

        function eliminarDelCarrito(nombre) {
            const itemIndex = cart.findIndex(item => item.nombre === nombre);
            if (itemIndex !== -1) {
                cart.splice(itemIndex, 1);
            }
            actualizarCarrito();
        }

        async function realizarPedido() {
            if (cart.length === 0) {
                alert("El carrito está vacío. Agrega productos antes de realizar el pedido.");
                return;
            }

            const pedido = {
                token: token, 
                estado: "Pendiente",
                platos: cart.map(item => ({
                    nombre: item.nombre,
                    cantidad: item.cantidad
                }))
            };

            try {
                const response = await fetch('http://localhost/couth_server/MyDelights-Back/pedidos/pedido.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(pedido)
                });

                const data = await response.json();

                if (data.success) {
                    alert("Pedido realizado correctamente.");
                    cart.length = 0; 
                    actualizarCarrito();
                } else {
                    alert("Error al realizar el pedido: " + data.message);
                }
            } catch (error) {
                console.error("Error al realizar el pedido:", error);
                alert("Hubo un error al conectar con el servidor. Inténtalo más tarde.");
            }
        }

        document.getElementById('toggle-cart-button').addEventListener('click', () => {
            const cartContainer = document.getElementById('cart-container');
            cartContainer.classList.toggle('hidden');
        });

        document.getElementById('checkout-button').addEventListener('click', () => {
            document.getElementById('popup-modal').classList.remove('hidden');
        });

        document.getElementById('confirm-pedido-button').addEventListener('click', () => {
            realizarPedido();
            document.getElementById('popup-modal').classList.add('hidden');
        });

        document.getElementById('cancel-pedido-button').addEventListener('click', () => {
            document.getElementById('popup-modal').classList.add('hidden');
        });

        cargarPlatos();
    </script>
</body>
</html>