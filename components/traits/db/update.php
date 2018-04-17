<?php

trait update{

    public static function updateAll($post,$where){
        try{
            $db = database::getConnection();
            $arrayColumn = [];
            $arrayValues = [];
            foreach ($post as $column => $value){
                $arrayColumn[] = "`".$column."` = ?,";
                $arrayValues[] = $value;
            }
            $arrayColumn = preg_replace('/([,]$)/','',implode("",$arrayColumn));
            try {
                $st =$db->prepare("UPDATE " . get_called_class() . " SET ".$arrayColumn." WHERE `id` = '".$where."'");
                $st->execute($arrayValues);
            }catch (PDOException $c){
            echo 'Помилка db '. $c->getMessage();
        }

        }catch (PDOException $c){
            echo 'Помилка update '. $c->getMessage();
        }

    }


}