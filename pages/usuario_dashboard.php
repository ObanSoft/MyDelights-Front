<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
</head>
<body>
    <?php include '../components/navbar_usuario.php'; ?>

    <div class="dashboard-container">
        <div class="card">
            <div class="card-content">
                <h5 class="card-title">Bienvenido a MyDelights</h5>
                <p class="card-description">
                    MyDelights es una aplicación diseñada para simplificar la administración de platos, pedidos y clientes. 
                    Con herramientas intuitivas y funcionalidad avanzada, MyDelights te ayuda a gestionar tu restaurante de manera eficiente.
                </p>
                <button class="card-button" onclick="window.location.href='../pages/views/platos_usuario.php'">Ver Platos</button>
            </div>
            
            <div class="card-image">
                <img src="../images/fondo-principal.jpg" alt="MyDelights" />
            </div>
        </div>
    </div>
</body>
</html>