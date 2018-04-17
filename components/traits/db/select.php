<?php

trait select{

    static function showAll(array $select = ['*'],$sample = 'DESC', $column = 'id'){
        try{
            $db = database::getConnection();
            $row = $db->query("SELECT ".self::implodeSelect($select)." FROM ".  get_called_class() . " ORDER BY $column $sample");
            return $row->fetchall(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo 'НЕ вдається вивести інф з БД '. $e->getMessage();
        }
    }

    static function find($id, $column = 'id'){
        try{
            $db = database::getConnection();
            $row = $db->query('SELECT * FROM '.  get_called_class() . " WHERE $column = $id");
            $arr = $row->fetch(PDO::FETCH_ASSOC);
            return count($arr) > 1 ? $arr :  "Записів не знайдено!!";
        }catch (PDOException $e){
            echo 'НЕ вдається вивести інф з БД '. $e->getMessage();
        }
    }

    private static function implodeSelect($arr){
        return  implode(',',$arr);
    }


}