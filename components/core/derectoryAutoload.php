<?php

class derectoryAutoload
{

    private $list;

    public function __construct()
    {
        $this->list = require_once 'config/list_dir_autoload.php';
    }


    public function getListDirectory(): array
    {
        $this->getAllDirectoryComponents($this->getIteratorDirectory('components'),'components');

        return $this->list;
    }

    private function getIteratorDirectory($dir): RecursiveIteratorIterator
    {
        return new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

    }

    private function getAllDirectoryComponents($iter,$dir)
    {
        $this->list[] = $dir;

        foreach ($iter as $path => $dir) {

            if ($dir->isDir()) {

                if (!array_search($path, $this->list)) {
                    $this->list[] = $path;
                }

            }
        }

    }
}

