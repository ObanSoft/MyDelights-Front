<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: rgb(24, 22, 23); 
            color: white;
        }

        .navbar a:hover {
            color: rgb(3, 153, 120);
        }

        /* User menu dropdown */
        .user-menu {
            position: relative;
        }

        .user-menu-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #ffffff;
            color: #000;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .user-menu-dropdown a {
            display: block;
            padding: 0.5rem;
            color: #000;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .user-menu-dropdown a:hover {
            background-color: #f3f4f6;
        }

        .user-menu:hover .user-menu-dropdown {
            display: block;
        }

        /* Buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Product card styles */
        .product-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            background: #ffffff; /* Fondo blanco */
            border: 1px solid #e5e7eb; /* Borde gris claro */
            border-radius: 12px; /* Bordes redondeados */
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px); /* Efecto de elevación */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Sombra más intensa */
        }

        .product-card h5 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .product-card p {
            color: #555;
            margin-bottom: 10px;
        }

        .product-card button {
            align-self: flex-end;
        }

        main {
            margin-top: 80px; 
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">

    <!-- Navbar -->
    <nav class="navbar fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="http://localhost/couth_server/frontend/logo.jpg" class="h-8" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">My Delights</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <div class="user-menu flex items-center space-x-4">
                    <div class="text-sm text-gray-200">
                        <span id="user-name">Cargando...</span>
                        <span id="user-role" class="block text-gray-400 text-xs">Cargando...</span>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-white">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </button>
                    <!-- Dropdown -->
                    <div class="user-menu-dropdown">
                        <a href="#">Perfil</a>
                        <a href="#">Cerrar Sesión</a>
                    </div>
                </div>
            </div>

            <!-- Navbar Links -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-transparent rounded-lg bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:text-blue-300 md:p-0">
                            <i class="fas fa-clipboard-list"></i> Pedidos
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/couth_server/frontend/platos.php" class="block py-2 px-3 text-white rounded-sm hover:text-blue-300 md:p-0">
                            <i class="fas fa-utensils"></i> Platos
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:text-blue-300 md:p-0">
                            <i class="fas fa-file-invoice"></i> Cotizaciones
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="p-6">

        <div class="action-buttons">
        <button onclick="window.location.href='http://localhost/couth_server/frontend/form-add_product.php'" class="px-4 py-2 bg-red-600 text-white focus:ring-4 focus:outline-none font-bold  hover:bg-red-900" >Agregar Plato</button>
            <button onclick="window.location.href='http://localhost/couth_server/frontend/form-get_product.php'" class="px-4 py-2 bg-green-500 text-white focus:ring-4 focus:outline-none font-bold hover:bg-green-900">Buscar Plato</button>
        </div>

        <div id="product-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        </div>

        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination flex justify-center" id="pagination">
                
            </ul>
        </nav>
    </main>

    <script>
        let currentPage = 1;
        const itemsPerPage = 6;
        let products = [];

        async function fetchUserData() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/session.php');
                const data = await response.json();
                if (data.status === 'success') {
                    document.getElementById('user-name').textContent = data.user_name;
                    document.getElementById('user-role').textContent = data.user_role;
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        }

        async function fetchProducts() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/get_products.php');
                products = await response.json();
                renderProducts();
                renderPagination();
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        function renderProducts() {
            const container = document.getElementById('product-container');
            container.innerHTML = '';
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            products.slice(start, end).forEach(product => {
                container.innerHTML += `
                    <div class="product-card">
                        <h5>${product.nombre}</h5>
                        <p>${product.descripcion}</p>
                        <p class="font-bold">Precio: $${product.precio}</p>
                        <p class="font-semibold text-gray-700">Cantidad disponible: ${product.cantidad}</p>
                        <button class="mt-3 px-8 py-2 bg-blue-900 text-white  hover:bg-blue-700">Cotizar</button>
                    </div>
                `;
            });
        }

        function renderPagination() {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';
            const totalPages = Math.ceil(products.length / itemsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
                    <li>
                        <a href="#" class="px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 ${i === currentPage ? 'text-blue-600 border-blue-300 bg-blue-50' : ''}" onclick="changePage(${i})">${i}</a>
                    </li>
                `;
            }
        }

        function changePage(page) {
            if (page < 1 || page > Math.ceil(products.length / itemsPerPage)) return;
            currentPage = page;
            renderProducts();
            renderPagination();
        }

        fetchUserData();
        fetchProducts();
    </script>
</body>
</html>