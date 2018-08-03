<?php

class derectoryAutoload
{

    private $list;

    private $dir;

    public function __construct()
    {
        $this->list = require_once 'config/list_dir_autoload.php';
    }


    public function getListDirectory(): array
    {
        $this->getAllDirectoryComponents($this->getIteratorDirectory('app'));

        $this->getAllDirectoryComponents($this->getIteratorDirectory('components'));

        return $this->list;
    }

    private function getIteratorDirectory($dir): RecursiveIteratorIterator
    {
        $this->dir = $dir;

        return new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

    }

    private function getAllDirectoryComponents($iter)
    {
        $this->list[] = $this->dir;

        foreach ($iter as $path => $dir) {

            if ($dir->isDir()) {

                if (!array_search($path, $this->list)) {
                    $this->list[] = $path;
                }

            }
        }

    }
}

