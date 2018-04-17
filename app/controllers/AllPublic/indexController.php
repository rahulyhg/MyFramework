<?php


class indexController extends Controller {

    public function index(){
        if(isset($_POST['people'])){
      test::insert($_POST);
        }
        echo test::$sql;
    }
}
?>
<form action="" method="post">
    <textarea name="people"></textarea>
    <input type="submit">
</form>
