<?php

namespace Components\db;

use Components\core\treits\globalFunction;
use Components\db\traits\{dbUpdate,dbInsert,dbWhere};
use Components\Pages\error_page;

class models{

    use globalFunction, dbWhere, dbInsert, dbUpdate;

    private static $sql;

    public static $name_table;

    public static $column_id = 'id';

    private static $request;

    private static $connect;

    private static $joinTable;

    public static function get(): array
    {
        $sql = self::$sql;

        $row = self::db()->query($sql);
        //echo $sql;
        self::$sql = '';

        try {
            return $row->fetchall(\PDO::FETCH_ASSOC);
        } Catch (\Error $e) {
            error_page::showPageError('Sql not correct',$sql."<br><br><br>".$e);
        }
    }

    public static function limit(int $number): models
    {
        self::$sql .=" LIMIT {$number}";
        return new self();
    }


    public function pagination(int $count_in_one_page): models
    {
        self::limit($count_in_one_page);
        self::offset(self::calc_offset_for_pagination($count_in_one_page));
    }

    private static function calc_offset_for_pagination(int $count): int
    {
        return get('page') && get('name') > 1 ? (get('page') - 1) * $count : 0;
    }


    public function order(string $data = 'DESC',string $column = 'id'): models
    {
        self::$sql .=" ORDER BY `{$column}` {$data}";
        return new self();
    }

    public function on(string $firstColumn, string $secondColumn,$data = ' ON '):models
    {
        $join_table = self::$joinTable;

        $nameClass = self::nameClass();

        self::$sql .= " {$data}  {$nameClass}.`{$firstColumn}` = `{$join_table}`.`{$secondColumn}`";

        return new self();
    }

    public function group(string $column): models
    {
        self::$sql .= " GROUP BY `{$column}` ";
        return new self();
    }

    public function moreOn(string $firstColumn, string $secondColumn): models
    {
        return $this->on($firstColumn,$secondColumn,', ');
    }

    public static function offset(int $count): models
    {
        self::$sql .= " OFFSET {$count} ";
    }

    public function leftJoin(string $table): models
    {
        return $this->join($table,' LEFT ');
    }

    public function rightJoin(string $table): models
    {
       return $this->join($table,' RIGHT ');
    }


    public function join(string $table,$method = ''): models
    {
        self::$joinTable = $table;
        self::$sql .= $method .' JOIN '. "`{$table}`";
        return new self();
    }

    public function param(array $arr)
    {
        $sql = self::$sql;

        self::$sql = '';

        try {
            $row = self::db()->prepare($sql);
        } Catch (\PDOException $e) {
            error_page::showPageError('Method pdo:prepare.50str SQL ERROR:  ', $sql);
        }

        try {
            $row->execute($arr);
            return $row->fetchall(\PDO::FETCH_ASSOC);
        } Catch (\Error $e) {
            error_page::showPageError('Sql not correct', $sql . "<br><br><br>" . $e);
        }
    }

    public static function save(): void
    {

        try {
            $row = self::db()->prepare(self::$sql);
        }Catch(\PDOException $e){
            error_page::showPageError('Method pdo:prepare not found in models 83str',self::$sql."<br><br><br>".$e);
        }

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
        return $arr[0];
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

    public static function insert(array $arr): string
    {
        self::$request = $arr;
        self::$sql = self::into();
        self::$sql .= self::columnForInsert();
        self::$sql .= self::valuesForInsert();
        self::save();
        return self::db()->lastInsertId();
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