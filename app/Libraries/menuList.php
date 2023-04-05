<?php

namespace App\Libraries;

class menuList
{
    public static function getAdminMenu()
    {
        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'admin',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Kelola Pengguna',
                'menuTarget' => 'admin/manajemenuser',
                'menuIcon' => 'fa-fw fa-users',
                'activeTrigger' => 'manajemenuser'
            ],
        ];

        return $menu;
    }
    public static function getPpicMenu()
    {

        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'ppic',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Data bahan',
                'menuTarget' => 'ppic/manajemenproduk',
                'menuIcon' => 'fa fa-boxes',
                'activeTrigger' => 'manajemenproduk'
            ],
            [
                'idMenu' => 3,
                'menuName' => 'Data Pesanan',
                'menuTarget' => 'ppic/pesanan',
                'menuIcon' => 'fas fa-list',
                'activeTrigger' => 'pesanan'
            ]
        ];

        return $menu;
    }

    public static function getDyeingMenu()
    {

        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'dyeing',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Data produksi',
                'menuTarget' => 'dyeing/produksi',
                'menuIcon' => 'fa fa-calendar',
                'activeTrigger' => 'produksi'
            ]
        ];

        return $menu;
    }

    public static function getPrintingMenu()
    {

        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'printing',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Produksi',
                'menuTarget' => 'printing/produksi',
                'menuIcon' => 'fas fa-boxes',
                'activeTrigger' => 'produksi'
            ]
        ];

        return $menu;
    }

    public static function getFinishingMenu()
    {

        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'finishing',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Produksi',
                'menuTarget' => 'finishing/produksi',
                'menuIcon' => 'fas fa-boxes',
                'activeTrigger' => 'produksi'
            ]
        ];

        return $menu;
    }
    public static function getManajerMenu()
    {

        $menu = [
            [
                'idMenu' => 1,
                'menuName' => 'Dashboard',
                'menuTarget' => 'manajer',
                'menuIcon' => 'fa-fw fa-tachometer-alt',
                'activeTrigger' => 'main'
            ],
            [
                'idMenu' => 2,
                'menuName' => 'Pesanan',
                'menuTarget' => 'manajer/pesanan',
                'menuIcon' => 'fas fa-list',
                'activeTrigger' => 'pesanan'
            ],
            [
                'idMenu' => 3,
                'menuName' => 'Produksi',
                'menuTarget' => 'manajer/produksi',
                'menuIcon' => 'fas fa-boxes',
                'activeTrigger' => 'produksi'
            ]
        ];

        return $menu;
    }

    public static function getMenu($role)
    {
        switch ($role) {
            case 'admin':
                return menuList::getAdminMenu();
                break;
            case 'manajer':
                return menuList::getManajerMenu();
                break;
            case 'ppic':
                return menuList::getPpicMenu();
                break;
            case 'dyeing':
                return menuList::getDyeingMenu();
                break;
            case 'printing':
                return menuList::getPrintingMenu();
                break;
            case 'finishing':
                return menuList::getFinishingMenu();
                break;
            default:
                return menuList::getAdminMenu();
                break;
        }
    }
}
