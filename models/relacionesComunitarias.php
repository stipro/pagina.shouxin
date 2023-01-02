<?php
require_once '../db/conexion.php';

class relacionesComunitarias extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert(
        string $val_namesSurnames,
        string $val_direction,
        string $val_mail,
        int $val_mobile,
        string $val_organization,
        string $val_escort,
        string $val_phrasesMentioned,
        string $val_referredPeople,
        string $val_eventsInTime
    ) {

        try {
            $query  = "INSERT INTO relaciones_comunitarias (
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
                    ':relacionesComunitarias_nombre' => $val_namesSurnames,
                    ':relacionesComunitarias_direccion' => $val_direction,
                    ':relacionesComunitarias_correo' => $val_mail,
                    ':relacionesComunitarias_celular' => $val_mobile,
                    ':relacionesComunitarias_organizacion' => $val_organization,
                    ':relacionesComunitarias_acompaniante' => $val_escort,
                    ':relacionesComunitarias_frasesMencionadas' => $val_phrasesMentioned,
                    ':relacionesComunitarias_personasReferidas' => $val_referredPeople,
                    ':relacionesComunitarias_sucesoseneltiempo' => $val_eventsInTime
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
        $query = "SELECT MAX(id_relacionesComunitarias) AS lastRow FROM relaciones_comunitarias;";
        return $this->ConsultaSimple($query);
    }
}
