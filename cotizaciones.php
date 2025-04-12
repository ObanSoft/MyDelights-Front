<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Delights</title>
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
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease-in-out;
        }

        .modal-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .modal-content {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 400px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .modal-header h5 {
            margin: 0;
            font-size: 1.5rem;
            color: #003366;
        }

        .modal-body {
            margin-top: 10px;
        }

        .modal-footer {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .modal-footer button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-close {
            background-color: #b30000;
            color: white;
        }

        .btn-close:hover {
            background-color: #ff4d4d;
        }

        .btn-confirm {
            background-color: #003366;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #004d99;
        }
    </style>
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

    <div class="container mt-5">
        <h1 class="text-center">Lista de Cotizaciones</h1>
        <div class="d-flex justify-content-end my-3">
            <button class="btn btn-success me-2" onclick="showTotalModal()">Calcular Total</button>
            <button class="btn btn-danger" onclick="showDeleteModal()">Borrar Todas las Cotizaciones</button>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Cotización</th>
                    <th>Nombre del Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="quote-list">
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total General: $<span id="total-amount">0.00</span></h4>
        </div>
    </div>

    <div class="modal-overlay" id="totalModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Total de Cotizaciones</h5>
            </div>
            <div class="modal-body">
                <p>El total general de las cotizaciones es:</p>
                <h4 id="totalModalAmount">$0.00</h4>
            </div>
            <div class="modal-footer">
                <button class="btn-confirm" onclick="createPedido()">Generar Pedido</button>
                <button class="btn-close" onclick="closeTotalModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="validationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Validación</h5>
            </div>
            <div class="modal-body">
                <p>No se puede generar un pedido sin cotizaciones. Por favor, agregue al menos una cotización.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeValidationModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="orderSuccessModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¡Pedido Creado!</h5>
            </div>
            <div class="modal-body">
                <p>El pedido se generó correctamente. Podrá verlo en la vista de pedidos.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-confirm" onclick="redirectToOrders()">OK</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Confirmar Eliminación</h5>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar todas las cotizaciones? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-confirm" onclick="deleteAllQuotes()">Confirmar</button>
                <button class="btn-close" onclick="closeDeleteModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¡Eliminación Exitosa!</h5>
            </div>
            <div class="modal-body">
                <p>Todas las cotizaciones han sido eliminadas correctamente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeSuccessModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        let totalAmount = 0;

        async function loadQuotes() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/get_quotes.php');
                const quotes = await response.json();

                const quoteList = document.getElementById('quote-list');
                quoteList.innerHTML = '';
                totalAmount = 0;

                quotes.forEach(quote => {
                    const total = parseFloat(quote.precio) * parseInt(quote.cantidad);
                    totalAmount += total;

                    quoteList.innerHTML += `
                        <tr>
                            <td>${quote.id_cotizacion}</td>
                            <td>${quote.nombre_producto}</td>
                            <td>$${parseFloat(quote.precio).toFixed(2)}</td>
                            <td>${quote.cantidad}</td>
                            <td>$${total.toFixed(2)}</td>
                        </tr>
                    `;
                });

                document.getElementById('total-amount').innerText = totalAmount.toFixed(2);
            } catch (error) {
                console.error('Error al cargar las cotizaciones:', error);
                alert('No se pudieron cargar las cotizaciones.');
            }
        }

        async function createPedido() {
        try {
            const response = await fetch('http://localhost/couth_server/backend/get_quotes.php');
            const quotes = await response.json();

            if (quotes.length === 0) {
                showValidationModal();
                return;
            }

            const pedidoData = {
                cotizaciones: quotes.map(quote => ({
                    id_cotizacion: quote.id_cotizacion,
                    cantidad: quote.cantidad
                }))
            };

            const pedidoResponse = await fetch('http://localhost/couth_server/backend/create_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(pedidoData),
            });

            const pedidoResult = await pedidoResponse.json();

            if (pedidoResult.success) {
                // Mostrar la modal de éxito del pedido
                showOrderSuccessModal();
                // Recargar las cotizaciones para reflejar los cambios
                loadQuotes();
            } else {
                // Manejar errores específicos de la API
                console.error('Error al crear el pedido:', pedidoResult.error);
                alert(`Error al crear el pedido: ${pedidoResult.error}`);
            }
        } catch (error) {
            console.error('Error al crear el pedido:', error);
            alert('Ocurrió un error al crear el pedido. Por favor, inténtelo nuevamente.');
        }
    }

        async function deleteAllQuotes() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/delete_quotes.php', {
                    method: 'DELETE'
                });

                const result = await response.json();

                if (response.status === 200) {
                    showSuccessModal();
                    closeDeleteModal();
                    loadQuotes();
                } else {
                    alert(`Error: ${result.error}`);
                }
            } catch (error) {
                console.error('Error al eliminar las cotizaciones:', error);
                alert('No se pudieron eliminar las cotizaciones. Por favor, inténtelo de nuevo.');
            }
        }

        function showTotalModal() {
            document.getElementById('totalModalAmount').innerText = `$${totalAmount.toFixed(2)}`;
            document.getElementById('totalModal').classList.add('active');
        }

        function closeTotalModal() {
            document.getElementById('totalModal').classList.remove('active');
        }

        function showDeleteModal() {
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        function showSuccessModal() {
            document.getElementById('successModal').classList.add('active');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('active');
        }
        function showValidationModal() {
            document.getElementById('validationModal').classList.add('active');
        }

        function closeValidationModal() {
            document.getElementById('validationModal').classList.remove('active');
        }

        function showOrderSuccessModal() {
            document.getElementById('orderSuccessModal').classList.add('active');
        }

        function redirectToOrders() {
            window.location.href = "http://localhost/couth_server/frontend/pedidos.php";
        }

        document.addEventListener('DOMContentLoaded', loadQuotes);
    </script>
</body>

</html>