<?php

namespace Components\extension\models;

use Components\core\treits\globalFunction;
use Components\extension\db\database;
use  Components\extension\models\traits\{
    dbUpdate, dbInsert, dbWhere, select
};
use Components\extension\html\pagination;
use Components\extension\infoPages\error_page;

/**
 * Class models
 * @package Components\db
 * @method static models method($arument)
 */

class models
{

    use globalFunction, dbWhere, dbInsert, dbUpdate, select;

    /**
     * @var string $sql
     */

    public static $sql;


    /**
     * @var $name_table
     */


    public static $name_table;


    /**
     * @var string
     */

    public static $column_id = 'id';



    private static $request;



    private static $connect;



    private static $joinTable;


    /**
     * @return array
     */

    public static function get()
    {
        $sql = self::$sql;
        $row = self::db()->query($sql);

        self::$sql = '';
        self::$name_table = '';
        try {
            return $row->fetchall(\PDO::FETCH_ASSOC);
        } Catch (\Error $e) {
            error_page::showPageError('code: #bcx3r6r Sql not correct', $sql . "<br><br><br>" . $e->getMessage() . ' ' . $e->getFile() . $e->getLine());
        }
    }


    public function limit(int $number): models
    {
        self::$sql .= " LIMIT {$number}";
        return $this;
    }


    public function pagination(int $count_in_one_page, int $countRows): models
    {
        $this->limit($count_in_one_page);
        pagination::$count_page = ceil($countRows / $count_in_one_page);
        $this->offset(pagination::calc_offset_for_pagination($count_in_one_page));
        return $this;
    }


    public function sum(string $column): models
    {
        self::$sql = str_replace('SELECT', "SELECT SUM(`{$column}`), ", self::$sql);
        return $this;
    }



    public function avg(string $column): models
    {
        self::$sql = str_replace('SELECT', "SELECT AVG(`{$column}`), ", self::$sql);
        return $this;
    }


    public function count(): models
    {
        self::$sql = str_replace('SELECT *', "SELECT COUNT(*) as `count`", self::$sql);

        return $this;
    }


    public function random(): models
    {
        self::$sql .= " ORDER BY RAND() ";
        return $this;
    }


    public function order(string $data = 'DESC', string $column = 'id'): models
    {
        self::$sql .= " ORDER BY `{$column}` {$data}";
        return $this;
    }


    public function group(string $column): models
    {
        self::$sql .= " GROUP BY `{$column}` ";
        return $this;
    }


    public function moreOn(string $firstColumn, string $secondColumn, string $nametable = ''): models
    {
        return $this->on($firstColumn, $secondColumn, $nametable, ', ');
    }


    public function offset(int $count): models
    {
        self::$sql .= " OFFSET {$count} ";
        return $this;
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

        return $this;
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
        return $this;
    }

    private function sql(string $sql)
    {
        self::$sql = $sql;
        return $this;
    }


    public function param(array $arr)
    {
        $sql = self::$sql;
        self::$sql = '';
        try {
            $row = self::db()->prepare($sql);
        } Catch (\PDOException $e) {
            error_page::showPageError('code: #111e11 Method pdo:prepare.50str SQL ERROR:  ', $sql);
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



    private function first(): array
    {
        $arr = $this->select()->limit(1)->get();
        return $arr[0];
    }



    private function select($select = '*'): models
    {
        if ($select !== '*') {
            $select = is_array($select) ? self::ecranSelectColumn($select) : "`{$select}`";
        }
        self::$sql = "SELECT " . $select . " FROM " . self::nameClass();

        return $this;
    }



    public function selectSub($select = '*'): models
    {
        if ($select !== '*') {
            $select = is_array($select) ? self::ecranSelectColumn($select) : "`{$select}`";
        }
        self::$sql .= "(SELECT {$select} ";
        return $this;
    }



    public function endSub(string $as): models
    {
        self::$sql .= " ) `{$as}` ";
        return $this;
    }



    public function from(string $table): models
    {
        self::$sql .= " FROM `{$table}` ";
        return $this;
    }



    public function as(string $column, string $as): models
    {
        $column = self::editColumnNameToEcranSymbol($column);
        if (preg_match("~$column~", self::$sql)) {
            self::$sql = str_replace($column, $column . " as `{$as}` ", self::$sql);
        } else {
            error_page::showPageError("Column {$column} Not find! to as", 'code: #wet346');
        }
        return $this;
    }


    /**
     * @param $column
     * @param string $where
     * @param string $sign
     * @return models
     */

    private function where($column, $where = '', $sign = '='): models
    {
        if (empty(self::$sql)) {
            $this->select();
        }

        self::$sql .= is_string($column) ? self::isStringAndWhere($column, $where, $sign) : self::isArrayAndWhere($column);

        return $this;
    }


    public function orWhere($column, $where = '', $sign = '='): models
    {
        self::$sql .= is_string($column) ? self::isStringOnOrWhere($column, $where, $sign) : self::isArrayOnOrWhere($column);
        return $this;
    }



    public function andWhere($column, $where = '', $sign = '=',$ecran = true): models
    {
        if($ecran){
            $where = "'".$where."'";
        }
            self::$sql .= is_string($column) ? " AND `{$column}` {$sign} {$where}" : self::isArrayAndWhere($column, 'AND');
        return $this;
    }



    public function in($column, $sql = ' where', $arr): models
    {
        if($arr){
            $search = "'" . implode("','", $arr) . "'";
            self::$sql .= " {$sql} `{$column}` IN({$search}) ";
        }
        return $this;
    }



    public function find(string $where): models
    {
        self::where(self::$column_id, $where);
        return $this;
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



    private function update(array $arr): models
    {
        self::$request = $arr;
        self::$sql = self::updateSql();
        self::$sql .= $this->set();
        return $this;
    }



    public static function delete(): models
    {
        self::$sql = "DELETE FROM " . self::nameClass();
        return new self();
    }



    public static function drop(string $name): void
    {
        self::$sql = "DROP TABLE `{$name}`";
        self::get();
    }


    /**
     * @return string
     */


    private static function nameClass(): string
    {
        if (strrchr(self::$name_table, '\\')) {
            self::$name_table = arr_end(explode('\\', self::$name_table));
        }

        if(empty(self::$name_table)){
            self::$name_table =     arr_end(explode('\\', get_called_class()));
        }

        return "`" . self::$name_table . "`";
    }

    /**
     * @return \PDO
     */

    public static function db(): \PDO
    {
        return empty(self::$connect) ?  self::$connect = database::getConnection() : self::$connect;
    }


    public static function __callStatic($name, $arguments): models
    {
        $object = new self();

        if(method_exists(__CLASS__,$name)){
            self::$name_table = get_called_class();
            call_user_func_array([$object, $name], $arguments);
        }else{
            self::$name_table = $name;
        }

        return $object;
    }

    public function __call($name, $arguments): models
    {
        if(method_exists(__CLASS__,$name)){
            call_user_func_array([$this, $name], $arguments);
        }
        return $this;
    }

}