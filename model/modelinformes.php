<?php

class modelinformes
{

    public static function VerCategorias()
    {
        $sql='SELECT 
              `tbl_car_categoria`.`descripcion` AS `categoria`,
              `tbl_car_categoria`.`id_car_categoria`
            FROM
              `tbl_car_categoria`';
        $data = model::Records($sql);
        return $data;
    }
    public function datacategorias($categorias,$genero='',$municipio='')
    {
        $where='';
        if($categorias!='')
        {
            $where = 'WHERE
                  `tbl_car_categoria`.`id_car_categoria`='.$categorias;
        }
        $sql  = "SELECT 
                  `tbl_car_variables`.`id_car_variables` AS `id`,
                  `tbl_car_categoria`.`descripcion` AS `categoria`,
                  `tbl_car_variables`.`descripcion` AS `variable`,
                  CONCAT_WS('-', `tbl_car_categoria`.`descripcion`, `tbl_car_variables`.`descripcion`) AS `value`,
                  `tbl_car_variables`.`id_car_tipo_dato`,
                  `tbl_car_tipo_dato`.`descripcion` AS `tipo_dato`,
                  `tbl_car_variables`.`list_values`
                FROM
                  `tbl_car_variablexcategoria`
                  LEFT OUTER JOIN `tbl_car_variables` ON (`tbl_car_variablexcategoria`.`id_car_variables` = `tbl_car_variables`.`id_car_variables`)
                  LEFT OUTER JOIN `tbl_car_tipo_dato` ON (`tbl_car_variables`.`id_car_tipo_dato` = `tbl_car_tipo_dato`.`id_car_tipo_dato`)
                  INNER JOIN `tbl_car_categoria` ON (`tbl_car_variablexcategoria`.`id_car_categoria` = `tbl_car_categoria`.`id_car_categoria`)
                {$where}
                ORDER BY
                  `tbl_car_variables`.`id_car_variables`";
        $data = model::Records($sql);
        return $data;
    }

    public function data($edad_minima='', $edad_maxima='', $sexo='', $departamento='', $municipio='')
    {
        $whereArray = array();
        $where      = array();
        if($edad_maxima!='')
        {
            $where []='TIMESTAMPDIFF(YEAR, `tbl_persona`.`fecha_nacimiento`, CURDATE())<=?';
            $whereArray[]=$edad_maxima;
        }
        if($edad_minima!='')
        {
            $where []='TIMESTAMPDIFF(YEAR, `tbl_persona`.`fecha_nacimiento`, CURDATE())>=?';
            $whereArray[]=$edad_minima;
        }
        if($sexo!='')
        {
            $where []='`tbl_persona`.`sexo`=?';
            $whereArray[]=$sexo;
        }
        if($departamento!='')
        {
            $where []='`tbl_municipios`.`id_departamento`=?';
            $whereArray[]=$departamento;
        }
        if($municipio!='')
        {
            $where []='`tbl_tarjeta_familiar`.`id_municipio`=?';
            $whereArray[]=$municipio;
        }
        $where      = implode(' AND ', $where);
        $where      = ($where == '') ? '' : ' WHERE ' . "\n" . $where;

        $sql  = 'SELECT `tbl_car_registro`.`value`
                FROM `tbl_car_registro`
          LEFT OUTER JOIN `tbl_persona` 
                ON (`tbl_car_registro`.`id_persona` = `tbl_persona`.`id_persona`)
          LEFT OUTER JOIN `tbl_tarjeta_familiar` 
                ON (`tbl_car_registro`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
          LEFT OUTER JOIN `tbl_municipios` 
                ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
  '
                . $where;
        $data = model::Records($sql, $whereArray);
        return $data;
    }

    public function Registros($fecha_ini = '', $fecha_fin = '', $edad_min = '', $edad_max = '', $tarjeta_familiar = '')
    {
        $whereArray = array();
        $where      = array();
        if ($tarjeta_familiar !== '')
        {
            $whereArray[] = $tarjeta_familiar;
            $where[]      = ' `tbl_tarjeta_familiar`.`codigo`=? ';
        }
        if ($fecha_ini !== '')
        {
            $whereArray[] = $fecha_ini;
            $where[]      = ' date(`tbl_tarjeta_familiar`.`fecha_apertura`) >=date(?) ';
        }
        if ($fecha_fin !== '')
        {
            $whereArray[] = $fecha_fin;
            $where[]      = ' date(`tbl_tarjeta_familiar`.`fecha_apertura`) <=date(?) ';
        }
        if ($edad_min !== '')
        {
            $whereArray[] = $edad_min;
            $where[]      = ' round(DATEDIFF( CURDATE(),`tbl_persona`.`fecha_nacimiento`)/365)>=? ';
        }
        if ($edad_max !== '')
        {
            $where[]      = ' round(DATEDIFF( CURDATE(),`tbl_persona`.`fecha_nacimiento`)/365)<=? ';
            $whereArray[] = $edad_max;
        }
        $where = implode(' AND ', $where);
        $where = ($where == '') ? '' : ' WHERE ' . "\n" . $where;

        $sql  = 'SELECT 
                date(`tbl_tarjeta_familiar`.`fecha_apertura`) AS `fecha_apertura`,
                CONCAT_WS(\' \', `tbl_persona`.`nombre1`, `tbl_persona`.`nombre2`, `tbl_persona`.`apellido1`, `tbl_persona`.`apellido2`) AS `persona`,
                `tbl_persona`.`documento`,
                LPAD(`tbl_tarjeta_familiar`.`codigo`, 8, \'0\') AS `codigo`,
                `tbl_persona`.`sexo`,
                `tbl_persona`.`fecha_nacimiento`,
                round(DATEDIFF( CURDATE(),`tbl_persona`.`fecha_nacimiento`)/365) AS `year`,
                `tbl_municipios`.`descripcion` AS `municipio`,
                `tbl_departamentos`.`descripcion` AS `departamento`,
                `tbl_persona`.`id_persona`
              FROM
                `tbl_persona`
                LEFT OUTER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
                INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
                INNER JOIN `tbl_departamentos` ON (`tbl_municipios`.`id_departamento` = `tbl_departamentos`.`id_departamentos`)
              '
                . $where;
        $data = model::Records($sql, $whereArray);
        return $data;
    }

}
