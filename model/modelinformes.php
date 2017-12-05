<?php

class modelinformes
{

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
