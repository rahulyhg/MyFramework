<?php

namespace Components\db;

use Components\core\treits\globalFunction;
use Components\db\traits\{dbUpdate,dbInsert,dbWhere};
use Components\db\database;

class models{

    use globalFunction, dbWhere, dbInsert, dbUpdate;

    private static $sql;

    public static $name_table;

    public static $column_id = 'id';

    private static $request;

    private static $connect;

    public static function get(): array
    {
        $row = self::db()->query(self::$sql);
        self::$sql = '';
        return $row->fetchall(\PDO::FETCH_ASSOC);
    }

    public static function save(): void
    {
        $row = self::db()->prepare(self::$sql);
        self::$sql = '';
        $row->execute(array_values(self::$request));
    }

    public static function all(): array
    {
        self::$sql = "SELECT * FROM " . self::nameClass();
        return self::get();
    }


    public function first(): array
    {
        $arr = self::get();
        foreach ($arr as $key) {
            return $key;
        }
    }


    public static function select($select = '*'): models
    {
        if($select !== '*'){
            is_array($select) ? $select = self::ecranSelectColumn($select) : $select = "`{$select}`";
        }
        self::$sql = "SELECT " . $select . " FROM " . self::nameClass();

        return new self();
    }

    public static function where($column, $where = '', $sign = '='): models
    {
        if (empty(self::$sql)) {
            self::select();
        }

        is_string($column) ? self::isStringOnWhere($column, $where, $sign) : self::isArrayOnWhere($column);

        return new self();
    }

    public function orWhere($column, $where = '', $sign = '='): models
    {
        is_string($column) ? self::isStringOnOrWhere($column, $where, $sign) : self::isArrayOnOrWhere($column);

        return $this;
    }

    public static function find(string $where): models
    {
        self::where(self::$column_id, $where);

        return new self();
    }

    public static function insert(array $arr): void
    {
        self::$request = $arr;
        self::$sql = self::into();
        self::$sql .= self::columnForInsert();
        self::$sql .= self::valuesForInsert();
        self::save();
    }

    public static function update(array $arr): models
    {
        self::$request = $arr;
        self::$sql = self::updateSql();
        self::$sql .= self::set();
        return new self();
    }

    public static function delete(): models
    {
        self::$sql = "DELETE FROM " . self::nameClass();
        return new self();
    }

    public static function drop(string $name): void
    {
        self::$sql = "DROP TABLE `" . $name."`";
        self::get();
    }

    public static function table(string $name): models
    {
        self::$name_table = $name;
        return new self();
    }

    private static function nameClass(): string
    {
       $name = en(explode('\\',get_called_class()));
       return $name == 'models' ? '`'.self::$name_table.'`' : '`'.$name.'`';
    }

    private static function ecranSelectColumn(array $select): string
    {
        $arr = [];

        foreach ($select as $key){
            array_push($arr,"`{$key}`");
        }

        return implode(',',$arr);
    }

    private static function db():\PDO
    {
        if(empty(self::$connect)){
            self::$connect = database::getConnection();
        }
        return  self::$connect;
    }
}