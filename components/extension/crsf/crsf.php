<?php

namespace Components\extension\crsf;

use Components\extension\infoPages\error_page;

class crsf
{

    public static function createCrsf(): void
    {
        if(!isset($_SESSION['crsf'])){
            $_SESSION['crsf'] = md5(uniqid(rand(),true));
        }
    }

    public static function checkCrsf(): void
    {
        if(isset($_POST['crsf']) && $_POST['crsf'] != $_SESSION['crsf'] || !isset($_POST['crsf'])){
            error_page::showPageError('CRSF???', 'Giv crsf');
        }
    }

    public static function getCrsf(): string
    {
        return "<input name='crsf' type='hidden' value='{$_SESSION['crsf']}'>";
    }

}