<?php
require_once '../db/conexion.php';

class relacionesComunitarias extends Conexion
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
        string $val_lift,
        int $valArchive
    ) {

        try {
            $query  = "INSERT INTO relaciones_comunitaria (
                relacionesComunitarias_nombre,
                relacionesComunitarias_direccion,
                relacionesComunitarias_correo,
                relacionesComunitarias_celular,
                relacionesComunitarias_organizacion,
                relacionesComunitarias_acompaniante,
                relacionesComunitarias_frasesMencionadas,
                relacionesComunitarias_personasReferidas,
                relacionesComunitarias_sucesoseneltiempo
                ) VALUES (
                :relacionesComunitarias_nombre,
                :relacionesComunitarias_direccion,
                :relacionesComunitarias_correo,
                :relacionesComunitarias_celular,
                :relacionesComunitarias_organizacion,
                :relacionesComunitarias_acompaniante,
                :relacionesComunitarias_frasesMencionadas,
                :relacionesComunitarias_personasReferidas,
                :relacionesComunitarias_sucesoseneltiempo)";
            $result = $this->db->prepare($query);
            $result->execute(
                array(
                    ':relacionesComunitarias_nombre' => $val_acceptedTerms,
                    ':relacionesComunitarias_direccion' => $val_anonymityactCorruption,
                    ':relacionesComunitarias_correo' => $val_namesSurnames,
                    ':relacionesComunitarias_celular' => $val_dni,
                    ':relacionesComunitarias_organizacion' => $val_cellphone,
                    ':relacionesComunitarias_acompaniante' => $val_address,
                    ':relacionesComunitarias_frasesMencionadas' => $val_email,
                    ':relacionesComunitarias_personasReferidas' => $val_typeofcomplaint,
                    ':relacionesComunitarias_sucesoseneltiempo' => $val_lift
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
        $query = "SELECT MAX(id_actoCorrupcion) AS lastRow FROM actos_corrupcion;";
        return $this->ConsultaSimple($query);
    }
}
