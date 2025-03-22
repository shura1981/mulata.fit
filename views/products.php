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

.fade-banner {
                animation: fade 2s ease forwards;
            }

            @keyframes fade {
                0% {
                    opacity: 1;
                    filter: blur(20px) brightness(2);
                }

                15% {
                    opacity: 1;
                    filter: blur(10px) brightness(1.5);
                }

                100% {
                    opacity: 1;
                    filter: blur(0) brightness(1);
                }


            }




    </style>


</head>




<body>


    <div class="background">
        <img height="64" width="200" src="https://nutramerican.com/img/logonutramerican.svg"
            style="width: auto; height: 64px;" class="" alt="logo amarillo nutramerican">
        <div class="loader">Loading...</div>
    </div>

    <?php include "./views/partials/nav.php" ?>
    <!--Menú-->

    <div style="--swiper-navigation-color: rgb(0, 102, 255); 
--swiper-pagination-color: #fff;
 position: relative; background: black;" class="swiper mySwiper2  ">
        <div class="swiper-wrapper ">
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ​<picture>
                    <source media="(min-width: 600px)" class="primeraImage" srcset="data:image/webp;base64,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"  data-big="https://nutramerican.com/img/bannerBiproPinaColadaXl.webp"
                        type="image/webp">
                    <img height="340" width="600" class="open" src="https://nutramerican.com/img/bannerBiproPinaColadasm.webp"
                        style="width: 100%; height: auto;" alt="bipro classic piña colada" >
                </picture>
            </div>
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ​<picture>
                    <source media="(min-width: 600px)"  class="primeraImage" data-big="https://nutramerican.com/img/burnerlataxl.webp?v=1"  srcset="data:image/webp;base64,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" type="image/webp">
                    <img height="340" width="600" class="open " src="https://nutramerican.com/img/burnerlatasm.webp?v=1"
                         style="width: 100%; height: auto;" alt="Burner stack lata">
                </picture>
            </div>
            <div class="swiper-slide ratio ratio-16x9 bg-slider">
                ​<picture>
                    <source media="(min-width: 600px)" class="primeraImage" data-big="https://nutramerican.com/img/myth-banner.webp" srcset="data:image/webp;base64,UklGRjYWAABXRUJQVlA4WAoAAAAwAAAAfwcA9AEAQUxQSK8BAAABcNxIkiL57+rwLPO+TmfBXUTEBIQQQowxppRSzjmXUkqttbbWWu+9D8MwjOM4TtM8L8uyrOu6btu27fu+H8dxnB+v67ruj8/X709j/uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uM//uO/f0Qm/5pMCwBWUDggYBQAABBFAZ0BKoAH9QE/icTUaDcwq6egCgrgMQlpbuFaYWOPoiUaxSOWLPp5VwT//quwD/52k+bBfTv4AKEsi5w5EXOHIi5w5IKtA0fqnrOHhf3gf0y3RQ9/7wP6QlCovyYVF+TCovyYVF+TCovyYVF+TCovyYVF+TCo/Eoph/duw37kUkxj1iFQtdZAY3tVo8WA3iw9QtdZBQUC11kEqzBEkHkkdKUC2J1emTLs2cmFRfjkzf+pHpeXFRgOjmnndredGIu726nHIi7X+vJ1syju0+X0MDAwMC8sBwkF2zCuJCM5qeHBu2YVtGWA3/RIgYLVdNe1jw97FpkanR/0SHDlUkK88ZU+5rflZkzfUUA0pbDYFwwD20Iyp3RGvOIyLOC/crd2OiI7m7N6ttp/tdZEHiMmKpF5YFCIocJgiUcZzh7zfRoS/Q9ZXXFHGrcPULYnR/0PUNAAK4ihvudadILK973McUsP8haftnnds4d1ObBOGeOFjUl/cJaG3Sp5Wl/eB/SD9WQQFHGVkE4TBEo7tORKruRKOM5aha6yCcJgiUakt/iciUdR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"
                        type="image/webp">
                    <img height="340" width="600" class="open " src="https://nutramerican.com/img/banner10.webp"
                        style="width: 100%; height: auto;"  alt="pre entreno  myth">
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


    <!-- sesión asesoría -->

    <div class="asesoria d-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-uppercase">
                    ¿No sabes que comprar?
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
                        <strong>¡APROVECHA LA PROMO!</strong> Toda la suplementación con el
                        <strong>10% OFF</strong>, con el cupón <strong>MULATA. </strong> <small
                            class="font-weight-bold font-italic">Aplican términos y condiciones.</small>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- sesión contador de promo -->
    <div class="contador d-none">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <p class="text-center mb-0">
                        <strong>¡APROVECHA PROMO!</strong> Solo por la siguiente hora, toda la suplementación con el
                        <strong>15% OFF</strong>, máximo 3 productos con el cupón <strong>VIP </strong>
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

                        <!--Section: Categoría-->
                        <section class="my-5 text-muted card-panel">
                            <p><strong>CATEGORÍAS</strong></p>

                            <ul class="list-group list-group-flush">
                                <li id="ctgpederpeso" class="list-group-item">Control de peso</li>
                                <li id="ctgmodulos" class="list-group-item">Módulos proteicos</li>
                                <li id="ctghiper" class="list-group-item">Hipercalóricos</li>
                                <li id="ctgpenergia" class="list-group-item">Energía y recuperación</li>
                                <li id="ctgsnacks" class="list-group-item">Snacks Proteícos</li>
                                <li id="ctgnutricion" class="list-group-item">Nutrición general</li>
                                <li class="list-group-item all">Todas</li>
                            </ul>

                        </section>
                        <!--Section: Categoría-->

                        <!--Section: Deportes-->
                        <section class="mb-3 text-muted card-panel">
                            <p><strong>ACTIVIDADES FÍSICAS</strong></p>

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
                                        <option value="Más económico">Más económico</option>
                                        <option value="Mayor precio">Mayor precio</option>
                                    </select>
                                </span>



                            </div>

                            <div class="col-lg-4 d-none d-lg-flex justify-content-center justify-content-lg-end ">
                                <nav aria-label="botones de navegación para cambiar de páginas de productos">
                                    <ul class="pagination pagination-circle mb-0"
                                        style="    margin-bottom: 0 !important;">
                                        <li class="page-item">
                                            <a aria-label="anterior" class="page-link" href="#" tabindex="-1"
                                                aria-disabled="true">Anterior</a>
                                        </li>
                                        <li class="page-item active">
                                            <a aria-label="primera página" class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item" aria-current="page">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="siguiente página" class="page-link" href="#">3</a>
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
                                        ​<img class="img-fluid" loading="lazy" height="400" width="400"
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
                                            <button aria-label="añadir al carrito" data-add="${item.codigo}"
                                                type="button" class="btn btn-danger px-3 me-1 mb-1 btn-sm">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </div>
                                        <div class="d-none d-md-flex justify-content-center">
                                            <button aria-label="comprar" data-shop="${item.codigo}" type="button"
                                                class="btn btn-primary me-1 mb-1">
                                                Comprar
                                            </button>
                                            <button aria-label="añadir al carrito" data-add="${item.codigo}"
                                                type="button" class="btn btn-danger px-3 me-2 mb-1">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            <button aria-label="vista rápida" data-info="${item.codigo}" type="button"
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
                                        <option value="Más económico">Más económico</option>
                                        <option value="Mayor precio">Mayor precio</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-end nav-fixed">
                                <nav aria-label="botones de navegación de la tienda">
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
        <div class="text-center p-3" style="    background: linear-gradient(128deg, rgba(252, 70, 107, 1) 0%, #f1266b 100%); color: white;">
            © 2022 Copyright:
            <a class="text-white" href="https://mulata.fit/">mulata.fit</a>
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
     
    </script>

    <!-- <script type="text/javascript" src="../js/tienda.min.js?v=11"></script>
    <script defer type="text/javascript" src="../js/btnWhatsapp.js?v=2"></script> -->

    <script>
            const primeraImageList = document.querySelectorAll(".primeraImage");
            primeraImageList.forEach(primeraImage => {
                const bigImage = primeraImage.dataset.big;
                primeraImage.nextElementSibling.onload = () => {
                    primeraImage.nextElementSibling.classList.add("fade-banner");
                }
                if (window.matchMedia("(min-width: 600px)").matches) {
                    primeraImage.setAttribute("srcset", bigImage);

                }
            });


            if (history.scrollRestoration) {
                history.scrollRestoration = 'manual';
            } else {
                window.onbeforeunload = function () {
                    window.scrollTo(0, 0);
                }
            }

            console.log(primeraImageList);
        </script>


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
            <strong class="me-auto">Producto añadido </strong>
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


    <script src="<?php echo URL_VISTA?>js/tienda.min.js?v=<?php echo VERSION?>"></script>
    <?php include "./views/partials/schema_products.php" ?>
</body>








</html>