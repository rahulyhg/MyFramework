<?php

trait insert{

public function saveAll($post){

    $db = database::getConnection();
    $arrayColumn = [];
    $arrayValues = [];
    foreach ($post as $column => $value){
        $arrayColumn[] = "`".$column."`";
        $arrayValues[] = $value;
    }
    $arrayColumn = implode(",",$arrayColumn);
    $count = self::prepareElement($arrayValues);

            $st =$db->prepare("INSERT INTO " . get_called_class() . "($arrayColumn) VALUES($count)");
            $st->execute($arrayValues);

}

private function prepareElement(array $array){
    $count = '?';
    for($i = 1; $i<count($array);$i++){
        $count .= ',?';
    }
    return $count;
}


}