<?php
class models{

   use globalFunction;

    protected static $array;

   public static function all(){
       $row = db()->query("SELECT * FROM ". get_called_class());
       self::$array =  $row->fetchall(PDO::FETCH_ASSOC);
        return new models();
   }

   public function show(){
       return self::$array;
   }

   public static function select(array $arr){
           $row = db()->query("SELECT " . implode(', ', $arr) . " FROM " . get_called_class());
           self::$array = $row->fetchall(PDO::FETCH_ASSOC);
           return new models();
       }


}