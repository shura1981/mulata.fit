<?php
class Connection
{
    static function getConn()
    {
      return $_SERVER['DOCUMENT_ROOT'] . '/connection/connection.php';
 
    }
}