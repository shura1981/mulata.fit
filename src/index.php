<!DOCTYPE html>
<html lang="es-ES">
<head>
<?php
$url= $_SERVER["REQUEST_URI"];
$url= explode("/", $url);
$ruta= $url[(count($url)-2)];
?>
<?php require '../../api_MegaplexStar/connection_mysql/connection_intranet.php';
$select=$mysqlElite->query("SELECT codigo, orden, producto, valor, thumbnails, image,ruta,uso, descuento,agotado, promo, category, invima, intro, video, imgtabla, imgcard, memoficha, arte, title,datanutritional, description, ingredientes, presentation FROM tb_productos_megaplexstars WHERE ruta='$ruta'");
$data=$select->fetch_assoc();
$select=$mysqlElite->query("SELECT * FROM tb_seo_megaplex WHERE ruta='$ruta'");
$meta=$select->fetch_assoc();
?>
<meta charset="UTF-8" />
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<!-- COMMON TAGS -->
<meta name="robots" content="follow"/>
<title><?php echo $data['producto'];?></title>
<meta name="keywords" content="<?php echo $meta['keywords'];?>"/>
<!-- Search Engine -->
<meta name="description" content="<?php echo $meta['description'];?>">
<meta name="image" content="<?php echo $meta['image'];?>">
<!-- Schema.org for Google -->
<meta itemprop="name" content="<?php echo $meta['title'];?>">
<meta itemprop="description" content="<?php echo $meta['description'];?>">
<meta itemprop="image" content="<?php echo $meta['image'];?>">
<!-- Open Graph general (Facebook, Pinterest & LinkedIn) -->
<meta name="og:title" content="<?php echo $meta['title'];?>">
<meta name="og:description" content="<?php echo $meta['description'];?>">
<meta name="og:image" content="<?php echo $meta['image'];?>">
<meta name="og:url" content="https://www.megaplexstars.com">
<meta name="og:site_name" content="Megaplex Stars">
<meta name="og:locale" content="es-ES">
<meta name="og:type" content="website">
<!-- Twitter -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php echo $meta['title'];?>">
<meta name="twitter:description" content="<?php echo $meta['description'];?>">
<meta name="twitter:image:src" content="<?php echo $meta['image'];?>">

<!-- (Facebook)  -->
<meta property="og:site_name" content="Megaplex Stars">
<meta property="og:url" content="https://www.megaplexstars.com/producto/<?php echo $meta['ruta'];?>/">  
<meta property="og:type" content="website"> 
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $meta['title'];?>">
<meta property="og:description" content="<?php echo $meta['description'];?>">
<meta property="og:image" content="<?php echo $meta['image'];?>">
<meta property="fb:app_id" content="305025260819916">

<!-- Favicon -->
<link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>
<!-- Main css file -->
<link rel="stylesheet" href="../css/index.min.css" />
<!-- Custom styles -->
<style>
a {
color: #262626;
}
.post_link a:hover:visited {
color: #0481ff!important;
text-decoration: underline;
}
ol, ul {
padding-left: 0rem;
}
.post_link a:hover:link {
color: #0481ff!important;
text-decoration: underline;
}
</style>
</head>
<body>
<!--Main Navigation-->
<header>
<!-- Jumbotron -->
<div class="p-3 text-center bg-white border-bottom">
<div class="container">
<div class="row">
<div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
<a href="https://www.megaplexstars.com/" class="ms-md-2">
<img src="https://megaplexstars.com/api_MegaplexStar/assets/images/LOGO3.png" height="35" />
</a>
</div>

<div class="col-md-4">
<form class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
<input autocomplete="off" type="search" class="form-control rounded" placeholder="Buscar" />
<span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
</form>
</div>

<div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
<div class="d-flex">
<!-- Cart -->
<a class="text-reset me-3" href="#" id="gotoCart">
<span><i class="fas fa-shopping-cart"></i></span>
<span id="counterCart" class="badge rounded-pill badge-notification bg-danger">0</span>
</a>

<!-- User -->
<div class="dropdown">
<a class="text-reset dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
<img id="img-user" src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
alt="" loading="lazy" />
</a>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
<li><a class="dropdown-item" href="https://megaplexstars.com/pages/profile">Mi cuenta</a></li>
<li><a class="dropdown-item" href="https://megaplexstars.com/">Salir</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Jumbotron -->

<!-- Jumbotron -->
<div class="p-4 text-center bg-light">
<!-- Breadcrumb -->
<nav class="d-flex justify-content-center">
<h6 class="mb-0">
<a href="https://www.megaplexstars.com" class="text-reset">Inicio</a>
<span>/</span>
<a href="https://www.megaplexstars.com/productos" class="text-reset">Productos</a>
<span>/</span>
<a  class="text-reset"><?php echo $data['producto'];?></a>
</h6>
</nav>
<!-- Breadcrumb -->
</div>
<!-- Jumbotron -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="my-5">
<div class="container">
<!--Section: Product intro-->
<section>
<div class="row">
<div class="col-md-6 mb-4">
<!--Section: Gallery-->
<section>
<div class="ecommerce-gallery" data-zoom-effect="true">
<div class="row justify-content-center">
<div class="col-12 mb-1">
<div class="lightbox">
<img src="<?php echo $data['image'];?>"
alt="<?php echo $data['producto'];?>" class="ecommerce-gallery-main-img active w-100" />
</div>
</div>
<div class="col-3">
<img src="<?php echo $data['image'];?>"
data-mdb-img="<?php echo $data['image'];?>"
alt="imagen <?php echo $data['producto'];?> " class="active img-fluid" />
</div>
<div class="col-3">
<img src="<?php echo $data['imgtabla'];?>"
data-mdb-img="<?php echo $data['imgtabla'];?>"
alt="tabla nutricional <?php echo $data['producto'];?>" class="img-fluid" />
</div>
<div class="col-3">
<img src="<?php echo $data['arte'];?>"
data-mdb-img="<?php echo $data['arte'];?>"
alt="ingredientes <?php echo $data['producto'];?> 3" class="img-fluid" />
</div>
</div>
</div>
</section>
<!--Section: Gallery-->
</div>

<div class="col-md-6 mb-4">
<!--Section: Basic info-->
<section>
<!-- Basic data -->
<?php echo "<h1 class='h4 mb-3'>". $data["title"]. "</h1> ";?>

<!-- <h5 class="mb-3">
<span class="badge bg-primary me-2">New</span><span class="badge bg-success me-2">Eco</span><span
class="badge bg-danger me-2">-10%</span>
</h5> -->
<p class="mb-3"><a href="" class="text-reset"> <?php echo $data['category'];?>  </a></p>

<ul class="rating mb-4" data-mdb-toggle="rating" data-mdb-readonly="true" data-mdb-value="4">
<li>
<i class="far fa-star fa-sm text-primary ps-0"></i>
</li>
<li>
<i class="far fa-star fa-sm text-primary"></i>
</li>
<li>
<i class="far fa-star fa-sm text-primary"></i>
</li>
<li>
<i class="far fa-star fa-sm text-primary"></i>
</li>
<li>
<i class="far fa-star fa-sm text-primary"></i>
</li>
</ul>
<h6 class="mb-3">
<s class="d-none" id="priceDefaultDes">$61.99</s><strong class="ms-2 text-danger d-none" id="priceDescount">$50.99</strong>
<strong id="priceDefault" class="ms-2"><?php setlocale(LC_MONETARY, 'en_US.UTF-8');echo money_format('%.2n', $data['valor']);?> </strong>
</h6>
<div class="mb-3">
<?php
echo $data['description'];
?>
</div>



<!-- Details table -->
<table class="table table-sm table-borderless mb-0">
<tbody>
<tr>
<th class="ps-0 w-25" scope="row">
<strong>Presentación</strong>
</th>
<td> <?php echo $data['presentation'];?> </td>
</tr>
<tr>
<th class="ps-0 w-25" scope="row">
<strong>Registro Invima</strong>
</th>
<td><?php echo $data['invima'];?></td>
</tr>
</tbody>
</table>
<!-- Details table -->

<hr />
<img src="https://megaplexstars.com/assets/img/epayco_payment_methods.png"  class="img-fluid my-4">
<!-- Quantity -->
<div class="d-flex mb-4 quality"   >
<button class="btn btn-primary px-3 me-2"
onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
<i class="fas fa-minus"></i>
</button>

<div class="form-outline">
<input id="contador" min="0" name="quantity" value="1" type="number" class="form-control" />
<label class="form-label" for="contador">Cantidad</label>
</div>

<button class="btn btn-primary px-3 ms-2"
onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
<i class="fas fa-plus"></i>
</button>
</div>
<!-- Quantity -->

<div class="section-btn">
<!-- CTA -->
<button id="buynow" type="button" class="btn btn-primary me-2 mb-2">
Comprar ahora
</button>
<button id="add" type="button" class="btn btn-danger mb-2">
<i class="fas fa-shopping-cart me-2"></i>Añadir
</button>
<!-- CTA -->
</div>


</section>
<!--Section: Basic info-->
</div>
</div>
</section>
<!--Section: Product intro-->

<!--Section: Product details-->
<section>
<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
<li class="nav-item" role="presentation">
<a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="pill" href="#ex3-pills-1" role="tab"
aria-controls="ex3-pills-1" aria-selected="true">Ingredientes</a>
</li>
<li class="nav-item" role="presentation">
<a class="nav-link" id="ex3-tab-2" data-mdb-toggle="pill" href="#ex3-pills-2" role="tab"
aria-controls="ex3-pills-2" aria-selected="false">¿Cómo consumirlo?</a>
</li>
<li class="nav-item" role="presentation">
<a class="nav-link" id="ex3-tab-3" data-mdb-toggle="pill" href="#ex3-pills-3" role="tab"
aria-controls="ex3-pills-3" aria-selected="false">Datos nutricionales</a>
</li>
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content" id="ex2-content">
<div class="tab-pane fade show active" id="ex3-pills-1" role="tabpanel" aria-labelledby="ex3-tab-1">
<h2 class="h4 mb-3">Principales Ingredientes</h2>
<?php echo $data['ingredientes'];?>
</div>
<div class="tab-pane fade" id="ex3-pills-2" role="tabpanel" aria-labelledby="ex3-tab-2">
<?php echo $data['uso'];?>
</div>
<div class="tab-pane fade" id="ex3-pills-3" role="tabpanel" aria-labelledby="ex3-tab-3">
<!-- Reviews -->
<?php echo $data['datanutritional'];?>
</div>
<!-- Pills content -->
</section>
<!--Section: Product details-->
</div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="bg-light text-center text-lg-start">
<!-- Grid container -->
<div class="container p-4">
<div class="row">
<div class="col-md-6 mb-4 mb-md-0 d-flex justify-content-center justify-content-md-start align-items-center">
<strong>Conectate con nostros en nuestras redes sociales</strong>
</div>

<div class="col-md-6 d-flex justify-content-center justify-content-md-end">
<!-- Facebook -->
<a class="btn btn-primary btn-sm btn-floating me-2" style="background-color: #3b5998" href="https://www.facebook.com/megaplexstars/"
role="button"><i class="fab fa-facebook-f"></i></a>
<a class="btn btn-primary btn-sm btn-floating me-2" style="background-color: #ed302f" href="https://www.youtube.com/channel/UCxOpQjNEaa2AiYtpC0mBHLQ"
role="button"><i class="fab fa-youtube"></i></a>
<!-- Instagram -->
<a class="btn btn-primary btn-sm btn-floating me-2" style="background-color: #ac2bac" href="https://www.instagram.com/megaplexstars/"
role="button"><i class="fab fa-instagram"></i></a>
</div>
</div>

<hr class="my-3" />

<!--Grid row-->
<div class="row">
<!--Grid column-->
<div class="col-lg-4 mb-4 mb-lg-0">
<p><strong>Sobre nosotros</strong></p>

<p>
Somos la empresa lider país en el mercado de la suplementación deportiva y nutricional, contamos con el laboratorio más avanzado en el maquilado de suplementos alimenticios.
</p>
</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-3 mb-4 mb-lg-0">
<p><strong>Enlaces útiles</strong></p>

<ul class="list-unstyled mb-0">
<li>
<a href="https://www.sorteo.megaplexstars.com/privacidad/" class="text-dark">Política de privacidad de datos</a>
</li>
<li>
<a href="https://www.sorteo.megaplexstars.com/terminos/" class="text-dark">Términos y condiciones</a>
</li>
<li>
<a href="#!" class="text-dark">Portafolio</a>
</li>
</ul>
</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-3 mb-4 mb-lg-0">
<p><strong>Categorías</strong></p>

<ul class="list-unstyled">
<li>
<a href="https://www.megaplexstars.com/productos?option=2" class="text-dark">Módulos proteícos</a>
</li>
<li>
<a href="https://www.megaplexstars.com/productos?option=3" class="text-dark">Energía y recuperación</a>
</li>
<li>
<a href="https://www.megaplexstars.com/productos?option=4" class="text-dark">Hipercalóricos</a>
</li>
<li>
<a href="https://www.megaplexstars.com/productos?option=1" class="text-dark">Control de peso</a>
</li>
</ul>
</div>
<!--Grid column-->

<!--Grid column-->
<div class="col-lg-2 mb-4 mb-lg-0">
<p><strong>Contacto</strong></p>

<ul class="list-unstyled">
<li>
<a  class="text-dark"> Cl. 15 #22 207 Yumbo - Bodega C-11, Terminal logístico</a>
</li>
<li>
<a href="#!" class="text-dark">Correo</a>
</li>
<li>
<a href="#!" class="text-dark">301 3422308</a>
</li>
</ul>
</div>
<!--Grid column-->
</div>
<!--Grid row-->
</div>
<!-- Grid container -->

<!-- Copyright -->
<div class="text-center p-3 text-white " style="background-color:#1266f1">
© 2020 Copyright:
<a class="text-white" href="https://megaplexstars.com/">megaplexstars.com</a>
</div>
<!-- Copyright -->
</footer>
<!--Footer-->

<!-- Toasts -->
<div
class="toast fade"
id="basic-primary-example"
role="alert"
aria-live="assertive"
aria-atomic="true"
data-mdb-autohide="true"
data-mdb-delay="2000"
data-mdb-position="top-right"
data-mdb-append-to-body="true"
data-mdb-stacking="true"
data-mdb-width="auto"
data-mdb-color="primary"
>
<div class="toast-header text-white">
<strong class="me-auto">Producto añadido  </strong>
<button type="button" class="btn-close btn-close-white" data-mdb-dismiss="toast" aria-label="Close"></button>
</div>
<div class="toast-body text-white"><?php echo $data['producto'];?></div>
</div>


</body>
<!-- Main js file -->
<script type="text/javascript" src="../js/index.min.js"></script>
<!-- Custom scripts -->

<script>
var carrito=[];
let total=0, cantidad=0;
function formatCurrency (locales, currency, fractionDigits, number) {
var formatted = new Intl.NumberFormat(locales, {
style: 'currency',
currency: currency,
minimumFractionDigits: fractionDigits
}).format(number);
return formatted;
}
const getValue=()=>{
return producto.valor-((producto.valor*producto.descuento)/100);
}    
const groupByMap =(list, keyGetter)=> {
const map = new Map();
list.forEach((item) => {
const key = keyGetter(item);
const collection = map.get(key);
if (!collection) {
map.set(key, [item]);
} else {
collection.push(item);
}
});
return Array.from(map);
}
const addCart =(item)=>{
carrito.push(item);
const result=groupByMap(carrito, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
const save= btoa(JSON.stringify(carrito))
localStorage.setItem("carrito",save);
const spanCounter= document.getElementById("counterCart");
spanCounter.textContent= carrito.length;
showInfo();
}

const showInfo=()=>{
let basicInstance = mdb.Toast.getInstance(document.getElementById("basic-primary-example"));
basicInstance.show();
}
</script>
<script type="text/javascript">
const cartMegaplex= localStorage.getItem("carrito");
if(cartMegaplex){
carrito= JSON.parse(atob(cartMegaplex));
const spanCounter= document.getElementById("counterCart");
spanCounter.textContent= carrito.length;
// console.log("carrito", carrito);
}
const userMegaplex=  localStorage.getItem("usermegaplex");
const img=document.getElementById("img-user");
if(userMegaplex){
user=JSON.parse(atob(userMegaplex));    
const photo= user.foto ? user.foto: "https://www.megaplexstars.com/assets/icons/maskable_icon.png";
img.setAttribute("src",user.foto);    
}else img.classList.add("d-none");
var producto = <?= json_encode($data,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
if(producto.descuento>0){
const priceDefault=  document.getElementById("priceDefault");
priceDefault.classList.add("d-none");
const priceDefaultDes=  document.getElementById("priceDefaultDes");
priceDefaultDes.classList.remove("d-none");
const priceDescount=  document.getElementById("priceDescount");
priceDescount.classList.remove("d-none");
priceDefaultDes.textContent= formatCurrency("es-CO", "COP", 2, producto.valor);
priceDescount.textContent= formatCurrency("es-CO", "COP", 2, getValue());
// console.log("tiene descuento");
}else console.log("no tiene descuento");
</script>
<script type="text/javascript">
document.getElementById("add").addEventListener("click",(e)=>{
const contador= document.getElementById("contador").value;
for (let index = 0; index < contador; index++) {
addCart({producto: {producto:producto.producto, img:this.producto.thumbnails, valor:producto.valor, descuento:this.producto.descuento}, cantidad:1,valor:getValue() });
}
});
document.getElementById("buynow").addEventListener("click",(e)=>{
const contador= document.getElementById("contador").value;
for (let index = 0; index < contador; index++) {
addCart({producto: {producto:producto.producto, img:this.producto.thumbnails, valor:producto.valor, descuento:this.producto.descuento}, cantidad:1,valor:getValue() });
}
location.href = "https://www.megaplexstars.com/?state=active";
});

document.getElementById("gotoCart").addEventListener("click",(e)=>{
    if(carrito.length>0)  location.href = "https://www.megaplexstars.com/?state=active";
});

</script>


<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1608358779475240');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1608358779475240&ev=PageView&noscript=1"
/></noscript>




<?php
echo '<script type="application/ld+json">

{
"@context": "http://schema.org/",
"@type": "Product",
"name": "'.$data['producto'].'",
"image": ["'.$data["image"].'","'.$data["imgtabla"].'","'.$data["arte"].'"],
"description": "'.$meta["description"].'",
"brand": "megaplex",
"offers": {
"@type": "Offer",
"url": "https://www.megaplexstars.com/producto/'. $meta['ruta'].'",
"priceCurrency": "COP",
"price": "'.$data['valor'].'",
"priceValidUntil": "2025-01-01",
"availability": "https://schema.org/InStock"
}

}

</script>';

?>
</html>







<?php

// try{
// require 'server/connection/connection.php';

// $select= $mysqli->query("SELECT * FROM tb_visitas WHERE id_vendedor=116 AND fecha BETWEEN '2020-12-01' AND '2020-12-31' LIMIT 10");
// var_dump($select->fetch_assoc());
// $filas= $select->num_rows;
// echo "<p> $filas</p>";

// while($row = $select->fetch_assoc())
// {
// echo "<p> cliente". $row["cliente"]."</p>";    
// }
// $rows=$select->fetch_assoc();
// echo "<p> cliente". $rows["cliente"]."</p>";  
// echo "<p> cliente".  $mysqli->affected_rows."</p>";  
// var_dump( $mysqli);

// }
// catch(Exception $e){
// echo $e->getMessage();
// }
// finally{
// echo 'finaliza';
// $select->free_result();
// $mysqli->close();
// }




// ?>
<!-- 
<div class="row">
<div class="col-12">
<div class="embed-responsive embed-responsive-16by9" >
<video  class="video-intro embed-responsive-item" poster="https://www.nutramerican.com/assets/img/postermass.jpeg" playsinline  loop></video>
</div>
</div>
</div> -->


<!-- <div id="vd">
<video autoplay muted loop id="myVideo">
  <source src="https://retoburnerstack.megaplexstars.com/landingpage/video/burnerTatiana.mp4" type="video/mp4">
</video>  
</div> -->

