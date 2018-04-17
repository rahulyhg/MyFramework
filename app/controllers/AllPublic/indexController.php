<?php


class indexController extends Controller {

    public function index(){
       dump(people::allPeople());
    }
}