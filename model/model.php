<?php

class model extends ADODB_Active_Record
{

    public static function dosql($sql, $parameters = array())
    {
        if ($sql === '' || is_null($sql))
        {
            throw new Exception('La sentencia esta vacia');
            exit;
        }
        $rs = Config::$con->Execute($sql, $parameters);
        return($rs);
    }

    public static function Record($sql, $parameters = array())
    {//Only return one file
        if ($sql === '' || is_null($sql))
        {
            throw new Exception('La sentencia esta vacia');
            exit;
        }
        $rs   = Config::$con->Execute($sql, $parameters);
        $data = array();
        if ($rs->fields)
        {
            $temp1    = null;
            $data_reg = $rs->fields;
            foreach ($data_reg as $key => $temp)
            {
                if (!is_numeric($key))
                {
                    $temp1[$key] = $temp;
                }
            }
            if (!is_null($temp1))
            {
                $data = $temp1;
            }
        }
        return($data);
    }

    public static function Records($sql, $parameters = array(), $is_numeric = false)
    {//Only return multiple files
        if ($sql === '' || is_null($sql))
        {
            throw new Exception('La sentencia esta vacia');
        }
        $rs   = Config::$con->Execute($sql, $parameters);
        $data = array();
        if (is_null($rs->fields))
        {
            throw new Exception('error');
        }
        if ($rs->fields)
        {
            while (!$rs->EOF)
            {
                $temp1    = null;
                $data_reg = $rs->fields;
                foreach ($data_reg as $key => $temp)
                {
                    if (!$is_numeric)
                    {
                        if (!is_numeric($key))
                        {
                            $temp1[$key] = $temp;
                        }
                    }
                    else
                    {
                        if (is_numeric($key))
                        {
                            $temp1[$key] = $temp;
                        }
                    }
                }
                if (!is_null($temp1))
                {
                    $data[] = $temp1;
                }
                $rs->MoveNext();
            }
        }
        return($data);
    }

    public static function Make($table)
    {
        ADOdb_Active_Record::SetDatabaseAdapter(Config::$con);
        return new ADOdb_Active_Record($table);
    }

}

?>