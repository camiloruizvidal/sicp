<?php

class modelpersona
{

    public function verpersona($documento)
    {
        $sql  = 'SELECT 
                `tbl_persona`.`id_persona`,
                `tbl_persona`.`id_documento_tipo`,
                `tbl_persona`.`id_tarjeta_familiar`,
                `tbl_persona`.`id_estado_civil`,
                `tbl_persona`.`id_asegurador`,
                `tbl_persona`.`id_nivel_educativo`,
                `tbl_persona`.`nombre1`,
                `tbl_persona`.`nombre2`,
                `tbl_persona`.`apellido1`,
                `tbl_persona`.`apellido2`,
                `tbl_persona`.`documento`,
                `tbl_persona`.`sexo`,
                `tbl_persona`.`fecha_nacimiento`,
                `tbl_persona_familiaridad`.`descripcion` AS `familiaridad`,
                `tbl_persona`.`id_persona_familiaridad`,
                `tbl_tarjeta_familiar`.`codigo`,
                `tbl_persona`.`id_rango`,
                `tbl_persona`.`es_cabeza_familia`,
                COALESCE(`tbl_persona`.`tipo_afiliado`,"-1") as `tipo_afiliado`,                 
                COALESCE(`tbl_persona`.`id_regimen`,"-1") as `id_regimen`
            FROM
                `tbl_persona`
                LEFT OUTER JOIN `tbl_persona_familiaridad` ON (`tbl_persona`.`id_persona_familiaridad` = `tbl_persona_familiaridad`.`id_persona_familiaridad`)
                INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
            WHERE
                `tbl_persona`.`documento`=?';
        $data = model::Record($sql, array($documento));
        return $data;
    }

    public static function Morbilidad($id_tarjeta)
    {
        $sql = 'SELECT 
            `tbl_morbilidad`.`id_morbilidad`,
            CONCAT_WS(\' \',
            `tbl_morbilidad`.`nombres`,
            `tbl_morbilidad`.`apellidos`) as nombre,
            `tbl_morbilidad`.`fecha_nacimientod`,
              `tbl_morbilidad`.`fecha_fallecimiento`,
            `tbl_morbilidad`.`causa`
          FROM
            `tbl_morbilidad`
            WHERE
              `tbl_morbilidad`.`id_tarjeta_familiar`=?';
        $Res = model::Records($sql, array($id_tarjeta));
        return $Res;
    }

    public static function verpersona_id($id_persona)
    {
        $sql  = 'SELECT 
                `tbl_persona`.`id_persona`,
                `tbl_persona`.`id_documento_tipo`,
                `tbl_persona`.`id_tarjeta_familiar`,
                `tbl_persona`.`id_estado_civil`,
                `tbl_persona`.`id_asegurador`,
                `tbl_persona`.`id_nivel_educativo`,
                `tbl_persona`.`nombre1`,
                `tbl_persona`.`nombre2`,
                `tbl_persona`.`apellido1`,
                `tbl_persona`.`apellido2`,
                `tbl_persona`.`documento`,
                `tbl_persona`.`sexo`,
                `tbl_persona`.`fecha_nacimiento`,
                COALESCE(`tbl_persona_familiaridad`.`descripcion`,"NN") AS `familiaridad`,
                `tbl_persona`.`id_persona_familiaridad`,
                `tbl_tarjeta_familiar`.`codigo`,
                `tbl_persona`.`tipo_afiliado`,
                COALESCE(`tbl_persona`.`id_rango`,"NN") as `id_rango`,
                COALESCE(`tbl_persona`.`id_regimen`,"NN") as `id_regimen`
            FROM
                `tbl_persona`
                LEFT OUTER JOIN `tbl_persona_familiaridad` ON (`tbl_persona`.`id_persona_familiaridad` = `tbl_persona_familiaridad`.`id_persona_familiaridad`)
                INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
            WHERE
                `tbl_persona`.`id_persona`=?';
        $data = model::Record($sql, array($id_persona));
        return $data;
    }

    public function SavePersona($data)
    {
        $person = model::Make('tbl_persona');
        if (isset($data['documento']))
        {
            $person->Load('documento=\'' . $data['documento'] . '\'');
        }
        $person->id_documento_tipo       = $data['id_documento_tipo'];
        $person->id_tarjeta_familiar     = $data['id_tarjeta_familiar'];
        $person->id_persona_familiaridad = $data['id_persona_familiaridad'];
        $person->id_estado_civil         = $data['id_estado_civil'];
        $person->id_asegurador           = $data['id_asegurador'];
        $person->id_nivel_educativo      = $data['id_nivel_educativo'];
        $person->nombre1                 = $data['nombre1'];
        $person->nombre2                 = $data['nombre2'];
        $person->apellido1               = $data['apellido1'];
        $person->apellido2               = $data['apellido2'];
        $person->documento               = $data['documento'];
        $person->sexo                    = $data['sexo'];
        $person->id_rango                = $data['id_rango'];
        $person->fecha_nacimiento        = $data['fecha_nacimiento'];
        $person->es_cabeza_familia       = $data['es_cabeza_familia'];
        $person->tipo_afiliado           = $data['tipo_afiliado'];
        $person->ocupacion               = $data['ocupacion'];
        $person->Save();
        return $person->id_persona;
    }

}
