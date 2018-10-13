<?php

//return  namespace::funct + namespace:fucnt

return [
    'catalog_menu' => \app\models\category::getCategory(),
    'cart'          => new \app\controllers\site\basketController(),
    'prod'          => new \app\twigHelpers\tovar(),
    'helpers'       => new \app\twigHelpers\all()
];