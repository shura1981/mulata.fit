<?php
 if (isset($_GET['key']) && $_GET['key']=='123' ) {
    // do something
 $filename="/opt/lampp/htdocs/mulata.fit/public/img/grid/grid1.webp";
  header('Content-Type: ' . mime_content_type( $filename));
  readfile($filename);
   exit;


}else echo 'no tienes acceso a este archivo ' ;

 