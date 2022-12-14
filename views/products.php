<!DOCTYPE html>
<html lang="en">
<?php  
require_once('modelos/productos.php');
$p= new Productos();
 
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda mulata fit</title>
    <?php include "./views/partials/metaproducts.php" ?>
    <?php include "./views/partials/links.php" ?>
    <link rel="stylesheet" href="<?php echo URL_VISTA?>css/productos.css?v=<?php echo VERSION?>" />
    <script defer type="text/javascript" src="<?php echo URL_VISTA?>js/toast.min.js"></script>
    <!-- <script defer type="text/javascript" src="<?php echo URL_VISTA?>/ecommerceNutra/findProduct/index.js"></script> -->


    <style>
    body {
        background-color: var(--mulata-color-bg);
        font-family: var(--font-family);
        font-weight: normal;
        font-style: normal;
    }

    .nav {
        z-index: 4;
    }

    .contador {
        background: rgb(252, 70, 107);
        background: linear-gradient(128deg, rgba(252, 70, 107, 1) 0%, #f1266b 100%);
        color: white;
    }

    #time {
        font-size: 2rem;
        font-weight: bolder;
        width: 6.5rem;
        background: white;
        color: #f83a6b;
        border-radius: .5rem;
    }

    .bg-image {
        padding: .5rem;
    }

    @media screen and (max-width: 600px) {
        footer {
            visibility: hidden;
        }

        .mySwiper2 {
            margin-top: 70px;

        }

        .mySwiper2 {
            margin-top: 0px !important;
        }

        .close-info {
            right: 5.2%;
            top: 1.2%;
        }

    }

    @media screen and (min-width: 760px) {
        .ratio-16x9 {
            --mdb-aspect-ratio: 26.25%;
        }
    }

    .bg-slider {
        background: #fc466b;
    background: linear-gradient(128deg, #fc466b 0%, #f1266b 100%);
    }

    span.badge.bg-danger.ms-2 {
        font-size: 1.1rem;
    }


    .list-group-item.media {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        position: relative;
    }

    .list-group-item.media::before {
        content: '';
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 1;
        position: absolute;

    }

    .media-item {}

    .media-item p {
        text-align: left;
        padding: 0;
        border-radius: 0;
        text-transform: capitalize;
        font-size: .8rem;
        background: #0000;
    }

    .list-group-item:hover {
        color: #292929;
        background-color: #b6b6b61c;
        transition: all 0.2s ease;
    }

    #bestsales [data-info]:hover,
    [data-info]:focus {
        color: #212121 !important;
        background: #dcdcdc !important;
    }

    .text-muted {
           color: var(--colorPrimary) !important;
    }
    .mask{
        cursor: pointer;
    }


@media(max-width:690px) and (orientation: landscape){
    .ratio-16x9 {
    --mdb-aspect-ratio: 26.25% !important;
}
}

/* .ratio::after{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, #0000003b, #0000);
} */
/* 
#showCard{
    position:relative;
}

#showCard::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: #ffffff42;
    border-radius: 50%;
    transform: scale(1.5);
    z-index: -1;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
} */


    </style>


</head>




<body>


    <div class="background">
        <img height="64" width="200" src="https://nutramerican.com/img/logonutramerican.svg"
            style="width: auto; height: 64px;" class="" alt="logo amarillo nutramerican">
        <div class="loader">Loading...</div>
    </div>

    <?php include "./views/partials/nav.php" ?>
    <!--Men??-->

    <div style="--swiper-navigation-color: rgb(0, 102, 255); 
--swiper-pagination-color: #fff;
 position: relative; background: black;" class="swiper mySwiper2  ">
        <div class="swiper-wrapper ">
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ???<picture>
                    <source media="(min-width: 600px)" srcset="https://nutramerican.com/img/desafiov3.webp"
                        type="image/webp">
                    <img height="340" width="600" class="open" src="https://nutramerican.com/img/banner11.webp"
                        style="width: 100%; height: auto;" alt="bipro desaf??o box">
                </picture>
            </div>
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ???<picture>
                    <source media="(min-width: 600px)" srcset="https://nutramerican.com/img/2v1.webp" type="image/webp">
                    <img height="340" width="600" class="open " src="https://nutramerican.com/img/banner12.webp"
                        loading="lazy" style="width: 100%; height: auto;" alt="Bipro classic cookies and cream">
                </picture>
            </div>
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ???<picture>
                    <source media="(min-width: 600px)" srcset="https://nutramerican.com/img/1v2.webp?v=1"
                        type="image/webp">
                    <img height="340" width="600" class="open " src="https://nutramerican.com/img/banner10.webp"
                        style="width: 100%; height: auto;" loading="lazy" alt="Burner stack">
                </picture>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- 

<div class="contenedor d-none d-md-block z-depth-2" style="background: black;" >
<div class="swiper mySwiper" >
<div class="swiper-wrapper">
<div class="swiper-slide" >
    <a href="https://nutramerican.com/producto/biproclassic_vainilla2l" target="_blank" >
    <img  width="1920" height="501" style="width: 100%; height: auto;" src="../img/desafiov3.webp" alt="bipro"  class="capa1">
    </a>

</div>
<div class="swiper-slide" >
    <a href="https://nutramerican.com/producto/bipro_classic_cookies_cream3lB" target="_blank" >
        <img  width="1920" height="501" style="width: 100%; height: auto;"  data-imgbaner="../img/2v1.webp" src="../img/loadbannerproductos.jpg" alt="bipro"  class="animated capa1">
    </a>


</div>
<div class="swiper-slide" >
    <a href="https://nutramerican.com/producto/burnerstack_" target="_blank" >
        <img width="1920" height="501" style="width: 100%; height: auto;" data-imgbaner="../img/1v2.webp?v=1" src="../img/loadbannerproductos.jpg"  alt="bipro"  class="animated capa1">
    </a>

</div>
</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>
</div>
</div>

 -->


    <!-- sesi??n asesor??a -->

    <div class="asesoria d-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-uppercase">
                    ??No sabes que comprar?
                </div>
                <div class="col-12 my-2">
                    <button id="btn-asesoria" style="overflow: hidden;" type="button" class="btn btn-outline-light"
                        data-mdb-ripple-color="dark">Te asesoramos</button>
                </div>
            </div>
        </div>
    </div>

    <div class="contador">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <p class="text-center mb-0">
                        <strong>??APROVECHA LA PROMO!</strong> Toda la suplementaci??n con el
                        <strong>10% OFF</strong>, con el cup??n <strong>MULATA. </strong> <small
                            class="font-weight-bold font-italic">Aplican t??rminos y condiciones.</small>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- sesi??n contador de promo -->
    <div class="contador d-none">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <p class="text-center mb-0">
                        <strong>??APROVECHA PROMO!</strong> Solo por la siguiente hora, toda la suplementaci??n con el
                        <strong>15% OFF</strong>, m??ximo 3 productos con el cup??n <strong>VIP </strong>
                    </p>
                    <div class="d-flex justify-content-center align-items-center my-2">
                        <span>
                            Termina en:
                        </span>
                        <span id="time" class="text-center mx-3 "> 59:00 </span>
                        <span>Minutos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main layout-->
    <main class="mt-3">
        <div class="container">
            <div class="row relative">
                <div class="fondo d-none"> </div>
                <div class="col-md-3 filtermobile">
                    <!--Section: Filters-->
                    <section>

                        <div class="group" style="margin-top: 0.5rem;">
                            <input id="search" type="text" placeholder="Buscar Producto" required>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <!-- <label>Buscar producto</label> -->
                            <span class="d-none d-md-none resultados">Resultados encontrados: <strong class="ms-1"
                                    id="totalr"> </strong> <strong class="px-2"
                                    style="background: #e5e5e5;border-radius: 0.2rem;" onClick="ocultar()"> Ver
                                </strong></span>
                        </div>

                        <!-- <h5 class="my-4">Filtros</h5> -->

                        <!--Section: Objetivos-->
                        <section class="text-muted card-panel mt-5">
                            <p><strong>MEJORES VENTAS</strong></p>
                            <!-- <p><strong>OBJETIVOS</strong></p> -->
                            <ul id="bestsales" class="list-group list-group-flush">
                            </ul>


                        </section>
                        <!--Section: Objetivos-->

                        <!--Section: Categor??a-->
                        <section class="my-5 text-muted card-panel">
                            <p><strong>CATEGOR??AS</strong></p>

                            <ul class="list-group list-group-flush">
                                <li id="ctgpederpeso" class="list-group-item">Control de peso</li>
                                <li id="ctgmodulos" class="list-group-item">M??dulos proteicos</li>
                                <li id="ctghiper" class="list-group-item">Hipercal??ricos</li>
                                <li id="ctgpenergia" class="list-group-item">Energ??a y recuperaci??n</li>
                                <li id="ctgsnacks" class="list-group-item">Snacks Prote??cos</li>
                                <li id="ctgnutricion" class="list-group-item">Nutrici??n general</li>
                                <li class="list-group-item all">Todas</li>
                            </ul>

                        </section>
                        <!--Section: Categor??a-->

                        <!--Section: Deportes-->
                        <section class="mb-3 text-muted card-panel">
                            <p><strong>ACTIVIDADES F??SICAS</strong></p>

                            <ul class="list-group list-group-flush">
                                <li id="crossfit" class="list-group-item">Crossfit</li>
                                <li id="resistencia" class="list-group-item">Running y Ciclismo</li>
                                <li id="pesas" class="list-group-item">Pesas</li>
                                <li id="autocarga" class="list-group-item">Autocarga</li>
                                <li id="bailoterapia" class="list-group-item">Bailoterapia</li>
                                <li id="pilates" class="list-group-item">Pilates</li>
                                <li class="list-group-item all">Todas</li>
                            </ul>



                        </section>
                        <!--Section: Deportes-->


                    </section>
                    <!--Section: Filters-->
                </div>

                <div class="col-md-9">
                    <!--Section: Sorting panel-->
                    <section>
                        <div class="row py-4">
                            <div class="col-5 col-lg-3 d-flex align-items-center justify-content-center">
                                <a href="#" aria-label="filtros" id="btnfilter" class="text-reset"><i
                                        class="fas fa-search fa-lg  d-inline d-md-none"></i></a>
                                <a href="#" aria-label="detalle de la lista de productos"
                                    class="list text-reset mx-3"><i class="fas fa-th-list fa-lg "></i></a>
                                <a href="#" aria-label="lista productos" class="grid text-reset"><i
                                        class="fas fa-th-large fa-lg"></i></a>
                            </div>

                            <div class="col-7 col-lg-5 d-flex justify-content-center">
                                <span class="select-border">
                                    <select class="select">
                                        <option value="Por defecto">por defecto</option>
                                        <option value="Promociones">Promociones</option>
                                        <option value="M??s econ??mico">M??s econ??mico</option>
                                        <option value="Mayor precio">Mayor precio</option>
                                    </select>
                                </span>



                            </div>

                            <div class="col-lg-4 d-none d-lg-flex justify-content-center justify-content-lg-end ">
                                <nav aria-label="botones de navegaci??n para cambiar de p??ginas de productos">
                                    <ul class="pagination pagination-circle mb-0"
                                        style="    margin-bottom: 0 !important;">
                                        <li class="page-item">
                                            <a aria-label="anterior" class="page-link" href="#" tabindex="-1"
                                                aria-disabled="true">Anterior</a>
                                        </li>
                                        <li class="page-item active">
                                            <a aria-label="primera p??gina" class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item" aria-current="page">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="siguiente p??gina" class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="siguiente" class="page-link" href="#">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </section>
                    <!--Section: Sorting panel-->
                    <!--Section: Bestsellers-->
                    <section class="text-center">
                        <div id="list" class="row ">
                            <?php 
                           foreach( array_slice( json_decode($p->ProductosDisponibles()),0,12) as $key=>$value): ?>

                            <div class="col-6 col-lg-4 mb-4">


                                <div class="card h-100">
                                    <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                        ???<img class="img-fluid" loading="lazy" height="400" width="400"
                                            src="<?php echo $value->imageswebp->medium;  ?>" alt="${item.producto }">
                                        <a arial-label="${item.producto}"
                                            href="https://nutramerican.com/producto/<?php echo $value->ruta;?>">
                                            <div class="mask">
                                                <div class="d-flex justify-content-start align-items-end h-100">
                                                </div>
                                            </div>
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="card-title">
                                                <h5 class=""> <?php echo $value->producto;?> </h5>
                                            </div>
                                            <span class="text-reset">
                                                <?php echo $value->valor;?>
                                            </span>
                                        </div>

                                        <div class="d-flex d-md-none justify-content-center">
                                            <button aria-label="comprar" data-shop="${item.codigo}" type="button"
                                                class="btn btn-primary me-1 mb-1 btn-sm">
                                                Comprar
                                            </button>
                                            <button aria-label="a??adir al carrito" data-add="${item.codigo}"
                                                type="button" class="btn btn-danger px-3 me-1 mb-1 btn-sm">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-none d-md-flex justify-content-center">
                                            <button aria-label="comprar" data-shop="${item.codigo}" type="button"
                                                class="btn btn-primary me-1 mb-1">
                                                Comprar
                                            </button>
                                            <button aria-label="a??adir al carrito" data-add="${item.codigo}"
                                                type="button" class="btn btn-danger px-3 me-2 mb-1">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            <button aria-label="vista r??pida" data-info="${item.codigo}" type="button"
                                                class="btn btn-danger px-3 mb-1">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>








                            </div>


                            <?php endforeach; ?>


                        </div>
                    </section>
                    <!--Section: Bestsellers-->
                    <!--Section: Sorting panel-->
                    <section class="my-4">
                        <div class="row align-items-center">
                            <div class="col-lg-3 d-none d-lg-block">
                                <a href="#" class="list text-reset"><i class="fas fa-th-list fa-lg me-1"></i></a>
                                <a href="#" class="grid text-reset"><i class="fas fa-th-large fa-lg"></i></a>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                                <span class="select-border">
                                    <select class="select">
                                        <option value="Por defecto">por defecto</option>
                                        <option value="Promociones">Promociones</option>
                                        <option value="M??s econ??mico">M??s econ??mico</option>
                                        <option value="Mayor precio">Mayor precio</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-end nav-fixed">
                                <nav aria-label="botones de navegaci??n de la tienda">
                                    <ul class="pagination pagination-circle" id="pagination"
                                        style="    margin-bottom: 0 !important;">
                                        <li class="page-item">
                                            <a class="page-link" href="#" tabindex="-1"
                                                aria-disabled="true">Anterior</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link active" href="#">1</a>
                                        </li>
                                        <li class="page-item" aria-current="page">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </section>
                    <!--Section: Sorting panel-->
                </div>
            </div>
        </div>
    </main>
    <!--footer-->
    <footer class="bg-light text-center text-lg-start start-footer">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgb(2, 91, 255); color: white;">
            ?? 2020 Copyright:
            <a class="text-white" href="https://nutramerican.com/">nutramerican.com</a>
        </div>
        <!-- Copyright -->
    </footer>


    <div class="img-dialog d-none">
        <div class="content-img">
            <img id="zoom" src="">
        </div>
    </div>
    <script>
    var productos =
        JSON.parse(
            <?= json_encode($p->ProductosDisponibles(),JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>
        );
    var tempProductos = productos;
    console.log(productos);
    </script>

    <!-- <script type="text/javascript" src="../js/tienda.min.js?v=11"></script>
    <script defer type="text/javascript" src="../js/btnWhatsapp.js?v=2"></script> -->
    <script>
    const listenerMenuBottom = () => {
        var nav = document.querySelector(".nav-fixed");
        const target = document.querySelector('.start-footer');
        var top = target.offsetTop;
        var height = target.clientHeight
        window.addEventListener('scroll', function(e) {
            const value = (top - height) < this.pageYOffset ? true : false;
            if (value) {
                nav.style.position = "relative";
                nav.style.background = "#ffffff";
            } else {
                nav.style.position = "fixed";
                nav.style.background = "#f8f8f8";
            }
            // console.log(value, top, height, this.pageYOffset,(top - height));
        });

    }
    const RemoveMenu = () => {
        let mql = window.matchMedia('(max-width: 600px)');

        function myFunction(x) {
            if (x.matches) { // If media query matches
                listenerMenuBottom();
            }
            x.onchange = () => {
                myFunction(x);
            }
        }
        myFunction(mql);
    }
    RemoveMenu();

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }

            localStorage.setItem("countdown", (minutes - 1).toString());

        }, 1000);
    }
    const showTimer = () => {
        const has = window.location.hash;
        if (has && has == "#cuponvip") {
            document.querySelector(".contador").classList.remove("d-none");
            var Minutes = 60 * 59;
            var display = document.querySelector('#time');
            const countdown = localStorage.getItem("countdown");
            if (countdown) Minutes = (Number(countdown) <= 0 || countdown == "NaN") ? Minutes : Number(countdown) *
                60;
            startTimer(Minutes, display);
        }
    }
    // showTimer();
    </script>

    <div class="toast fade" id="basic-primary-example" role="alert" aria-live="assertive" aria-atomic="true"
        data-mdb-autohide="true" data-mdb-delay="2000" data-mdb-position="top-right" data-mdb-append-to-body="true"
        data-mdb-stacking="true" data-mdb-width="auto" data-mdb-color="primary">
        <div class="toast-header text-white">
            <strong class="me-auto">Producto a??adido </strong>
            <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body text-white"></div>
    </div>

    <div class="info-modal">
        <div class="card-info">
            <i class="fas fa-times close-info fa-lg " onclick="cerrarInfo()"></i>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div id="img-info">

                        </div>
                    </div>
                    <div class="col-md-6" id="body-info">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-modal">
        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-12 col-md-8">
                    <div id="chat" class="card">
                        <i id="closechat" class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo URL_VISTA?>js/tienda.js?v=<?php echo VERSION?>"></script>
    <?php include "./views/partials/schema_products.php" ?>
</body>








</html>