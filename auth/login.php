<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <style>
        .fade-out {
            animation: fadeOut 4s forwards;
        }
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .toggle-password svg {
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>

    <div class="flex min-h-screen bg-gray-50 dark:bg-black-900">
        <div class="flex w-1/2 items-center justify-center">
            <div class="relative z-10 w-full max-w-md bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-black-800 dark:border-gray-700">
                <div id="alert-container"></div> 
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-black-900">
                        My Delights  
                    </a>
                    <h1 class="text-xl font-bold leading-tight tracking-tight color:    #047857 md:text-2xl dark:text-black-900">
                        Iniciar Sesión
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" id="login-form">
                        <div>
                            <label for="cedula" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Cédula</label>
                            <input type="number" name="cedula" id="cedula" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345678" required="">
                        </div>
                        <div class="password-container">
                            <label for="password" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 10" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 4.5 12 4.5s8.268 3.443 9.542 7.5c-1.274 4.057-5.064 7.5-9.542 7.5s-8.268-3.443-9.542-7.5z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-black-900 dark:text-black-900">Recordarme</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">¿Olvidé mi contraseña?</a>
                        </div>
                        <button type="submit" style="background-color: #047857; color: white;" class="w-full hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-100 dark:hover:bg-primary-100 dark:focus:ring-primary-800">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex w-1/2 h-screen bg-cover bg-center" style="background-image: url('http://localhost/couth_server/MyDelights-Front/login.avif'); filter: brightness(50%);"></div>
    </div>
    <script>
    document.getElementById("login-form").addEventListener("submit", async function (event) {
        event.preventDefault(); 

        const cedula = document.getElementById("cedula").value;
        const password = document.getElementById("password").value;

        const alertContainer = document.getElementById("alert-container");
        alertContainer.innerHTML = "";

        try {
            const response = await fetch('http://localhost/couth_server/MyDelights-Back/authentication/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    cedula: cedula,
                    password: password,
                }),
            });

            const data = await response.json();

            if (response.ok) {
                // Guardar el token en localStorage (para el frontend)
                localStorage.setItem("userToken", data.token);

                // Mostrar alerta de inicio de sesión exitoso
                showAlert("green", "Inicio de sesión exitoso", `Bienvenido, ${data.user_name}`);

                // Redirigir según el rol del usuario
                setTimeout(() => {
                    if (data.user_role === 'admin') {
                        window.location.href = 'http://localhost/couth_server/MyDelights-Front/pages/admin_dashboard.php';
                    } else {
                        window.location.href = 'http://localhost/couth_server/MyDelights-Front/pages/usuario_dashboard.php';
                    }
                }, 3000);
            } else {
                // Mostrar error si la autenticación falla
                showAlert("red", "Error al iniciar sesión", data.message);
            }
        } catch (error) {
            console.error("Hubo un error en la solicitud:", error);
            showAlert("red", "Error de conexión", "No se pudo conectar con el servidor.");
        }
    });

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;
    }

    function showAlert(color, title, message) {
        const alertContainer = document.getElementById("alert-container");

        const alertTemplate = `
            <div class="flex items-center p-4 mb-4 text-sm text-${color}-800 border border-${color}-300 rounded-lg bg-${color}-50 dark:bg-gray-800 dark:text-${color}-400 dark:border-${color}-800" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">${title}</span>
                <div>
                    <span class="font-medium">${title}</span> ${message}
                </div>
            </div>
        `;

        alertContainer.innerHTML = alertTemplate;
    }
    </script>

</body>
</html>