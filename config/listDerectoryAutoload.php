<?php
class listDerectoryAutoload{

    private $list;

    public function __construct()
    {
        $this->list = [
            'components',
            'config',
            'components/db/traits',
            'components/db',
            'app/controllers',
            'app/middleware',
            'app/models',
            'tests/',
            'components/middleware',
            'components/Pages',
            'components/core',
            'components/Admin',
            'components/Admin/controllers',
            'components/Admin/middleware',
            'components/Admin/models',
            'components/core/treits'
        ];
    }


    public function getListDirectory(): array
    {
       //$this->getDirInComponents();

        return $this->list;
    }

    public function getDirInComponents(): void
    {


    }
}
