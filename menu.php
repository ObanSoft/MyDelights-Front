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
    <link rel="stylesheet" href="css/custom-styles.css">

    <style>
        #addDishBtn, #searchDishBtn {
            background-color: #b30000; 
            color: white; 
            border: none; 
            border-radius: 0; 
            padding: 10px 20px; 
            font-size: 16px; 
            cursor: pointer; 
        }
        #addDishBtn:hover, #searchDishBtn:hover {
            background-color: #ff4d4d; 
        }

        .text-wrap h4 {
            color: rgb(255, 4, 4);
            font-weight: bold; 
            font-size: 28px; 
        }

        .btn-quote {
            background-color: rgb(15, 107, 199); 
            color: white;
            border: none;
            border-radius: 0; 
            padding: 10px 30px; 
            font-size: 14px; 
            cursor: pointer; 
            display: inline-block; 
            margin-top: 10px; 
        }
        .btn-quote:hover {
            background-color: #001f4d;
        }

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
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .modal-header h5 {
            margin: 0;
            font-size: 1.5rem;
            color: #003366;
        }
        .modal-footer {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 15px; /* Añade un espacio entre los botones */
    }

    .btn-cancel {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: rgb(170, 48, 48); /* Rojo */
        color: white;
    }

    .btn-cancel:hover {
        background-color: #ff4d4d; /* Rojo más claro */
    }

    /* Botón Cotizar (Verde) */
    .btn-cotizar {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: rgb(48, 170, 48); /* Verde */
        color: white;
    }

    .btn-cotizar:hover {
        background-color: #4dff4d; /* Verde más claro */
    }
        
    </style>
</head>

<body data-spy="scroll" data-target="#navbar" class="static-layout">
    <div id="canvas-overlay"></div>
    <div class="boxed-page">
        <nav id="navbar-header" class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand navbar-brand-center d-flex align-items-center p-0 only-mobile" href="/">
                <img src="/img/logo.jpg" alt="Logo">
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
                        <img src="./img/logo.jpg" alt="Logo">
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

        <section id="gtco-menu" class="section-padding">
            <div class="container">
                <div class="section-content">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="heading-section text-center">
                                <h2>Platos</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="products-container">
                    </div>
                </div>
            </div>
        </section>

        <footer class="mastfoot pb-5 bg-white section-padding pb-0">
            <div class="inner container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-widget pr-lg-5 pr-0">
                            <img src="img/logo.jpg" class="img-fluid footer-logo mb-3" alt="Logo">
                            <p>My Delights es un sistema diseñado para facilitar la operación y gestión de restaurantes.</p>
                            <nav class="nav nav-mastfoot justify-content-start">
                                <a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-widget px-lg-5 px-0">
                            <h4>Horarios de atención</h4>
                            <ul class="list-unstyled open-hours">
                                <li class="d-flex justify-content-between"><span>Lunes</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Martes</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Miércoles</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Jueves</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Viernes</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Sábado</span><span>9:00 - 6:00</span></li>
                                <li class="d-flex justify-content-between"><span>Domingo</span><span>Cerrado</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-widget pl-lg-5 pl-0">
                            <h4>Observación</h4>
                            <p>Déjanos saber en qué podemos mejorar.</p>
                            <form id="newsletter">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="emailNewsletter" placeholder="Escribe tu correo electrónico">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">
                        <p class="mx-auto text-center mb-0">Copyright 2025. Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="modal-overlay" id="quoteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Cotizar Producto</h5>
            </div>
            <div class="modal-body">
                <p id="modalProductName"></p>
                <input type="number" id="quantityInput" class="form-control" placeholder="Ingrese la cantidad" min="1">
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
                <button class="btn-cotizar" onclick="validateAndSubmitQuote()">Cotizar</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¡Éxito!</h5>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeSuccessModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal para cantidad no disponible -->
    <div class="modal-overlay" id="quantityUnavailableModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Cantidad No Disponible</h5>
            </div>
            <div class="modal-body">
                <p>Lo sentimos, la cantidad solicitada excede la cantidad disponible en el inventario.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeQuantityUnavailableModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        let selectedProduct = null;

        async function fetchProducts() {
            try {
                const response = await fetch('http://localhost/couth_server/backend/get_products.php');
                const products = await response.json();
                renderProducts(products);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        function renderProducts(products) {
            const container = document.getElementById('products-container');
            container.innerHTML = '';

            products.forEach(product => {
                const imageUrl = 'img/logo.jpg';
                const productName = product.nombre || 'Sin nombre';
                const productPrice = product.precio || '0.00';
                const productDescription = product.descripcion || 'Descripción no disponible.';

                container.innerHTML += `
                    <div class="col-lg-4 menu-wrap">
                        <div class="menus d-flex align-items-center">
                            <div class="menu-img rounded-circle">
                                <img class="img-fluid" src="${imageUrl}" alt="${productName}">
                            </div>
                            <div class="text-wrap">
                                <h4>${productName}</h4>
                                <h4 class="text-muted menu-price">$${productPrice}</h4>
                                <p>${productDescription}</p>
                                <button class="btn btn-quote" onclick="openModal('${productName}', ${product.id})">Cotiza</button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function openModal(productName, productId) {
            selectedProduct = { name: productName, id: productId };
            document.getElementById('modalProductName').innerText = `Producto: ${productName}`;
            document.getElementById('quantityInput').value = '';
            document.getElementById('quoteModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('quoteModal').classList.remove('active');
        }

        async function validateAndSubmitQuote() {
            const quantity = document.getElementById('quantityInput').value;

            if (!quantity || isNaN(quantity) || quantity <= 0) {
                alert('Por favor, ingrese una cantidad válida.');
                return;
            }

            try {
                const validationResponse = await fetch('http://localhost/couth_server/backend/check_quantity.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        product_id: selectedProduct.id,
                        requested_quantity: parseInt(quantity)
                    }),
                });

                const validationData = await validationResponse.json();

                if (validationData.error) {
                    showQuantityUnavailableModal();
                    return;
                }

                const response = await fetch('http://localhost/couth_server/backend/create_quote.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id_producto: selectedProduct.id,
                        cantidad: parseInt(quantity)
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    closeModal();
                    showSuccessModal(`Cotización registrada con éxito. ID: ${data.id_cotizacion}`);
                } else {
                    alert(`Error al registrar la cotización: ${data.error}`);
                }
            } catch (error) {
                console.error('Error durante la validación o el registro:', error);
                alert('Ocurrió un error inesperado.');
            }
        }

        function showQuantityUnavailableModal() {
            document.getElementById('quantityUnavailableModal').classList.add('active');
        }

        function closeQuantityUnavailableModal() {
            document.getElementById('quantityUnavailableModal').classList.remove('active');
        }

        function showSuccessModal(message) {
            document.getElementById('successMessage').innerText = message;
            document.getElementById('successModal').classList.add('active');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('active');
        }

        document.addEventListener('DOMContentLoaded', fetchProducts);
    </script>
</body>

</html>