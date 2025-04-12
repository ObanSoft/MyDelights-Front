<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Delights - Pedidos</title>
    <meta name="description" content="Resto">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/brands.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Josefin+Sans:300,400,700">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav id="navbar-header" class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand navbar-brand-center d-flex align-items-center p-0 only-mobile" href="/">
                <img src="img/logo.jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex justify-content-between">
                    <div class="d-flex flex-lg-row flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/couth_server/MyDelights-Front/index.php">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/couth_server/MyDelights-Front/about.php">Acerca de nosotros</a>
                        </li>
                    </div>
                </ul>

                <a class="navbar-brand navbar-brand-center d-flex align-items-center only-desktop" href="#">
                    <img src="./img/logo.jpg" alt="">
                </a>
                <ul class="navbar-nav d-flex justify-content-between">
                    <div class="d-flex flex-lg-row flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/couth_server/MyDelights-Front/menu.php">Platos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/couth_server/MyDelights-Front/cotizaciones.php">Cotizaciones</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="http://localhost/couth_server/MyDelights-Front/pedidos.php">Pedidos</a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center">Lista de Pedidos</h1>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Pedido</th>
                    <th>Total</th>
                    <th>Fecha de Creación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="pedido-list">
            </tbody>
        </table>
    </div>


    <!-- External JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="vendor/bootstrap/popper.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js "></script>
    <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js"></script>
    <script src="vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Main JS -->
    <script>
        async function loadPedidos() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/get_order.php');
                const pedidos = await response.json();

                const pedidoList = document.getElementById('pedido-list');
                pedidoList.innerHTML = '';

                pedidos.forEach(pedido => {
                    pedidoList.innerHTML += `
                        <tr>
                            <td>${pedido.id_pedido}</td>
                            <td>$${parseFloat(pedido.total).toFixed(2)}</td>
                            <td>${new Date(pedido.fecha_creacion).toLocaleString()}</td>
                            <td>${pedido.estado}</td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error('Error al cargar los pedidos:', error);
                alert('No se pudieron cargar los pedidos.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadPedidos);
    </script>
</body>

</html>