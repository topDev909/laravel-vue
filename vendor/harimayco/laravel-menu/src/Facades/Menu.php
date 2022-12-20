<?php 
namespace Harimayco\Menu\Facades;

use Arcanedev\LogViewer\Contracts\Table;
use Illuminate\Support\Facades\Facade;

class Menu extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'harimayco-menu';
    }
}