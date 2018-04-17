<?php
class models{

   use globalFunction, dbWhere, dbInsert, dbUpdate;


    public static $sql;

    private static $name_table;

    private static $column_id = 'id';


    public static function all(){
        self::$sql = "SELECT * FROM " . self::nameClass();
        return self::get();
    }

    public static function select($select = ['*']): models{
        if(is_array($select)) {
            $select = implode(',', $select);
     }
        self::$sql = "SELECT " . $select . " FROM " . self::nameClass();
        return new models();
    }



    public static function where($column,$where='',$sign = '=') : models{
       if(empty(self::$sql)) {
           self::select();
        }
        is_string($column) ? self::isStringOnWhere($column,$where,$sign) : self::isArrayOnWhere($column);
        return new models();
    }

    public function orWhere($column,$where='',$sign = '=') : models{
        is_string($column) ? self::isStringOnOrWhere($column,$where,$sign) : self::isArrayOnOrWhere($column);
        return $this;
    }

    public static function find($where) : models{
       self::where(self::$column_id,$where);
       return new models();
    }


    public function get():array {
        $row = db()->query(htmlspecialchars(self::$sql));
        return $row->fetchall(PDO::FETCH_ASSOC);
    }

    public function first(): array {
       $arr = self::get();
       foreach ($arr as $key){
           return $key;
       }
    }

    public static function insert(array $arr){
        self::$sql = self::into();
        self::$sql .= self::columnForInsert($arr);
        self::$sql .= self::valuesForInsert($arr);
        return new models();
    }

    public static function update(array $arr): models{
        self::$sql = self::updateSql();
        self::$sql .= self::set($arr);
        return new models();
    }


    public static function delete(){
        self::$sql = "DELETE FROM " . self::nameClass();
        return new models();
    }

    public static function drop($name){
        self::$sql = "DROP TABLE " . $name;
        self::get();
    }

    public static function table(string $name){
        self::$name_table = $name;
        return new models();
    }
}