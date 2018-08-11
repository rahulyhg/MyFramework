<?php

namespace Components\db;

use Components\core\treits\globalFunction;
use Components\db\traits\{
    dbUpdate, dbInsert, dbWhere, select
};
use components\extension\pagination;
use Components\Pages\error_page;


class models
{

    use globalFunction, dbWhere, dbInsert, dbUpdate, select;

    public static $sql;

    public static $name_table;

    public static $column_id = 'id';

    private static $request;

    private static $connect;

    private static $joinTable;

    public static function get(): array
    {
        echo $sql = self::$sql;

        $row = self::db()->query($sql);
        self::$sql = '';

        try {
            return $row->fetchall(\PDO::FETCH_ASSOC);
        } Catch (\Error $e) {
            error_page::showPageError('Sql not correct', $sql . "<br><br><br>" . $e->getMessage() . ' ' . $e->getFile() . $e->getLine());
        }
    }

    public static function limit(int $number): models
    {
        self::$sql .= " LIMIT {$number}";
        return new self();
    }


    public function pagination(int $count_in_one_page): models
    {
        self::limit($count_in_one_page);
        self::offset(pagination::calc_offset_for_pagination($count_in_one_page));
    }

    public function sum(string $column): models
    {
        self::$sql = str_replace('SELECT', "SELECT SUM(`{$column}`), ", self::$sql);
        return new self();
    }

    public function avg(string $column): models
    {
        self::$sql = str_replace('SELECT', "SELECT AVG(`{$column}`), ", self::$sql);
        return new self();
    }

    public function count(): models
    {
        self::$sql = str_replace('SELECT', "SELECT COUNT(*), ", self::$sql);
        return new self();
    }


    public function order(string $data = 'DESC', string $column = 'id'): models
    {
        self::$sql .= " ORDER BY `{$column}` {$data}";
        return new self();
    }


    public function group(string $column): models
    {
        self::$sql .= " GROUP BY `{$column}` ";
        return new self();
    }

    public function moreOn(string $firstColumn, string $secondColumn, string $nametable = ''): models
    {
        return $this->on($firstColumn, $secondColumn, $nametable, ', ');
    }

    public static function offset(int $count): models
    {
        self::$sql .= " OFFSET {$count} ";
    }

    public function leftJoin(string $table = ''): models
    {
        return $this->join($table, ' LEFT ');
    }

    public function rightJoin(string $table = ''): models
    {
        return $this->join($table, ' RIGHT ');
    }


    public function join(string $table = '', $method = ''): models
    {
        $sql = " {$method} JOIN ";

        if ($table !== '') {
            self::$joinTable = $table;
            $sql = $method . ' JOIN ' . "`{$table}`";
        }

        self::$sql .= $sql;

        return new self();
    }


    public function on(string $firstColumn, string $secondColumn, $nameTable = '', $data = ' ON '): models
    {
        $join_table = self::$joinTable;

        if (is_string($nameTable)) {
            $nameTable = $nameTable == '' ? self::nameClass() : "`$nameTable`";
            self::$sql .= " {$data}  {$nameTable}.`{$firstColumn}` = `{$join_table}`.`{$secondColumn}`";
        }

        if (is_array($nameTable)) {
            self::$sql .= " {$data}  `{$nameTable[0]}`.`{$firstColumn}` = `{$nameTable[1]}`.`{$secondColumn}`";
        }


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
            error_page::showPageError('Sql not correct', $sql . "<br><br><br>" . $e->getMessage() . ' ' . $e->getFile() . $e->getLine());
        }
    }

    public static function save(): void
    {

        try {
            $row = self::db()->prepare(self::$sql);
        } Catch (\PDOException $e) {
            error_page::showPageError('Method pdo:prepare not found in models 83str', self::$sql . "<br><br><br>" . $e->getMessage() . ' ' . $e->getFile() . $e->getLine());
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
        if ($select !== '*') {
            $select = is_array($select) ? self::ecranSelectColumn($select) : "`{$select}`";
        }

        self::$sql = "SELECT " . $select . " FROM " . self::nameClass();

        return new self();
    }


    public function selectSub($select = '*'): models
    {

        if ($select !== '*') {
            $select = is_array($select) ? self::ecranSelectColumn($select) : "`{$select}`";
        }

        self::$sql .= "(SELECT {$select} ";
        return new self();
    }


    public static function from(string $table): models
    {
        self::$sql .= " FROM `{$table}` ";
        return new self();
    }

    public static function endSub(string $as): models
    {
        self::$sql .= " ) `{$as}` ";
        return new self();
    }

    public static function as(string $column, string $as): models
    {
        $column = self::editColumnNameToEcranSymbol($column);

        if (preg_match("~$column~", self::$sql)) {
            self::$sql = str_replace($column, $column . " as `{$as}` ", self::$sql);
        } else {
            error_page::showPageError("Column {$column} Not find! to as");
        }

        return new self();
    }


    public static function where($column, $where = '', $sign = '='): models
    {
        if (empty(self::$sql)) {
            self::select();
        }

        self::$sql .= is_string($column) ? self::isStringAndWhere($column, $where, $sign) : self::isArrayAndWhere($column);

        return new self();
    }

    public function orWhere($column, $where = '', $sign = '='): models
    {
        self::$sql .= is_string($column) ? self::isStringOnOrWhere($column, $where, $sign) : self::isArrayOnOrWhere($column);

        return $this;
    }

    public function andWhere($column, $where = '', $sign = '='): models
    {
        self::$sql .= is_string($column) ? " AND `{$column}` {$sign} `{$where}`" : self::isArrayAndWhere($column, 'AND');

        return $this;
    }


    public function in($column,...$arr): models
    {

        $search = "'".implode("','", $arr)."'";

        self::$sql .= " WHERE `{$column}` IN({$search}) ";

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

    private static function db(): \PDO
    {
        if(empty(self::$connect)){
            self::$connect = database::getConnection();
        }
        return  self::$connect;
    }


}