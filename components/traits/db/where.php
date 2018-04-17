<?php

trait where{

    static function suchWhere($column, $where,array $select = ['*'],$sample = 'DESC',$columnOrder = 'id' ){
        try{
            return  is_array($column) ? self::isArrayWhere($column, $where,$select,$sample,$columnOrder) :
                self::isStringWhere($column, $where,$select,$sample,$columnOrder);
        }catch (PDOException $e){
            echo 'НЕ вдається вивести інф з БД '. $e->getMessage();
        }
    }

    private static function isArrayWhere($column, $where,$select,$sample,$columnOrder){
        try {
            $db = database::getConnection();
            $array = self::returnArr($column, $where);
            $row = $db->query("SELECT " . self::implodeSelect($select) . " FROM " . get_called_class() . " $array ORDER BY $columnOrder $sample");
            $arr = $row->fetchAll(PDO::FETCH_ASSOC);
            return count($arr) !== 0 ? $arr : "Записів не знайдено!!";
        }catch (PDOException $c){
            echo 'isArrayWhere: '. $e->getMessage();
        }
    }

    private static function returnArr($column,$where){
        try{
        $masuv = [];
        foreach ($column as $key){
            $masuv[] = $key." = '".array_shift($where)."'";
        }
        return  "WHERE " . implode(' AND ',$masuv);
           }catch (PDOException $c){
                echo 'returnArr: '. $e->getMessage();
            }
    }

    private static function isStringWhere($column, $where,$select,$sample,$columnOrder){
        try {
            $db = database::getConnection();
            $row = $db->query("SELECT " . self::implodeSelect($select) . " FROM " . get_called_class() . " WHERE `$column` = '" . $where . "' ORDER BY $columnOrder $sample");
            $arr = $row->fetchAll(PDO::FETCH_ASSOC);
            return count($arr) !== 0 ? $arr : "Записів не знайдено!!";
        }catch (PDOException $c){
                echo 'getConnection: '. $e->getMessage();
        }
    }


}