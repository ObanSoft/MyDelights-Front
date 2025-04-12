<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <style>
        /* Fondo gris medio oscuro */
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(24, 22, 23); 
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: rgb(24, 22, 23); 
            color: white;
        }
        .navbar a:hover {
            color: rgb(3, 153, 120); 
        }

        /* Contenedor principal dividido en dos mitades */
        .split-container {
            display: flex;
            flex-direction: row;
            height: calc(100vh - 64px); /* Altura total menos la altura del navbar */
            width: 100%;
        }

        /* Mitad izquierda (imagen) */
        .left-section {
            flex: 1;
            background: url('http://localhost/couth_server/frontend/restaurant.jpg') no-repeat center center;
            background-size: cover;
        }

        /* Mitad derecha (descripción) */
        .right-section {
            flex: 1;
            background-color:rgb(68, 64, 64); /* Fondo blanco */
            color: #000; /* Texto negro */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
        }

        

        .right-section p {
            font-size: 1rem;
            font-weight: bold;
            text-align: justify;
            line-height: 1.8;
            color: rgb(252, 255, 254); /* Color de texto */
            text-shadow: 
                -1px -1px 0 #000, /* Sombra superior izquierda */
                1px -1px 0 #000,  /* Sombra superior derecha */
                -1px 1px 0 #000,  /* Sombra inferior izquierda */
                1px 1px 0 #000;   /* Sombra inferior derecha */
        }

        .right-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #047857; /* Verde 700 */
            margin-bottom: 20px;
            text-shadow: 
                -1px -1px 0 #000, /* Sombra superior izquierda */
                1px -1px 0 #000,  /* Sombra superior derecha */
                -1px 1px 0 #000,  /* Sombra inferior izquierda */
                1px 1px 0 #000;   /* Sombra inferior derecha */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center">
                <img src="http://localhost/couth_server/frontend/logo.jpg" class="h-8" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">My Delights</span>
            </a>
            <div class="flex md:order-2">
                <div class="user-menu flex items-center space-x-4">
                    <div class="text-sm text-gray-200">
                        <span id="user-name">Cargando...</span>
                        <span id="user-role" class="block text-gray-400 text-xs">Cargando...</span>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-white">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </button>
                </div>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-transparent rounded-lg bg-transparent md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-transparent">
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

    <div class="split-container">
        <div class="left-section"></div>

        <div class="right-section">
            <h2>Bienvenidos a My Delights</h2>
            <p>
                My Delights es un sistema diseñado para facilitar la operación y gestión de restaurantes. Con esta herramienta, 
                podrás administrar pedidos, gestionar platos, realizar cotizaciones y mucho más. Nuestro objetivo es ofrecer 
                una experiencia eficiente tanto para los administradores como para los clientes, asegurando que cada detalle 
                de tu restaurante esté bajo control.
            </p>
            <p>
                Nuestro diseño intuitivo y funcionalidades avanzadas garantizan que cada tarea, desde la creación de un plato 
                hasta el seguimiento de pedidos, sea sencilla y rápida. ¡Explora todas las funciones y lleva la operación de 
                tu restaurante al siguiente nivel!
            </p>
        </div>
    </div>

    <script>
        async function fetchUserData() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/session.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const userData = await response.json();

                if (userData.status === 'success') {
                    document.getElementById('user-name').textContent = userData.user_name;
                    document.getElementById('user-role').textContent = userData.user_role;
                } else {
                    console.error('Error al obtener los datos del usuario:', userData.message);
                }
            } catch (error) {
                console.error('Error al obtener los datos del usuario:', error);
            }
        }

        fetchUserData();
    </script>

</body>
</html>