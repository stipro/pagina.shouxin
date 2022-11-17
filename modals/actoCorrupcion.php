<?php
//declare (strict_types = 1);
require_once '../db/conexion.php';

class actoCorrupcion extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(string $codigo, int $ingreso, int $egreso, string $registro, string $factura, string $nombre, string $observacion)
    {
       
        try 
        {
            $query  = "INSERT INTO acto_corrupcion VALUES (null,:codigo,:ingreso,:egreso,:fecha,:factura,:nombre,:observacion) ;";
            $result = $this->db->prepare($query);
            $result->execute(array(':codigo' => $codigo,':ingreso' => $ingreso, ':egreso' => $egreso, ':fecha'=> $registro, ':factura' => $factura,':nombre' => $nombre,':observacion' => $observacion));
            echo 'BIEN';
        } catch (PDOException $e) {
            echo 'ERROR';
        }
    }

}
