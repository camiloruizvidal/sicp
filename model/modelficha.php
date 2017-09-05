<?php

class modelficha
{
    #IMPORTAR
    #IMPORTAR
    #EXPORTAR

    public static function generate_data_registro_ficha($id_ficha)
    {
        $sql  = 'SELECT 
                    `tbl_car_registro`.`value`
                  FROM
                    `tbl_car_registro`
                  WHERE
                    `tbl_car_registro`.`id_tarjeta_familiar` = ?';
        $Data = model::Record($sql, array($id_ficha));
        return $Data;
    }

    public static function generate_data_registro_person($id_persona)
    {
        $sql  = 'SELECT 
                    `tbl_car_registro`.`value`
                  FROM
                    `tbl_car_registro`
                    WHERE
                      `tbl_car_registro`.`id_persona`=?';
        $Data = model::Record($sql, array($id_persona));
        return $Data;
    }

    public static function generate_data_person($id_tarjeta_familiar)
    {
        $sql  = 'SELECT 
                    `tbl_persona`.`id_persona`,
                    `tbl_persona`.`id_documento_tipo`,
                    `tbl_persona`.`documento`,
                    `tbl_persona`.`nombre1`,
                    `tbl_persona`.`nombre2`,
                    `tbl_persona`.`apellido1`,
                    `tbl_persona`.`apellido2`,
                    `tbl_persona`.`id_tarjeta_familiar`,
                    `tbl_persona`.`id_estado_civil`,
                    `tbl_persona`.`id_nivel_educativo`,
                    `tbl_persona`.`sexo`,
                    `tbl_persona`.`fecha_nacimiento`,
                    `tbl_persona`.`id_persona_familiaridad`,
                    `tbl_persona`.`tipo_afiliado`,
                    `tbl_persona`.`id_asegurador`,
                    `tbl_persona`.`id_rango`,
                    `tbl_persona`.`id_regimen`,
                    `tbl_persona`.`es_cabeza_familia`
                  FROM
                    `tbl_persona`
                WHERE
                  `tbl_persona`.`id_tarjeta_familiar`=?';
        $Data = model::Records($sql, array($id_tarjeta_familiar));
        return $Data;
    }

    public static function generate_data_ficha()
    {
        $sql  = 'SELECT 
                    `tbl_tarjeta_familiar`.`id_tarjeta_familiar`,
                    `tbl_tarjeta_familiar`.`fecha_apertura`,
                    `tbl_tarjeta_familiar`.`codigo`,
                    `tbl_tarjeta_familiar`.`sisben_ficha`,
                    `tbl_tarjeta_familiar`.`sisben_puntaje`,
                    `tbl_tarjeta_familiar`.`sisben_nivel`,
                    `tbl_tarjeta_familiar`.`direccion`,
                    `tbl_tarjeta_familiar`.`id_zona`,
                    `tbl_tarjeta_familiar`.`telefono`,
                    `tbl_tarjeta_familiar`.`id_municipio`,
                    `tbl_tarjeta_familiar`.`id_corregimiento`,
                    `tbl_tarjeta_familiar`.`id_vereda`,
                    `tbl_tarjeta_familiar`.`portabilidad`,
                    `tbl_tarjeta_familiar`.`cambio_domicilio`,
                    `tbl_tarjeta_familiar`.`proxima_visita`,
                    `tbl_tarjeta_familiar`.`responsable`,
                    `tbl_tarjeta_familiar`.`documento_responsable`
                FROM
                  `tbl_tarjeta_familiar`';
        $Data = model::Records($sql);
        return $Data;
    }

    #EXPORTAR

    public function savemortalidad($nombres, $apellidos, $fecha_nacimientod, $fecha_fallecimiento, $causa, $id_tarjeta)
    {
        $mortalidad                      = model::Make('tbl_morbilidad');
        $mortalidad->nombres             = $nombres;
        $mortalidad->apellidos           = $apellidos;
        $mortalidad->fecha_nacimientod   = $fecha_nacimientod;
        $mortalidad->causa               = $causa;
        $mortalidad->fecha_fallecimiento = $fecha_fallecimiento;
        $mortalidad->id_tarjeta_familiar = $id_tarjeta;
        $mortalidad->Save();
        return $mortalidad->id_morbilidad;
    }

    public function tarjeta_familiar($codigo)
    {
        $TF   = model::Make('tbl_tarjeta_familiar');
        $TF->Load('codigo=?', $codigo);
        $data = null;
        if (!is_null($TF->id_tarjeta_familiar))
        {
            $data = array(
                'fecha_apertura'      => $TF->fecha_apertura,
                'codigo'              => $TF->codigo,
                'sisben_ficha'        => $TF->sisben_ficha,
                'sisben_puntaje'      => $TF->sisben_puntaje,
                'sisben_nivel'        => $TF->sisben_nivel,
                'direccion'           => $TF->direccion,
                'id_zona'             => $TF->id_zona,
                'telefono'            => $TF->telefono,
                'proxima_visita'      => $TF->proxima_visita,
                'id_tarjeta_familiar' => $TF->id_tarjeta_familiar);
        }
        return $data;
    }

    public function savetarjetafamiliar($data)
    {

        $TF = model::Make('tbl_tarjeta_familiar');
        $TF->Load('codigo=?', $data['codigo']);
        if (is_null($TF->id_tarjeta_familiar))
        {
            $TF->fecha_apertura        = date('Y-m-d H:i:s A');
            $TF->codigo                = $data['codigo'];
            $TF->sisben_ficha          = $data['sisben_ficha'];
            $TF->sisben_puntaje        = $data['sisben_puntaje'];
            $TF->sisben_nivel          = $data['sisben_nivel'];
            $TF->direccion             = $data['direccion'];
            $TF->id_zona               = $data['id_zona'];
            $TF->telefono              = $data['telefono'];
            $TF->id_municipio          = $data['id_municipio'];
            $TF->id_corregimiento      = (isset($data['id_corregimiento'])) ? $data['id_corregimiento'] : null;
            $TF->id_vereda             = (isset($data['id_vereda'])) ? $data['id_vereda'] : null;
            $TF->portabilidad          = $data['portabilidad'];
            $TF->cambio_domicilio      = $data['cambio_domicilio'];
            $TF->proxima_visita        = $data['proxima_visita'];
            $TF->responsable           = $data['responsable'];
            $TF->documento_responsable = $data['documento_responsable'];
            $TF->Save();
        }
        return $TF->id_tarjeta_familiar;
    }

    private function new_cod($codigo_sig)
    {
        $cod = model::Make('tbl_codigos');
        $cod->Load('codigo_inicio>? and activo=?', array($codigo_sig, 'si'));
        if (is_null($cod->codigo_inicio))
        {
            return null;
        }
        else
        {
            return $cod->codigo_inicio;
        }
    }

    public function codigonextvalue($id_usuario)
    {
        @session_start();
        $cod = model::Make('tbl_codigos');
        $cod->Load('id_usuario=? and activo=? AND codigo_next_value=?', array($id_usuario, 'si', $_SESSION['codigo_next_value']));
        if (!is_null($cod->id_codigos))
        {
            if ($cod->codigo_next_value + 1 <= $cod->codigo_fin)
            {
                $cod->codigo_next_value = ($cod->codigo_next_value + 1);
                $cod->Save();
                $cod->Load('id_codigos=?', $cod->id_codigos);
            }
            else
            {
                $cod->activo = 'no';
                $cod->Save();
                return $this->new_cod($cod->codigo_next_value + 1);
            }
        }
        return $cod->codigo_next_value;
    }

}
