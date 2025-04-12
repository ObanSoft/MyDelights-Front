<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .toggle-password svg {
            height: 24px;
            width: 24px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</head>
<body>

    <div class="flex min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="flex w-1/2 h-screen bg-cover bg-center" style="background-image: url('http://localhost/couth_server/frontend/img-pri.jpg'); filter: brightness(50%);"></div>
        <div class="flex w-1/2 items-center justify-center">
            <div class="relative z-10 w-full max-w-md bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div id="alert-container"></div>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-black-900 dark:text-white">
                        <img class="w-8 h-8 mr-2" src="http://localhost/couth_server/frontend/logo.jpg" alt="logo">
                        My Delights  
                    </a>
                    <h1 class="text-xl font-bold leading-tight tracking-tight color: #047857 md:text-2xl dark:text-white">
                        Registrarse
                    </h1>
                    <form class="space-y-4 md:space-y-6" id="register-form">
                    <div>
                        <label for="cedula" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Cédula</label>
                        <input type="number" name="cedula" id="cedula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345678" required="" minlength="8">
                    </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Nombre de Usuario</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="@User123" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Correo Electrónico</label>
                            <input type="email" name="email" id="email" placeholder="nombre@dominio.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="password-container">
                            <label for="password" class="block mb-2 text-sm font-medium text-black-900 dark:text-black-900">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 14" stroke="currentColor" class="w-2 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 4.5 12 4.5s8.268 3.443 9.542 7.5c-1.274 4.057-5.064 7.5-9.542 7.5s-8.268-3.443-9.542-7.5z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-black-900 dark:text-black-900"><a class="font-medium text-black-900 hover:underline dark:text-black-900" href="#">Acepto términos y condiciones</a></label>
                            </div>
                        </div>
                        <button type="submit" style="background-color: #047857; color: white;" class="w-full hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-900 dark:focus:ring-primary-800">Registrarse</button>
                        <p class="text-sm font-light text-black-900 dark:text-black-900">
                            ¿Ya tienes una cuenta? <a href="login.php" class="font-medium text-black-900 hover:underline dark:text-black-900">Inicia Sesión</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());

            fetch('http://localhost/couth_server/backend/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(response => {
                const alertContainer = document.getElementById('alert-container');
                alertContainer.innerHTML = ''; 

                let alertType = 'text-red-900 bg-red-300 dark:bg-red-900 dark:text-red-200';
                if (response.success) {
                    alertType = 'text-green-900 bg-green-300 dark:bg-green-900 dark:text-green-200';
                }

                const alertHTML = `
                    <div class="flex items-center p-4 mb-4 text-sm ${alertType} rounded-lg fade-out" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">${response.success ? 'Success!' : 'Error!'}</span> ${response.message}
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
                            if (response.success) {
                                window.location.href = 'login.php'; 
                            }
                        }, 2000); 
                    }
                }, 3000); 
            })
            .catch(error => console.error('Error:', error));
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