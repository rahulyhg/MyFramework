<?php


class indexController extends Controller {

    public function index(){

       echo  $this->twig()->render('page.html', array('text' => 'Hrd!'));

    }

}



