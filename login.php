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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>
<body>

    <div class="flex min-h-screen bg-gray-50 dark:bg-black-900">
        <div class="flex w-1/2 items-center justify-center">
            <div class="relative z-10 w-full max-w-md bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-black-800 dark:border-gray-700">
                <div id="alert-container"></div> 
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-black-900">
                        <img class="w-8 h-8 mr-2" src="http://localhost/couth_server/frontend/logo.jpg" alt="logo">
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
                        <p class="text-sm font-light text-gray-500 dark:text-black-900">
                            ¿No tienes una cuenta? <a href="registro.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Registrarme</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex w-1/2 h-screen bg-cover bg-center" style="background-image: url('http://localhost/couth_server/frontend/login.avif'); filter: brightness(50%);"></div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('http://localhost/couth_server/backend/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                const alertContainer = document.getElementById('alert-container');
                alertContainer.innerHTML = '';

                let alertType = 'text-red-900 bg-red-300 dark:bg-red-900 dark:text-red-200';
                if (result.status === 'success') {
                    alertType = 'text-green-900 bg-green-300 dark:bg-green-900 dark:text-green-200';
                }

                const alertHTML = `
                    <div class="flex items-center p-4 mb-4 text-sm ${alertType} rounded-lg fade-out" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">${result.status === 'success' ? 'Success!' : 'Error!'}</span> ${result.message}
                        </div>
                    </div>
                `;
                alertContainer.innerHTML = alertHTML;

                setTimeout(() => {
                    const alertElement = alertContainer.querySelector('.fade-out');
                    if (alertElement) {
                        alertElement.classList.add('fade-out');
                        setTimeout(() => {
                            alertElement.remove();
                            if (result.status === 'success') {
                                const redirectUrl = result.user_role === 'admin' ? 'dashboard-admin.php' : 'dashboard-cliente.php';
                                window.location.href = redirectUrl;
                            }
                        }, 2000);
                    }
                }, 3000);
            } catch (error) {
                console.error('Error:', error);
            }
        });

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.querySelector('.toggle-password svg');
            const isPasswordHidden = passwordInput.getAttribute('type') === 'password';

            if (isPasswordHidden) {
                passwordInput.setAttribute('type', 'text');
                passwordToggle.setAttribute('fill', 'currentColor');
            } else {
                passwordInput.setAttribute('type', 'password');
                passwordToggle.setAttribute('fill', 'none');
            }
        }
    </script>

</body>
</html>