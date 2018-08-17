<?php

namespace Components\core;

use Components\core\treits\globalFunction;


class migrations
{
    use globalFunction;

    public static $version = 1;


    public static function getMigration(){

        if(session('setting.migration.version') !== self::$version || !session('setting.migration.version')){

            self::tableMigration();

            if(self::selectVersion() < self::$version){

                self::startMigration();

                self::logBdMigration();

            }

            session()->add('setting',['migration' => ['version' => self::$version]]);
        }

    }

    private static function logBdMigration():void
    {
        self::table('migration')->insert(['version' => 1]);
    }

    private static function selectVersion():float
    {
        $version = self::table('migration')->select('version')->order()->limit(1)->get();

        return empty($version) ? 0 : $version[0]['version'];
    }

    private static function tableMigration():void
    {
        self::sql("CREATE TABLE IF NOT EXISTS `migration` ( `id` INT NOT NULL AUTO_INCREMENT ,
                        `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                        `version` FLOAT(11) NOT NULL , PRIMARY KEY (`id`)) 
                        ENGINE = InnoDB;")->get();
    }

    private static function startMigration(): void
    {

    }
}