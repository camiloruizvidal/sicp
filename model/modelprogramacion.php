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
                `view_car_programas_actividades_valores`.`descripcion`,
                `view_car_programas_actividades_valores`.`rango_inicio`,
                `view_car_programas_actividades_valores`.`rango_fin`,
                `view_car_programas_actividades_valores`.`rango_inicio_dias`,
                `view_car_programas_actividades_valores`.`rango_fin_dias`,
                `view_car_programas_actividades_valores`.`rango_tipo`,
                `view_car_programas_actividades_valores`.`dosis`,
                `view_car_programas_actividades_valores`.`intervalo_tipo`,
                `view_car_programas_actividades_valores`.`intervalo`,
                `view_car_programas_actividades_valores`.`sexo`
              FROM
                `view_car_programas_actividades_valores`
                WHERE
                  (`view_car_programas_actividades_valores`.`sexo`=?
                  AND
                `view_car_programas_actividades_valores`.`id_car_programa`=?)
                AND
                (? BETWEEN  
                `view_car_programas_actividades_valores`.`rango_inicio_dias`
                      AND
                `view_car_programas_actividades_valores`.`rango_fin_dias`
                )';
        $Data = model::Records($sql, array($sexo, (int)$id_programa, $edad));
        return $Data;
    }

}
