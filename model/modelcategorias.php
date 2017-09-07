<?php

class modelcategorias
{

    public function Savemortalidad($data, $id_tarjeta_familiar)
    {
        $Reg                      = model::Make('tbl_morbilidad');
        $Reg->Load('nombres=? '
                . 'AND apellidos=? '
                . 'AND fecha_nacimientod=? '
                . 'AND causa=? '
                . 'AND fecha_fallecimiento=?', array(
            $data['nombres'],
            $data['apellidos'],
            $data['fecha_nacimientod'],
            $data['causa'],
            $data['fecha_fallecimiento']));
        $Reg->nombres             = $data['nombres'];
        $Reg->apellidos           = $data['apellidos'];
        $Reg->fecha_nacimientod   = $data['fecha_nacimientod'];
        $Reg->causa               = $data['causa'];
        $Reg->fecha_fallecimiento = $data['fecha_fallecimiento'];
        $Reg->id_tarjeta_familiar = $id_tarjeta_familiar;
        $Reg->Save();
        return $Reg->id_morbilidad;
    }

    public function SaveRegistro($id_persona, $value, $id_tarjeta_familiar = NULL)
    {
        $Reg = model::Make('tbl_car_registro');
        if (!is_null($id_persona))
        {
            $Reg->Load('id_persona=?', array($id_persona));
        }
        if (!is_null($id_tarjeta_familiar))
        {
            $Reg->Load('id_tarjeta_familiar=?', array($id_tarjeta_familiar));
        }
        $Reg->value               = $value;
        $Reg->id_persona          = $id_persona;
        $Reg->id_tarjeta_familiar = $id_tarjeta_familiar;
        $Reg->Save();
        return $Reg->id_car_registro;
    }

    public static function VerVariable($id_car_variables)
    {
        $Reg = model::Make('tbl_car_variables');
        $Reg->Load('id_car_variables=?', array($id_car_variables));
        if (!is_null($Reg->id_car_variables))
        {
            return $Reg->descripcion;
        }
        else
        {
            return null;
        }
    }

    public static function VerRegistro($id_persona)
    {
        $Reg = model::Make('tbl_car_registro');
        $Reg->Load('id_persona=?', array($id_persona));
        if (!is_null($Reg->id_ficha))
        {
            return $Reg->value;
        }
        else
        {
            return null;
        }
    }

    public function VerCategorias($tipo = 'persona')
    {
        $sql  = 'SELECT 
                    `tbl_car_categoria`.`id_car_categoria`,
                    `tbl_car_categoria`.`descripcion`
                  FROM
                    `tbl_car_categoria`
                   WHERE
                   `tbl_car_categoria`.`tipo`=?
                    ORDER BY 
                   `tbl_car_categoria`.`orden`';
        $data = model::Records($sql, array($tipo));
        return $data;
    }

    public function VerVariablexcategoria($id_categoria)
    {
        $sql  = 'SELECT 
                    `tbl_car_variables`.`id_car_variables`,
                    `tbl_car_variables`.`descripcion`,
                    `tbl_car_variablexcategoria`.`orden`,
                    `tbl_car_variables`.`id_car_tipo_dato`,
                    `tbl_car_tipo_dato`.`descripcion` AS `tipo_dato`,
                    `tbl_car_variables`.`list_values`
                  FROM
                    `tbl_car_variablexcategoria`
                    INNER JOIN `tbl_car_variables` ON (`tbl_car_variablexcategoria`.`id_car_variables` = `tbl_car_variables`.`id_car_variables`)
                    INNER JOIN `tbl_car_tipo_dato` ON (`tbl_car_variables`.`id_car_tipo_dato` = `tbl_car_tipo_dato`.`id_car_tipo_dato`)
                  WHERE
                    `tbl_car_variablexcategoria`.`id_car_categoria`=?
                  ORDER BY
                    `tbl_car_variablexcategoria`.`orden` ASC';
        $data = model::Records($sql, array($id_categoria));
        return $data;
    }

}
