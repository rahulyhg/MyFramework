<?php

//return  namespace::funct + namespace:fucnt

return [
    'catalog_menu' => \app\models\menu::getMenuCatalog(),
    'cart'          => new \app\controllers\site\basketController(),
    'prod'          => new \app\twigHelpers\tovar(),
    'helpers'       => new \app\twigHelpers\all()
];