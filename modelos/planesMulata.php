<?php
require_once 'connection.php';
class Tb_planes_mulata extends Connection
{
    function __construct(string $fechaI, string $fechaF, array $comprobantes, int $celular)
    {
        $this->fechaI = $fechaI;
        $this->fechaF = $fechaF;
        $this->comprobantes = $comprobantes;
        $this->celular = $celular;
    }
    public static function getPlanes($link)
    {
        try {
            require parent::getConn();
            $query = "SELECT nombre, dias, valor, moneda FROM tb_planes_mulata WHERE link='$link'";
            $select = $mysqli->query($query);
            $row = $select->fetch_assoc();
            return json_encode($row, JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            throw new Exception('Ocurrió un error: ' . $e->getMessage());
        } finally {
            $select->free();
            $mysqli->close();
        }

    }
    public static function Pay(Tb_planes_mulata $plan = null)
    {
        try {
            require parent::getConn();
            $json = json_encode($plan->comprobantes, JSON_UNESCAPED_UNICODE);
            $query = "INSERT INTO tb_pagos_planes_mulata SET fechaI='$plan->fechaI' ,fechaF='$plan->fechaF' ,comprobantes='$json' ,celular= '$plan->celular'";
            $insert = $mysqli->query($query);
            if ($insert) $result = array("status" => true, "insert_id" => $mysqli->insert_id, "msg" => "Insertado con éxito");
            else $result = array("status" => false, "insert_id" => 0, "msg" => "No se insertó");
            return $result;
        } catch (Exception $e) {
            throw new Exception('Ocurrió un error: ' . $e->getMessage());
        } finally {
            $mysqli->close();
        }
    }
}