<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo URL_VISTA?>icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo URL_VISTA?>icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL_VISTA?>icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL_VISTA?>icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL_VISTA?>icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo URL_VISTA?>icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo URL_VISTA?>icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo URL_VISTA?>icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL_VISTA?>icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo URL_VISTA?>icons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL_VISTA?>icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo URL_VISTA?>icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_VISTA?>icons/favicon-16x16.png">
<link rel="manifest" href="<?php echo URL_VISTA?>manifest.webmanifest">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo URL_VISTA?>icons/ms-icon-144x144.png">
<meta name="theme-color" content="#e91e63">
<!-- preloads -->
<!-- <link rel="preload" href="/img/logonutramerican-svg.webp" as="image">
<link rel="preload" href="/img/bipro_megaplex2.webp" as="image">
<link rel="preload" media="(max-width: 600px)" href="/video/loadtatianaburner.webp" as="image">
<link rel="preload" media="(max-width: 600px)" href="/video/tatianaburner.mp4" as="video">
<link rel="preload" media="(min-width: 601px)" href="/video/posterdesafio.webp" as="image">
<link rel="preload" media="(min-width: 601px)" href="/video/desafio3.mp4" as="video"> -->
<link href="<?php echo URL_VISTA?>fonts/Lato/stylesheet.css" rel="preload" as="style">
<link rel="preload" as="style" href="<?php echo URL_VISTA?>css/mdb.min.css" />
<link rel="preload" as="style" href="<?php echo URL_VISTA?>css/swiper-bundle.min.css" />
<link rel="preload" as="style" href="<?php echo URL_VISTA?>css/all.min.css" />
<link href="<?php echo URL_VISTA?>js/mdb.min.js" rel="preload" as="script">
<link rel="preload" as="style" href="<?php echo URL_VISTA?>css/menu.css?v=<?php echo VERSION?>" />
<link rel="preconnect dns-prefetch" href="https://www.google-analytics.com">
<!-- end preloads -->

<link href="<?php echo URL_VISTA?>fonts/Lato/stylesheet.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL_VISTA?>css/root.css?v=<?php echo VERSION?>" />
<link rel="stylesheet" href="<?php echo URL_VISTA?>css/swiper-bundle.min.css" />
<link rel="stylesheet" href="<?php echo URL_VISTA?>css/mdb.min.css" />
<link rel="stylesheet" href="<?php echo URL_VISTA?>css/all.min.css" />
<link rel="stylesheet" href="<?php echo URL_VISTA?>css/menu.css?v=<?php echo VERSION?>" />
<link rel="stylesheet" href="<?php echo URL_VISTA?>ecommerceNutra/carrito/index.css?v=<?php echo VERSION?>" />
<!-- <script defer type="text/javascript" src="<?php echo URL_VISTA?>js/gsap/gsap.min.js"></script> -->
<script defer type="text/javascript" src="<?php echo URL_VISTA?>js/swiper-bundle.min.js"></script>
<script defer type="text/javascript" src="<?php echo URL_VISTA?>js/mdb.min.js"></script>
<script defer type="text/javascript" src="<?php echo URL_VISTA?>js/revelar.js"></script>
<script defer type="text/javascript" src="<?php echo URL_VISTA?>js/sweetalert2@11/sweetalert2@11.js"></script>
<script>
const host =
    <?= json_encode(URL_VISTA,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
</script>
<script>
const version =
    <?= json_encode(VERSION,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
</script>
<script>
const dominio = <?= json_encode(URL_SERVER,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
</script>
<script defer type="text/javascript" src="<?php echo URL_VISTA?>js/menu.js?v=<?php echo VERSION?>"></script>
<script>
// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
// MIT license
(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||
            window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() {
                    callback(currTime + timeToCall);
                },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());
</script>
<!-- smooth scroll behavior polyfill -->
<script defer src="<?php echo URL_VISTA?>js/smoothscroll.js"></script>
<script defer type="text/javascript" src="<?php echo URL_VISTA?>ecommerceNutra/carrito/index.js?v=<?php echo VERSION?>">
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9DG64H7P7P"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-9DG64H7P7P');
</script>