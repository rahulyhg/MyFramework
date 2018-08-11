<?php

namespace app\controllers;

use app\models\test;
use Components\Controller;
use Components\db\models;



class indexController extends Controller {

    public function index()
    {

echo "SELECT `tovars`.*,`n`.`name` as `category`,`n`.`id_cat` FROM `langs_bridge`  LEFT JOIN `tovars` On `tovars`.`lid` = `langs_bridge`.`id` LEFT JOIN `tovar_categories`  ON `tovar_categories`.`lid_tovar` = `tovars`.`lid`

 join (SELECT `category`.`name`,`tovar_categories`.`lid_tovar`,`tovar_categories`.`Id_categor` as `id_cat` FROM `category` 
   join `tovar_categories`  On `category`.`lid` = `tovar_categories`.`Id_categor` WHERE `lang_id` = 2 and `visible` = 1) as `n` ON  `tovars`.`lid` = `n`.`lid_tovar`

WHERE `id_lang` = 2 GROUP BY `lid` <br><br><br>";

       $kek = self::table('langs_bridge')->select(['tovars'=>['*'],'n'=>['name','id_cat']])->as('n.name','category')
       ->leftJoin('tovars')->on('id','lid')
       ->leftJoin('tovar_categories')->on('lid','lid_tovar','tovars')
       ->join()->selectSub(['category'=>['name'],'tovar_categories' => ['lid_tovar','Id_categor']])->as('tovar_categories.Id_categor','id_cat')->from('category')
       ->join('tovar_categories') ->on('lid','Id_categor','category')->where(['category' => ['lang_id' => 2,'visible'=>1]])
       ->endSub('n')->on('lid','lid_tovar',['tovars','n'])->where('id_lang',2)->group('lid')
       ->get();
dump($kek);
    }


}



