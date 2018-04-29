<?php
class models{

   use globalFunction, dbWhere, dbInsert, dbUpdate;


    public static $sql;

    private static $name_table;

    private static $column_id = 'id';

    private static $request;


    public function get(): array {
        $row = db()->query(self::$sql);
        return $row->fetchall(PDO::FETCH_ASSOC);
    }
    public static function save(){
        $row = db()->prepare(self::$sql);
        $row->execute(array_values(self::$request));
    }


    public static function all(): array {
        self::$sql = "SELECT * FROM " . self::nameClass();
        return self::get();
    }

    public function first(): array {
        $arr = self::get();
        foreach ($arr as $key){
            return $key;
        }
    }


    public static function select($select = ['*']): models{
        if(is_array($select)) {
            $select = implode(',', $select);
     }
        self::$sql = "SELECT " . $select . " FROM " . self::nameClass();
            return new self();
    }



    public static function where($column,$where='',$sign = '=') : models{
       if(empty(self::$sql)) {
           self::select();
        }
        is_string($column) ? self::isStringOnWhere($column,$where,$sign) : self::isArrayOnWhere($column);
        return new self();
    }

    public function orWhere($column,$where='',$sign = '=') : models{
        is_string($column) ? self::isStringOnOrWhere($column,$where,$sign) : self::isArrayOnOrWhere($column);
        return $this;
    }

    public static function find($where) : models{
       self::where(self::$column_id,$where);
        return new self();
    }



    public static function insert(array $arr){
        if(!empty($arr)) {
            self::saveRequest($arr);
            self::$sql = self::into();
            self::$sql .= self::columnForInsert();
            self::$sql .= self::valuesForInsert();
            self::save();
        }
    }


    public static function update(array $arr): models{
        if(!empty($arr)) {
            self::saveRequest($arr);
            self::$sql = self::updateSql();
            self::$sql .= self::set();
            return new self();
        }
    }



    public static function delete(): models{
        self::$sql = "DELETE FROM " . self::nameClass();
        return new self();
    }

    public static function drop($name){
        self::$sql = "DROP TABLE " . $name;
        self::get();
    }



    public static function table(string $name): models{
        self::$name_table = $name;
        return new self();
    }


    private static function saveRequest(array $arr){
        self::$request = $arr;
    }
}