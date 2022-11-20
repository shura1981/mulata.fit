<?php
$url= $_SERVER["REQUEST_URI"];
$url= explode("/", $url);
$ruta= $url[(count($url)-1)];
require 'modelos/planesMulata.php';
$planes= new Tb_planes_mulata();
$row= json_decode($planes->getPlanes($ruta));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo URL_VISTA?>icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo URL_VISTA?>icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL_VISTA?>icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL_VISTA?>icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL_VISTA?>icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo URL_VISTA?>icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo URL_VISTA?>icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo URL_VISTA?>icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL_VISTA?>icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo URL_VISTA?>icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL_VISTA?>icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo URL_VISTA?>icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_VISTA?>icons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo URL_VISTA?>manifest.webmanifest">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo URL_VISTA?>icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#e91e63">
    <link rel="preload" as="style" href="<?php echo URL_VISTA?>css/mdb.min.css" />
    <link href="<?php echo URL_VISTA?>fonts/Lato/stylesheet.css" rel="preload" as="style">
    <link rel="preconnect dns-prefetch" href="https://www.google-analytics.com">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ruta?></title>
    <link href="<?php echo URL_VISTA?>fonts/Lato/stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL_VISTA?>css/mdb.min.css" />
    <link rel="stylesheet" href="<?php echo URL_VISTA?>css/root.css?v=<?php echo VERSION?>" />
    <link rel="stylesheet" href="<?php echo URL_VISTA?>css/services.css?v=<?php echo VERSION?>" />
    <link rel="stylesheet" href="<?php echo URL_VISTA?>css/file-upload.min.css?v=<?php echo VERSION?>" />
    <script defer type="text/javascript" src="<?php echo URL_VISTA?>js/mdb.min.js"></script>
    <script defer type="text/javascript" src="<?php echo URL_VISTA?>js/file-upload.min.js"></script>
    <script defer type="text/javascript" src="<?php echo URL_VISTA?>js/sweetalert2@11/sweetalert2@11.js"></script>
    <script defer src="<?php echo URL_VISTA?>js/service.js?v=<?php echo VERSION?>"></script>
    <script>
    const host =
        <?= json_encode(URL_VISTA,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
    const dominio = <?= json_encode(URL_SERVER,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
    const plan = <?= json_encode($row,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
   console.log(plan);
   </script>
</head>

<body>
    <div class="pay">
        <div class="container relative my-4">
            <span class="getBack">
                <a href="<?php echo URL_SERVER?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>

                </a>

            </span>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 my-4">
                    <h3 class=" text-center color-primary">Completa el formulario </h3>
                    <h1 class="mb-4 pb-2 text-center font-italic">y adjunta el comprobante de pago.</h1>
                    <form id="form" method="POST">
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input required type="text" id="name" name="name" class="form-control" />
                            <label class="form-label" for="name">Nombre</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input required type="email" id="email" name="email" class="form-control" />
                            <label class="form-label" for="email">Correo</label>
                        </div>

                        <!-- Celular input -->
                        <div class="form-outline mb-5">
                            <input required type="number" id="celular" name="celular" class="form-control" />
                            <label class="form-label" for="celular">Nº de celular</label>
                        </div>

                        <div class="file-upload-wrapper my-3">
                            <input multiple id="anexos" type="file" class="file-upload-input"
                                data-mdb-max-file-quantity="3" data-mdb-file-upload="file-upload"
                                data-mdb-default-msg="Presiona aquí y anexa el comprobante de pago" />
                        </div>
                        <div id="vanexos" class="form-text-error mb-3 d-none">
                            Por favor adjunta el comprobante de pago
                        </div>
                        <!-- Submit button -->
                        <div class="pt-5">
                            <button id="custom-validation-button" type="Submit"
                                class="btn bg-sucess btn-center my-3 my-md-0 d-block mx-auto ">
                                Enviar
                            </button>
                        </div>


                        <!-- Status message -->
                        <div id="status" class="py-3"></div>
                    </form>

                </div>

            </div>
        </div>



        <div class="description-pay">

            <div class="relative">
                <ul class="list-group list-group-light mb-3">
                    <li class="list-group-item">
                        <h1>Datos de consignación:</h1>
                    </li>
                    <li class="list-group-item">
                        <strong>1.</strong> Cuenta Bancolombia
                        (Cristian Andrés Doria Vargas)
                        <strong>Ahorro 91217217534</strong>
                    </li>
                    <li class="list-group-item"> <strong>2.</strong> Paypal :sunnydoriakyk@gmail.com</li>
                    <li class="list-group-item"><strong>3.</strong> Nequi 3127899708 </li>
                    <li class="list-group-item"> <strong>4.</strong> Daviplata 3225210073 </li>
                    <li class="list-group-item">
                        <strong>Efecty-western union</strong> <br>
                        <strong>Nombre:</strong> Sunny <br>
                        <strong>Apellidos:</strong> Doria Vargas<br>
                        <strong>Cédula :</strong> 55245715<br>
                        <strong>Ciudad: </strong> Barranquilla -colombia
                        <br>
                    </li>
                </ul>
                <h4>
                    Solo se reciben giros internacionales por PayPal de lo contrario consúltame antes de realizar tu
                    giro. GRACIAS.
                </h4>


            </div>





        </div>



    </div>
</body>

</html>