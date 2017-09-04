<?php

class modelprogramacion
{

    public function VerProgramas()
    {
        $sql  = 'SELECT 
                    `tbl_car_programas`.`id_car_programas`,
                    `tbl_car_programas`.`descripcion`
                  FROM
                    `tbl_car_programas`
                    ORDER BY
                    2';
        $Data = model::Records($sql);
        return $Data;
    }

    public function VariablesPrograma($id_programa, $sexo, $edad)
    {
        $sql  = 'SELECT 
                    `tbl_car_programas_actividades`.`descripcion`,
                    `tbl_car_programas_actividades_valores`.`rango_inicio`,
                    `tbl_car_programas_actividades_valores`.`rango_fin`,
                    `tbl_car_programas_actividades_valores`.`rango_tipo`,
                    `tbl_car_programas_actividades_valores`.`dosis`,
                    `tbl_car_programas_actividades_valores`.`intervalo_tipo`,
                    `tbl_car_programas_actividades_valores`.`intervalo`,
                    `tbl_car_programas_actividades_valores`.`sexo`
                  FROM
                    `tbl_car_programas_actividades_valores`
                    INNER JOIN `tbl_car_programas_actividades` ON (`tbl_car_programas_actividades_valores`.`id_car_actividades` = `tbl_car_programas_actividades`.`id_car_programas_actividades`)
                  WHERE
                    `tbl_car_programas_actividades`.`id_car_programa` = ? AND 
                    (`tbl_car_programas_actividades_valores`.`sexo` = ?) 
                    AND
                    (  
                        ? BETWEEN `tbl_car_programas_actividades_valores`.`rango_inicio` 
                        AND 
                          `tbl_car_programas_actividades_valores`.`rango_fin`
                        AND
                          `tbl_car_programas_actividades_valores`.`rango_tipo`=?
                    )';
        $Data = model::Records($sql, array($id_programa, $sexo, $edad['year'],'años'));
        return $Data;
    }

}
