CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_car_programas_actividades_valores` AS 
  select 
    `tbl_car_programas_actividades`.`descripcion` AS `descripcion`,
    `tbl_car_programas_actividades_valores`.`rango_inicio` AS `rango_inicio`,
    `tbl_car_programas_actividades_valores`.`rango_fin` AS `rango_fin`,
    (case when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'años') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 365) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'semanas') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 7) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'mes') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 30) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'dias') then (`tbl_car_programas_actividades_valores`.`rango_inicio` * 1) end) AS `rango_inicio_dias`,
    (case when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'años') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 365) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'semanas') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 7) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'mes') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 30) when (`tbl_car_programas_actividades_valores`.`rango_tipo` = 'dias') then (`tbl_car_programas_actividades_valores`.`rango_fin` * 1) end) AS `rango_fin_dias`,
    `tbl_car_programas_actividades_valores`.`rango_tipo` AS `rango_tipo`,
    `tbl_car_programas_actividades_valores`.`dosis` AS `dosis`,
    `tbl_car_programas_actividades_valores`.`intervalo_tipo` AS `intervalo_tipo`,
    `tbl_car_programas_actividades_valores`.`intervalo` AS `intervalo`,
    `tbl_car_programas_actividades_valores`.`sexo` AS `sexo`,
    `tbl_car_programas_actividades`.`id_car_programa` AS `id_car_programa` 
  from 
    (`tbl_car_programas_actividades_valores` join `tbl_car_programas_actividades` on((`tbl_car_programas_actividades_valores`.`id_car_actividades` = `tbl_car_programas_actividades`.`id_car_programas_actividades`)));