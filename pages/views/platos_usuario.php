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
    <?php include '../../components/navbar_usuario.php'; ?>
    
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

    <script>
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

        const toggleCartButton = document.getElementById('toggle-cart-button');
        const cartContainer = document.getElementById('cart-container');
        
        toggleCartButton.addEventListener('click', () => {
            cartContainer.classList.toggle('hidden');
            toggleCartButton.classList.toggle('show');
            toggleCartButton.innerText = cartContainer.classList.contains('hidden') ? '🛒' : '❌';
        });

        cargarPlatos();
    </script>
</body>
</html>