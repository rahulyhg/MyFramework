<?php

namespace app\controllers\site;

use app\models\starRating;
use Components\Controller;
use Components\extension\arr\Get;

class starRatingController extends Controller
{
    public function change(Get $get): void
    {
        $this->save($get->all());

         die(json_encode(['avg' => starRating::getAvgRating()]));
    }

    public function save(array $get): void
    {
        starRating::insert($get);
    }


}