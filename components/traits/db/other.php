<?php

trait other{

    public static function delete($column,$where){
        try {
            $db = database::getConnection();
            $row = $db->query("DELETE FROM " . get_called_class() . " WHERE `$column` = '" . $where . "'");
        }catch (PDOException $e){
        echo 'Помилка '. $e->getMessage();
        }
    }

    public static function dropTable($name){
        try {
            $db = database::getConnection();
           $db->query("DROP TABLE $name");
        }catch (PDOException $e){
            echo 'Помилка '. $e->getMessage();
        }
    }


}