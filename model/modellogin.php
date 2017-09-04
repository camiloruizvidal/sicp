<?php

class modellogin
{

    public function EditUser($id_usuario, $login, $pass, $nombre, $apellido, $documento)
    {
        $pass = md5($pass);
        $user = model::Make('tbl_usuario');
        $user->Load('id_usuario=?', array($id_usuario));
        if (!is_null($user->id_usuario))
        {
            $user->login     = $login;
            $user->pass      = $pass;
            $user->nombre    = $nombre;
            $user->apellido  = $apellido;
            $user->documento = $documento;
            $user->Save();
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function detalle_usuario($id_usuario)
    {
        $sql = 'SELECT 
                `tbl_usuario`.`login`,
                `tbl_usuario`.`id_perfil_tercero`,
                `tbl_usuario`.`id_perfil_tipo`,
                `tbl_usuario`.`nombre`,
                `tbl_usuario`.`apellido`,
                `tbl_usuario`.`documento`
              FROM
                `tbl_usuario`
                WHERE
                  `tbl_usuario`.`id_usuario`=?';
        return model::Record($sql, array($id_usuario));
    }

    public static function Guardarcodigo($data)
    {
        $cod                    = model::Make('tbl_codigos');
        $cod->codigo_inicio     = $data['codigo_inicio'];
        $cod->codigo_fin        = $data['codigo_fin'];
        $cod->codigo_next_value = $data['codigo_inicio'];
        $cod->id_usuario        = $data['id_usuario'];
        $cod->activo            = 'si';
        $cod->Save();
        return $cod->id_codigos;
    }

    public static function VerCodigos($id_user)
    {
        $sql = 'SELECT 
                `tbl_codigos`.`codigo_inicio`,
                `tbl_codigos`.`codigo_fin`,
                `tbl_codigos`.`codigo_next_value`,
                `tbl_codigos`.`activo`
              FROM
                `tbl_codigos`
              WHERE
                `tbl_codigos`.`id_usuario`=?
                ORDER BY
                  `tbl_codigos`.`id_codigos` DESC';
        return model::Records($sql, array($id_user));
    }

    public function ValidarUsuario($login, $Pass)
    {
        $sql = 'SELECT 
                `tbl_usuario`.`id_usuario`,
                `tbl_codigos`.`codigo_inicio`,
                `tbl_codigos`.`codigo_fin`,
                `tbl_perfil_tipo`.`descripcion` as tipo_perfil,
                (SELECT 
                    MIN(`cod`.`codigo_next_value`) as `codigo_next_value`
                  FROM
                    `tbl_codigos` `cod`
                    WHERE
                    `cod`.`codigo_next_value`<`cod`.`codigo_fin`
                    AND
                    `cod`.`id_usuario`=`tbl_usuario`.`id_usuario`) as codigo_next_value,
                concat_ws(\' \',`tbl_usuario`.`nombre`,`tbl_usuario`.`apellido`) as encuestador,
                `tbl_usuario`.`id_perfil_tipo`,
                `tbl_usuario`.`documento` as documento_responsable
                                FROM
                                  `tbl_usuario`
        LEFT OUTER JOIN `tbl_codigos` ON (`tbl_usuario`.`id_usuario` = `tbl_codigos`.`id_codigos`)
        INNER JOIN `tbl_perfil_tipo` ON (`tbl_usuario`.`id_perfil_tipo` = `tbl_perfil_tipo`.`id_perfil_tipo`)
          WHERE
            `tbl_usuario`.`login`=? AND 
            `tbl_usuario`.`pass`=md5(?)';
        return model::Record($sql, array($login, $Pass));
    }

}
