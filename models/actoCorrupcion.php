<?php
require_once '../db/conexion.php';

class actosCorrupcion extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert(
        string $val_acceptedTerms,
        string $val_anonymityactCorruption,
        string $val_namesSurnames,
        int $val_dni,
        int $val_cellphone,
        string $val_address,
        string $val_email,
        string $val_typeofcomplaint,
        string $val_lift
    ) {

        try {
            $query  = "INSERT INTO acto_corrupcion (
                autorizacionUsoDatos_actoCorrupcion,
                denunciaAnonima_actoCorrupcion,
                nombres_actoCorrupcion,
                dni_actoCorrupcion,
                telefono_actoCorrupcion,
                direccion_actoCorrupcion,
                correo_actoCorrupcion,
                tipoDenuncia_actoCorrupcion,
                sustento_actoCorrupcion
                ) VALUES (
                :autorizacionUsoDatos_actoCorrupcion,
                :denunciaAnonima_actoCorrupcion,
                :nombres_actoCorrupcion,
                :dni_actoCorrupcion,
                :telefono_actoCorrupcion,
                :direccion_actoCorrupcion,
                :correo_actoCorrupcion,
                :tipoDenuncia_actoCorrupcion,
                :sustento_actoCorrupcion)";
            $result = $this->db->prepare($query);
            $result->execute(
                array(
                    ':autorizacionUsoDatos_actoCorrupcion' => $val_acceptedTerms,
                    ':denunciaAnonima_actoCorrupcion' => $val_anonymityactCorruption,
                    ':nombres_actoCorrupcion' => $val_namesSurnames,
                    ':dni_actoCorrupcion' => $val_dni,
                    ':telefono_actoCorrupcion' => $val_cellphone,
                    ':direccion_actoCorrupcion' => $val_address,
                    ':correo_actoCorrupcion' => $val_email,
                    ':tipoDenuncia_actoCorrupcion' => $val_typeofcomplaint,
                    ':sustento_actoCorrupcion' => $val_lift
                )
            );
            echo 'BIEN';
        } catch (PDOException $e) {
            var_dump($e->getCode());
            if ($e->getCode() == 42000) {
                echo "La sintaxis esta mal";
            } elseif ($e->getCode() == '21S01') {
                echo "Los parametros no coinciden";
            } elseif ($e->getCode() == 'HY000') {
                echo "Tipo de valor incorrecto";
            }
        }
    }
    public function delete(int $id)
    {
        error_reporting(0);
        try {
            $query  = "DELETE FROM talmacen WHERE nIdAlm=:id;";
            $result = $this->db->prepare($query);
            $result->execute(array(':id' => $id));
            echo 'BIEN';
        } catch (PDOException $e) {
            echo 'ERROR';
        }
    }
}
