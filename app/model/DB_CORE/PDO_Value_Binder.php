<?php

// tomado de: https://stackoverflow.com/questions/22234945/inserting-array-data-using-pdo-prepared-statements

namespace App\model\DB_CORE;

class PDO_Value_Binder{

    private static $pdoTypes = array(
        'boolean' => \PDO::PARAM_BOOL,
        'integer' => \PDO::PARAM_INT,
        'double'  => \PDO::PARAM_INT,
        'string'  => \PDO::PARAM_STR,
        'NULL'    => \PDO::PARAM_NULL
    );    

    public static function bindValue($statement, $paramName, $value, $pdoType = null) {
        if ($paramName[0] != ':') {
            $paramName = ':' . $paramName; //Add colon in case we forgot
        }

        if (empty($pdoType)) {
            $valueType = gettype($value); //Get the type of $value to match

            if (isset(self::$pdoTypes[$valueType])) {
                $pdoType = self::$pdoTypes[$valueType]; //We know this
            } else {
                $value = print_r($value, true); //Convert to string
                $pdoType = \PDO::PARAM_STR; //Default to a string
            }
        }

        return $statement->bindValue($paramName, $value, $pdoType);
    }

    public static function bindValues($statement, $paramKVP, $pdoType = null) {
        $return = true;

        foreach ($paramKVP as $paramName => $value) {
            $return = self::bindValue($statement, $paramName, $value, $pdoType) && $return;
        }

        return $return;
    }     


}