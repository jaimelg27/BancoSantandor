<?php
session_start();

if(empty($_SESSION['login_id'])){
    session_start();
    session_destroy();
    header("Location: ../login.html");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | Banco Santandor</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/ico" href="../resources/img/favicon.ico"/>
    <!--Stylesheets-->
    <link rel="stylesheet" href="../resources/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <!--Scripts-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/js/cookies.js"></script>
    <script type="text/javascript" src="../resources/js/index-js.js"></script>
</head>
<body>
<script type="text/javascript" src="resources/js/mail.js"></script>
<!--Header-->
<header class="header">
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container"><a href="../index.html" class="navbar-brand text-uppercase font-weight-bold">Banco Santandor</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Inicio
                        </a></li>
                    <li class="nav-item"><a href="money.php" class="nav-link text-uppercase font-weight-bold">Sacar/Ingresar</a></li>
                    <li class="nav-item"><a href="transfer.php" class="nav-link text-uppercase font-weight-bold">Transferencias</a></li>
                    <li class="nav-item"><a href="branches-ATMs.php" class="nav-link text-uppercase font-weight-bold">Oficinas y
                        Cajeros</a>
                    </li>
                    <li class="nav-item active"><a href="contact.php" class="nav-link text-uppercase font-weight-bold">Contacto<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item"><a href="../resources/php/logout.php" class="nav-link text-uppercase font-weight-bold">Cerrar Sesi??n</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--Formulario de contacto-->
<div class="container">
    <div class="pt-5 text-white">
        <header class="py-5 mt-5">
            <h3><center>Contactanos!!</center></h3>
        </header>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-5 mb-lg-0">
                        <form class="border-right pr-5 mb-5" method="post" action="../resources/php/contact.php">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre y Apellidos">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Correo Electr??nico">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="5" placeholder="Escriba su mensaje"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Enviar" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 ml-auto">
                        <h3 class="mb-4">Escribenos!</h3>
                        <p>Estamos a disposicion de nuestros clientes las 24 horas del d??a, los 7 d??as a la semana y los 365 d??as al a??o.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="social-footer">
    <center><p>Banco Santandor 2021-2021??</p></center>
</footer>
</body>
</html>