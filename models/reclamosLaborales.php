<?php
require_once '../db/conexion.php';

class reclamosLaborales extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert(
        string $val_nombres,
        string $val_Apellidos,
        string $val_cargo,
        string $val_email,
        int $val_celular,
        string $val_situcionLaboral,
        string $val_asunto
    ) {

        try {
            $query  = "INSERT INTO reclamos_laboral (
                reclamoLaboral_nombres,
                reclamoLaboral_apellidos,
                reclamoLaboral_cargo,
                reclamoLaboral_correo,
                reclamoLaboral_telefono,
                reclamoLaboral_situacionLaboral,
                reclamoLaboral_asunto
                ) VALUES (
                :reclamoLaboral_nombres,
                :reclamoLaboral_apellidos,
                :reclamoLaboral_cargo,
                :reclamoLaboral_correo,
                :reclamoLaboral_telefono,
                :reclamoLaboral_situacionLaboral,
                :reclamoLaboral_asunto)";
            $result = $this->db->prepare($query);
            $result->execute(
                array(
                    ':reclamoLaboral_nombres' => $val_nombres,
                    ':reclamoLaboral_apellidos' => $val_Apellidos,
                    ':reclamoLaboral_cargo' => $val_email,
                    ':reclamoLaboral_correo' => $val_email,
                    ':reclamoLaboral_telefono' => $val_celular,
                    ':reclamoLaboral_situacionLaboral' => $val_situcionLaboral,
                    ':reclamoLaboral_asunto' => $val_asunto
                )
            );

            return $this->db->lastInsertId();
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
    public function getLast_row(): array
    {
        $query = "SELECT MAX(id_reclamoLaboral) AS lastRow FROM reclamos_laboral;";
        return $this->ConsultaSimple($query);
    }
}
