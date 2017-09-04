<?php

class modeldatos
{

    public static function regimen()
    {
        $sql = 'SELECT 
                    `tbl_regimen`.`id_regimen`,
                    `tbl_regimen`.`descripcion`
                FROM
                    `tbl_regimen`
                ORDER BY 2';
        return model::Records($sql);
    }

    public static function departamento()
    {
        $sql = 'SELECT 
                    `tbl_departamentos`.`id_departamentos`,
                      `tbl_departamentos`.`descripcion`
                    FROM
                      `tbl_departamentos`
                      ORDER BY 2';
        return model::Records($sql);
    }

    public static function municipios($id_departamento = '')
    {

        $sql = 'SELECT 
                    `tbl_municipios`.`id_municipio`,
                    `tbl_municipios`.`descripcion`,
                    `tbl_municipios`.`id_departamento`
                FROM
                    `tbl_municipios`
                WHERE
                    `tbl_municipios`.`id_departamento` = ?
                ORDER BY 2';
        return model::Records($sql, array($id_departamento));
    }

    public static function veredas($id_municipio = '')
    {
        $sql = 'SELECT 
                    `tbl_veredas`.`id_vereda`,
                    `tbl_veredas`.`descripcion`,
                    `tbl_veredas`.`id_municipio`
                FROM
                    `tbl_veredas`
                WHERE
                `tbl_veredas`.`id_municipio`=?
                ORDER BY 2';
        return model::Records($sql, array($id_municipio));
    }

    public static function corregimientos($id_municipio)
    {
        if ($id_municipio != '')
        {
            $sql = 'SELECT 
                `tbl_corregimientos`.`id_corregimiento`,
                `tbl_corregimientos`.`descripcion`
              FROM
                `tbl_corregimientos`
              WHERE
                `tbl_corregimientos`.`id_municipio` = ?
              ORDER BY
                2';
            return model::Records($sql, array($id_municipio));
        }
    }

    public static function neweps($name)
    {
        $eps              = model::Make('tbl_asegurador');
        $eps->descripcion = $name;
        $eps->Save();
        return $eps->id_asegurador;
    }

    public static function familiaridad()
    {
        $sql = 'SELECT 
              `tbl_persona_familiaridad`.`id_persona_familiaridad`,
              `tbl_persona_familiaridad`.`descripcion`,
              `tbl_persona_familiaridad`.`sexo`
            FROM
              `tbl_persona_familiaridad`  
              ORDER BY
              `tbl_persona_familiaridad`.`descripcion`';
        return model::Records($sql);
    }

    public static function tipodocumento()
    {
        $sql = 'SELECT 
              `tbl_documento_tipo`.`id_documento_tipo`,
              `tbl_documento_tipo`.`descripcion`,
              `tbl_documento_tipo`.`codigo`
            FROM
              `tbl_documento_tipo`  
              ORDER BY
              `tbl_documento_tipo`.`descripcion`';
        return model::Records($sql);
    }

    public static function zona()
    {
        $sql = 'SELECT 
                    `tbl_zona`.`id_zona`,
                    `tbl_zona`.`descripcion`
                FROM
                    `tbl_zona`
                ORDER BY 2';
        return model::Records($sql);
    }

    public static function estadocivil()
    {
        $sql = 'SELECT 
                    `tbl_estado_civil`.`id_estado_civil`,
                    `tbl_estado_civil`.`descripcion`
                FROM
                    `tbl_estado_civil`
                    ORDER BY 2';
        return model::Records($sql);
    }

    public static function asegurador()
    {
        $sql = 'SELECT 
                    `tbl_asegurador`.`id_asegurador`,
                    `tbl_asegurador`.`descripcion`
                  FROM
                    `tbl_asegurador`
                    ORDER BY 2';
        return model::Records($sql);
    }

    public static function niveleducativo()
    {
        $sql = 'SELECT 
                    `tbl_nivel_educativo`.`id_nivel_educativo`,
                    `tbl_nivel_educativo`.`descripcion`
                  FROM
                    `tbl_nivel_educativo`
                    ORDER BY 2';
        return model::Records($sql);
    }

}
