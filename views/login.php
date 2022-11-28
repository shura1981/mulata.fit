
<?php
session_start();
if(isset($_SESSION['nombredelusuario']))
{
	header('location:test');
}

if(isset($_POST['btningresar']))
{
	
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="crisenri_intranet";
	
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn)
	{
		die("No hay conexión: ".mysqli_connect_error());
	}
	
	$nombre=$_POST['username'];
	$pass=$_POST['password'];
	$loginCheck= (isset($_POST['loginCheck'])) ? 1: 0;

 

	$query=mysqli_query($conn,"Select * from tb_empleados where email = '".$nombre."' and pass = '".$pass."'");
    // echo $query;
	$nr=mysqli_num_rows($query);
	
	if(!isset($_SESSION['nombredelusuario']))
	{
	if($nr == 1 )
	{
       
		$_SESSION['nombredelusuario']=$nombre;
		header("location: test");
	}
	else if ($nr == 0)
	{
		echo "<script>alert('Usuario no existe');window.location= 'login' </script>";
	}
	}
}
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo URL_VISTA ?>icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo URL_VISTA ?>icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL_VISTA ?>icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL_VISTA ?>icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL_VISTA ?>icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo URL_VISTA ?>icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo URL_VISTA ?>icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo URL_VISTA ?>icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL_VISTA ?>icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo URL_VISTA ?>icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL_VISTA ?>icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo URL_VISTA ?>icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_VISTA ?>icons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo URL_VISTA ?>manifest.webmanifest">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo URL_VISTA ?>icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#e91e63">
    <title>Login </title>

    <!-- preloads -->
    <link href="<?php echo URL_VISTA ?>fonts/Lato/stylesheet.css" rel="preload" as="style">
    <link rel="preload" as="style" href="<?php echo URL_VISTA ?>css/mdb.min.css" />
     <link rel="preload" as="style" href="<?php echo URL_VISTA ?>css/all.min.css" />
    <link href="<?php echo URL_VISTA ?>js/mdb.min.js" rel="preload" as="script">
    <link rel="preconnect dns-prefetch" href="https://www.google-analytics.com">
    <link rel="stylesheet" href="<?php echo URL_VISTA ?>css/mdb.min.css" />
    <link href="<?php echo URL_VISTA ?>fonts/Lato/stylesheet.css" rel="stylesheet">
    <script defer type="text/javascript" src="<?php echo URL_VISTA ?>js/mdb.min.js"></script>
    <script defer type="text/javascript" src="<?php echo URL_VISTA ?>js/sweetalert2@11/sweetalert2@11.js"></script>

    <script>
        const host =
    <?= json_encode(URL_VISTA, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
    </script>
    <script>
        const version =
    <?= json_encode(VERSION, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
    </script>
    <script>
        const dominio = <?= json_encode(URL_SERVER, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
    </script>

</head>

<body>
    <!--Main layout-->
    <main>
        <div class="container">
            <div class="row d-flex justify-content-center align-content-center" style="height:100vh">
                <div class="col-xl-6 col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <!-- Pills navs -->
                            <div class="ratio ratio-16x9">
                                <img style="    object-fit: contain;" src="https://nutramerican.com/api_MegaplexStar/assets/images/LOGO3.png" alt="logo">
                            </div>
                            <!-- Pills navs -->

                            <!-- Pills content -->
                            <form method="POST"  >
                                <small id="msgError"></small>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input required type="email" id="username" name="username" class="form-control" />
                                    <label class="form-label" for="username">Email or username</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input required type="password" id="password" name="password" class="form-control" />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <!-- 2 column grid layout -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <!-- Checkbox -->
                                        <div class="form-check mb-3 mb-md-0">
                                            <input name="loginCheck" class="form-check-input" type="checkbox"  id="loginCheck"
                                                checked />
                                            <label class="form-check-label" for="loginCheck">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                                                     <div class="col-md-6 d-flex justify-content-center">
                                                   <!-- Simple link -->
                                        <a href="#!">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="btningresar" class="btn btn-primary btn-block mb-4">
                                    Sign in
                                </button>


                            </form>
                            <!-- Pills content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->


</body>

