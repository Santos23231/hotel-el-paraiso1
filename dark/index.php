<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Hotel el paraiso</title>
        <link href="css/indexstyle.css" rel="stylesheet" />
        <link href="css/hola.css" rel="stylesheet" />
        <link href="css/21.css" rel="stylesheet" />
        <link href="css/about.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/servicios.css">
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/contacto.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/logo_hotel.jpg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Habitaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Acerca de Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalReserva">
                                Reservar
                            </a>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                            </li>
                        <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<header class="masthead text-center text-white d-flex align-items-center">
    <video autoplay muted loop playsinline class="video-background">
        <source src="./css/images/video_hotel.mp4" type="video/mp4">
        Tu navegador no soporta la reproducción de videos.
    </video>
    <div class="container position-relative">
        <div class="masthead-subheading">Bienvenido A Hotel El Paraiso!</div>
        <div class="masthead-heading text-uppercase">Estamos aquí para hacer su estancia inolvidable.</div>
    </div>
</header>


<!-- Servicios -->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Nuestros Servicios</h2>
            <h3 class="section-subheading text-muted">Descubre todo lo que ofrecemos para hacer tu estancia inolvidable.</h3>
        </div>
        <div class="row text-center">
            <!-- Servicio 1 -->
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-concierge-bell fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Atención 24/7</h4>
                <p class="text-muted">Nuestro equipo está disponible las 24 horas para atender todas tus necesidades.</p>
            </div>
            <!-- Servicio 2 -->
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-utensils fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Restaurante Gourmet</h4>
                <p class="text-muted">Disfruta de una experiencia culinaria única con platos locales e internacionales.</p>
                
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuRestauranteModal">Ver Menú</a>
            </div>
            <!-- Servicio 3 -->
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-spa fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Spa y Bienestar</h4>
                <p class="text-muted">Relájate y rejuvenece con nuestros servicios de spa y tratamientos personalizados.</p>
            </div>
        </div>
    </div>
</section>

<!-- Menú del Restaurante en Modal Fullscreen -->
<div class="modal fade" id="menuRestauranteModal" tabindex="-1" aria-labelledby="menuRestauranteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="menuRestauranteModalLabel">Menú del Restaurante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <section class="page-section bg-light" id="restaurant-menu">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Menú del Restaurante</h2>
                    <h3 class="section-subheading text-muted">Explora nuestras opciones de desayuno, almuerzo y cena.</h3>
                </div>
                <div class="row">
                    <h1 class="text-center mb-4">DESAYUNOS</h1>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/desayuno/comida1.jpg" alt="Desayuno">
                        <p class="text-muted text-center">Empieza tu día con nuestras deliciosas opciones de desayuno.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/desayuno/comida2.jpg" alt="Desayuno">
                        <p class="text-muted text-center">Empieza tu día con nuestras deliciosas opciones de desayuno.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/desayuno/comida3.jpg" alt="Desayuno">
                        <p class="text-muted text-center">Empieza tu día con nuestras deliciosas opciones de desayuno.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/desayuno/comida4.jpg" alt="Desayuno">
                        <p class="text-muted text-center">Empieza tu día con nuestras deliciosas opciones de desayuno.</p>
                    </div>
                </div>
                <div class="row">
                    <h1 class="text-center mb-4">ALMUERZOS</h1>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/almuerzo/comida6.jpg" alt="Almuerzo">
                        <p class="text-muted text-center">Disfruta de un almuerzo exquisito con platos locales e internacionales.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/almuerzo/comida7.jpg" alt="Almuerzo">
                        <p class="text-muted text-center">Disfruta de un almuerzo exquisito con platos locales e internacionales.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/almuerzo/comida8.jpg" alt="Almuerzo">
                        <p class="text-muted text-center">Disfruta de un almuerzo exquisito con platos locales e internacionales.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/almuerzo/comida9.jpg" alt="Almuerzo">
                        <p class="text-muted text-center">Disfruta de un almuerzo exquisito con platos locales e internacionales.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/almuerzo/comida10.jpg" alt="Almuerzo">
                        <p class="text-muted text-center">Disfruta de un almuerzo exquisito con platos locales e internacionales.</p>
                    </div>
                </div>
                <div class="row">
                    <h1 class="text-center mb-4">CENAS</h1>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/cena/cena1.jpg" alt="Cena">
                        <p class="text-muted text-center">Termina tu día con una cena inolvidable en nuestro restaurante.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/cena/cena2.jpg" alt="Cena">
                        <p class="text-muted text-center">Termina tu día con una cena inolvidable en nuestro restaurante.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/cena/cena3.jpg" alt="Cena">
                        <p class="text-muted text-center">Termina tu día con una cena inolvidable en nuestro restaurante.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/cena/cena4.jpg" alt="Cena">
                        <p class="text-muted text-center">Termina tu día con una cena inolvidable en nuestro restaurante.</p>
                    </div>
        
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/cena/cena5.jpg" alt="Cena">
                        <p class="text-muted text-center">Termina tu día con una cena inolvidable en nuestro restaurante.</p>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <h3 class="section-heading text-uppercase">Bebidas</h3>
                    <h4 class="section-subheading text-muted">Refresca tu día con nuestras bebidas exclusivas.</h4>
                </div>
                <div class="row">
                    <!-- Bebida 1 -->
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/bebidas/bebida1.jpeg" alt="Bebida 1">
                        <p class="text-muted text-center">Bebida refrescante 1</p>
                    </div>
                    <!-- Bebida 2 -->
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/bebidas/bebida2.jpg" alt="Bebida 2">
                        <p class="text-muted text-center">Bebida refrescante 2</p>
                    </div>
                    <!-- Bebida 3 -->
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/bebidas/bebida3.jpg" alt="Bebida 3">
                        <p class="text-muted text-center">Bebida refrescante 3</p>             
                    </div>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/bebidas/bebida4.jpg" alt="Bebida 3">
                        <p class="text-muted text-center">Bebida refrescante 3</p>             
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <img class="img-fluid rounded mb-3" src="./css/images/bebidas/bebida5.jpg" alt="Bebida 3">
                        <p class="text-muted text-center">Bebida refrescante 3</p>             
                    </div>
                </div>
            </div>
        </section>
        </div>
    </div>
</div>

<!-- Botón para abrir el modal -->

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Habitaciones</h2>
            <h3 class="section-subheading text-muted">Bienvenidos a nuestro hotel el paraiso, donde esperamos que viva la mejor experiencia.</h3>
        </div>
        <div class="row">
            <!-- Habitación 1 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion1.jpeg" alt="Habitación 1">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 1</h5>
                        <p class="card-text">Disfruta de una experiencia única con vistas al mar y todas las comodidades.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 2 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion2.jpg" alt="Habitación 2">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 2</h5>
                        <p class="card-text">Ideal para familias, con espacio amplio y comodidades modernas.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 3 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion3.jpg" alt="Habitación 3">
                    <div class="card-body">
                        <h5 class="card-title">Habitacion 3</h5>
                        <p class="card-text">La máxima expresión de lujo y confort para una estancia inolvidable.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 4 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion4.jpg" alt="Habitación 4">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 4</h5>
                        <p class="card-text">Perfecta para viajes de negocios, con escritorio y servicios premium.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 5 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion5.jpg" alt="Habitación 5">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 5</h5>
                        <p class="card-text">Espaciosa y cómoda, ideal para compartir con amigos o familiares.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 6 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion6.jpg" alt="Habitación 6">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 6</h5>
                        <p class="card-text">Con vistas panorámicas y servicios exclusivos para una experiencia única.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 7 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion7.jpg" alt="Habitación 7">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 7</h5>
                        <p class="card-text">Diseñada para el máximo confort, con detalles de lujo en cada rincón.</p>
                    </div>
                </div>
            </div>
            <!-- Habitación 8 -->
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="./css/images/habitacion8.jpg" alt="Habitación 8">
                    <div class="card-body">
                        <h5 class="card-title">Habitación 8</h5>
                        <p class="card-text">La opción más exclusiva, con servicios personalizados y decoración elegante.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Acerca de nosotros -->
<section class="page-section bg-light" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Acerca de nosotros</h2>
            <h3 class="section-subheading text-muted">Conoce más sobre nuestro hotel</h3>
        </div>
        <div class="row justify-content-center">
            <!-- Historia -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow">
                    <img src="./css/images/emirates.jpg" class="card-img-top rounded-circle mx-auto mt-3" style="width:100px;height:100px;object-fit:cover;" alt="Hotel El Paraiso">
                    <div class="card-body text-center">
                        <h5 class="card-title">Hotel El Paraiso</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Fundado en 2012</h6>
                        <p class="card-text">Hotel el Paraiso nació del sueño de una familia apasionada por la hospitalidad. Todo comenzó con una pequeña casa frente al mar, donde recibían viajeros con un café caliente y una conversación acogedora. Con el tiempo, la demanda creció y la casa se transformó en un hotel, donde cada habitación refleja la esencia de la tranquilidad y el confort. Hoy, Hotel El Paraiso sigue siendo un refugio para quienes buscan descanso y momentos inolvidables, manteniendo la calidez con la que todo inició.</p>
                    </div>
                </div>
            </div>
            <!-- Misión -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="card-img-top rounded-circle mx-auto mt-3" style="width:100px;height:100px;object-fit:cover;" alt="Misión">
                    <div class="card-body text-center">
                        <h5 class="card-title">Misión del Hotel</h5>
                        <h6 class="card-subtitle mb-2 text-muted">La mejor experiencia</h6>
                        <p class="card-text">Brindar una experiencia única de hospitalidad, combinando confort, atención personalizada y un ambiente acogedor. Nos comprometemos a ofrecer servicios de alta calidad que hagan sentir a cada huésped como en casa, creando recuerdos inolvidables en cada estancia.</p>
                    </div>
                </div>
            </div>
            <!-- Visión -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" class="card-img-top rounded-circle mx-auto mt-3" style="width:100px;height:100px;object-fit:cover;" alt="Visión">
                    <div class="card-body text-center">
                        <h5 class="card-title">Visión del Hotel</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Ofrecer una experiencia inolvidable</h6>
                        <p class="card-text">Ser el hotel de referencia en nuestra región, reconocido por la excelencia en servicio, la innovación en el turismo y nuestro compromiso con la sostenibilidad. Aspiramos a crecer y evolucionar, manteniendo siempre nuestra esencia de calidez y calidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Reserva -->
<div class="modal fade" id="modalReserva" tabindex="-1" aria-labelledby="modalReservaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="guardar_reserva.php" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReservaLabel">Reservar Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    <div id="edad-error" class="text-danger mt-1" style="display:none;"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="mb-3">
                    <label for="checkin" class="form-label">Check-in (Fecha y hora de entrada)</label>
                    <input type="datetime-local" class="form-control" id="checkin" name="checkin" required>
                </div>
                <div class="mb-3">
                    <label for="checkout" class="form-label">Check-out (Fecha y hora de salida)</label>
                    <input type="datetime-local" class="form-control" id="checkout" name="checkout" required>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

<!-- contacto -->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading text-uppercase">Contacto</h2>
            <h3 class="section-subheading text-muted">¿Tienes dudas o quieres reservar? ¡Contáctanos o síguenos en redes sociales!</h3>
        </div>
        <div class="row justify-content-center">
            <!-- Redes Sociales -->
            <div class="col-md-5 mb-4">
                <div class="card h-100 shadow text-center p-4">
                    <h5 class="card-title mb-3">Síguenos en redes sociales</h5>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="https://www.facebook.com/HotelElParaiso" target="_blank" class="btn btn-outline-primary btn-lg mx-2" title="Facebook">
                            <i class="fab fa-facebook-f fa-2x"></i>
                        </a>
                        <a href="https://www.instagram.com/Hotel_Paraiso" target="_blank" class="btn btn-outline-danger btn-lg mx-2" title="Instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="mailto:hotelparaiso@g.mail.com" class="btn btn-outline-secondary btn-lg mx-2" title="Correo">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-muted mb-0">hotelparaiso@gmail.com</p>
                </div>
            </div>
            <!-- Formulario de contacto -->
            <div class="col-md-7 mb-4">
                <div class="card h-100 shadow p-4">
                    <h5 class="card-title mb-3">Envíanos un mensaje</h5>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Tu correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Escribe tu mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#modalReserva form');
    const fechaNacimiento = document.getElementById('fecha_nacimiento');
    const edadError = document.getElementById('edad-error');

    form.addEventListener('submit', function(e) {
        const fecha = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fecha.getFullYear();
        const m = hoy.getMonth() - fecha.getMonth();
        if (m < 0 || (m === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        if (edad < 18) {
            e.preventDefault();
            edadError.textContent = "No puede hacer una reservación porque es menor de edad.";
            edadError.style.display = "block";
            fechaNacimiento.classList.add('is-invalid');
        } else {
            edadError.style.display = "none";
            fechaNacimiento.classList.remove('is-invalid');
        }
    });
});
</script>