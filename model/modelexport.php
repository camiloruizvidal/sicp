<?php

class modelexport
{

    public function exportarData($fecha_ini = '', $fecha_fin = '', $edad_min = '', $edad_max = '')
    {
        $whereArray = array();
        $where      = array();
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
                    `tbl_tarjeta_familiar`.`codigo`,
                    CONCAT_WS(\' \',  `tbl_persona`.`nombre1`,  `tbl_persona`.`nombre2`,  `tbl_persona`.`apellido1`,  `tbl_persona`.`apellido2`) as persona,
                    `tbl_persona`.`documento`,
                    (SELECT 
                      CONCAT(CONCAT(YEAR(CURDATE()) - YEAR(`cal_edad_persona`.`fecha_nacimiento`)) - IF(MONTH(CURDATE()) < MONTH(`cal_edad_persona`.`fecha_nacimiento`), 1, IF(MONTH(CURDATE()) = MONTH(`cal_edad_persona`.`fecha_nacimiento`), IF(DAY(CURDATE()) < DAY(`cal_edad_persona`.`fecha_nacimiento`), 1, 0), 0)), \' años, \', MONTH(CURDATE()) - MONTH(`cal_edad_persona`.`fecha_nacimiento`) + 12 * IF(MONTH(CURDATE()) < MONTH(`cal_edad_persona`.`fecha_nacimiento`), 1, IF(MONTH(CURDATE()) = MONTH(`cal_edad_persona`.`fecha_nacimiento`), IF(DAY(CURDATE()) < DAY(`cal_edad_persona`.`fecha_nacimiento`), 1, 0), 0)) - IF(MONTH(CURDATE()) <> MONTH(`cal_edad_persona`.`fecha_nacimiento`),(DAY(CURDATE()) < DAY(`cal_edad_persona`.`fecha_nacimiento`)), IF(DAY(CURDATE()) < DAY(`cal_edad_persona`.`fecha_nacimiento`), 1, 0)), \' meses y \',(DAY(CURDATE()) - DAY(`cal_edad_persona`.`fecha_nacimiento`) + 30 * (DAY(CURDATE()) < DAY(`cal_edad_persona`.`fecha_nacimiento`))), \' dias\') AS `edad`
                    FROM
                      `tbl_persona` `cal_edad_persona`
                    WHERE
                      `cal_edad_persona`.`id_persona`=`tbl_persona`.`id_persona`) AS `edad`,
                    `tbl_persona`.`sexo` as genero,
                    `tbl_persona`.`fecha_nacimiento`,
                    `tbl_persona`.`id_rango` as rango,
                    `tbl_persona`.`es_cabeza_familia` as cabeza_familia,
                    `tbl_estado_civil`.`descripcion` as estado_civil,
                    `tbl_nivel_educativo`.`descripcion` as nivel_educativo,
                    `tbl_tarjeta_familiar`.`fecha_apertura`,
                    `tbl_tarjeta_familiar`.`sisben_ficha`,
                    `tbl_tarjeta_familiar`.`sisben_puntaje`,
                    `tbl_tarjeta_familiar`.`sisben_nivel`,
                    `tbl_tarjeta_familiar`.`direccion`,
                    `tbl_tarjeta_familiar`.`telefono`,
                    `tbl_tarjeta_familiar`.`portabilidad`,
                    `tbl_tarjeta_familiar`.`cambio_domicilio`,
                    `tbl_tarjeta_familiar`.`proxima_visita`,
                    `tbl_tarjeta_familiar`.`documento_responsable`,
                    `tbl_tarjeta_familiar`.`responsable`,
                    `tbl_zona`.`descripcion` as zona,
                    COALESCE(`tbl_veredas`.`descripcion`,\'NN\') as vereda,
                    COALESCE(`tbl_corregimientos`.`descripcion`,\'NN\') as corregimiento,
                    `tbl_municipios`.`descripcion` as municipio,
                    `tbl_departamentos`.`descripcion` as departamento,
                    COALESCE(`tbl_persona_familiaridad`.`descripcion`,\'NN\') as familiaridad,
                    COALESCE(`tbl_asegurador`.`descripcion`,\'NN\') as asegurador,
                    COALESCE(`tbl_regimen`.`descripcion`,\'NN\') as regimen
                FROM
                    `tbl_tarjeta_familiar`
                    LEFT OUTER JOIN `tbl_veredas` ON (`tbl_tarjeta_familiar`.`id_vereda` = `tbl_veredas`.`id_vereda`)
                    LEFT OUTER JOIN `tbl_zona` ON (`tbl_tarjeta_familiar`.`id_zona` = `tbl_zona`.`id_zona`)
                    LEFT OUTER JOIN `tbl_corregimientos` ON (`tbl_tarjeta_familiar`.`id_corregimiento` = `tbl_corregimientos`.`id_corregimiento`)
                    INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
                    INNER JOIN `tbl_departamentos` ON (`tbl_municipios`.`id_departamento` = `tbl_departamentos`.`id_departamentos`)
                    INNER JOIN `tbl_persona` ON (`tbl_tarjeta_familiar`.`id_tarjeta_familiar` = `tbl_persona`.`id_tarjeta_familiar`)
                    LEFT OUTER JOIN `tbl_estado_civil` ON (`tbl_persona`.`id_estado_civil` = `tbl_estado_civil`.`id_estado_civil`)
                    LEFT OUTER JOIN `tbl_nivel_educativo` ON (`tbl_persona`.`id_nivel_educativo` = `tbl_nivel_educativo`.`id_nivel_educativo`)
                    LEFT OUTER JOIN `tbl_persona_familiaridad` ON (`tbl_persona`.`id_persona_familiaridad` = `tbl_persona_familiaridad`.`id_persona_familiaridad`)
                    LEFT OUTER JOIN `tbl_asegurador` ON (`tbl_persona`.`id_asegurador` = `tbl_asegurador`.`id_asegurador`)
                    LEFT OUTER JOIN `tbl_regimen` ON (`tbl_persona`.`id_regimen` = `tbl_regimen`.`id_regimen`)'
                . $where;
        $data = model::Records($sql, $whereArray, true);
        return $data;
    }

    public function caracteristica_persona($id_persona)
    {
        $sql       = 'SELECT 
		  `tbl_car_registro`.`value`
		FROM
		  `tbl_car_registro`
		WHERE
		  `tbl_car_registro`.`id_persona` = ?';
        $Resultado = model::Record($sql, array($id_persona));
        return $Resultado['value'];
    }

    public function variable($id_variable)
    {
        $sql       = 'SELECT 
		  `tbl_car_variables`.`id_car_variables`,
		  `tbl_car_variables`.`descripcion`,
		  `tbl_car_variables`.`id_car_tipo_dato`,
		  `tbl_car_variables`.`list_values`
		FROM
		  `tbl_car_variables`
		  WHERE
		  `tbl_car_variables`.`id_car_variables`=?';
        $Resultado = model::Record($sql, array($id_variable));
        return $Resultado;
    }

    public function datos_tarjeta_familiar($id_tarjeta_familiar)
    {
        $sql       = 'SELECT 
                        `tbl_tarjeta_familiar`.`id_tarjeta_familiar`,
                        `tbl_tarjeta_familiar`.`fecha_apertura` AS `fecha_registro`,
                        `tbl_tarjeta_familiar`.`fecha_apertura`,
                        `tbl_tarjeta_familiar`.`codigo`,
                        `tbl_tarjeta_familiar`.`sisben_ficha` AS `ficha_sisben`,
                        `tbl_tarjeta_familiar`.`sisben_puntaje` AS `puntaje`,
                        `tbl_tarjeta_familiar`.`sisben_nivel` AS `nivel`,
                        `tbl_tarjeta_familiar`.`direccion` AS `direccion`,
                        `tbl_tarjeta_familiar`.`direccion` as domicilio,
                        `tbl_tarjeta_familiar`.`id_zona`,
                        `tbl_tarjeta_familiar`.`telefono`,
                        `tbl_tarjeta_familiar`.`id_municipio`,
                        `tbl_tarjeta_familiar`.`id_corregimiento`,
                        `tbl_tarjeta_familiar`.`id_vereda`,
                        `tbl_tarjeta_familiar`.`portabilidad` AS `potabilidad`,
                        `tbl_tarjeta_familiar`.`cambio_domicilio`,
                        `tbl_tarjeta_familiar`.`proxima_visita` AS `fecha_proxima_visita`,
                        `tbl_tarjeta_familiar`.`documento_responsable`,
                        `tbl_tarjeta_familiar`.`responsable`,
                        `tbl_departamentos`.`descripcion` AS `departamento`,
                        `tbl_municipios`.`descripcion` AS `municipio`,
                        COALESCE(`tbl_veredas`.`descripcion`, \'NN\') AS `vereda`,
                        COALESCE(`tbl_corregimientos`.`descripcion`, \'NN\') AS `corregimiento`
                      FROM
                        `tbl_tarjeta_familiar`
                        INNER JOIN `tbl_municipios` ON (`tbl_tarjeta_familiar`.`id_municipio` = `tbl_municipios`.`id_municipio`)
                        INNER JOIN `tbl_departamentos` ON (`tbl_municipios`.`id_departamento` = `tbl_departamentos`.`id_departamentos`)
                        INNER JOIN `tbl_corregimientos` ON (`tbl_municipios`.`id_municipio` = `tbl_corregimientos`.`id_municipio`)
                        INNER JOIN `tbl_veredas` ON (`tbl_municipios`.`id_municipio` = `tbl_veredas`.`id_municipio`)
                      WHERE
                        `tbl_tarjeta_familiar`.`id_tarjeta_familiar` = ?';
        $Resultado = model::Record($sql, array($id_tarjeta_familiar));
        return $Resultado;
    }

    public function registros($id_tarjeta_familiar)
    {
        $sql       = 'SELECT 
			  `tbl_car_registro`.`value`
			FROM
			  `tbl_car_registro`
			WHERE
			  `tbl_car_registro`.`id_tarjeta_familiar`=?';
        $Resultado = model::Record($sql, array($id_tarjeta_familiar));
        return $Resultado;
    }

    public function datos_persona1($id_tarjeta_familiar)
    {
        $sql       = 'SELECT 
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
  `tbl_persona`.`es_cabeza_familia`,
  `tbl_persona`.`ocupacion` as descripcion
FROM
  `tbl_persona`
  INNER JOIN `tbl_tarjeta_familiar` ON (`tbl_persona`.`id_tarjeta_familiar` = `tbl_tarjeta_familiar`.`id_tarjeta_familiar`)
WHERE
  `tbl_tarjeta_familiar`.`id_tarjeta_familiar` =  ?';
        $Resultado = model::Records($sql, array($id_tarjeta_familiar));
        return $Resultado;
    }

}
