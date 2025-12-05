<?php

return [
    [
        'label' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'home',
        'activeRoute' => 'dashboard',
    ],
    [
        'label' => 'Master',
        'route' => '#',
        'icon' => 'building',
        'activeRoute' => 'master.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'Pasien',
                'route' => '#',
                'icon' => 'dna',
                'activeRoute' => 'roles.*',
            ],
            [
                'label' => 'Tindakan',
                'route' => '#',
                'icon' => 'activity',
                'activeRoute' => 'activities.*',
            ],
            [
                'label' => 'Assesment',
                'route' => '#',
                'icon' => 'shield-plus',
                'activeRoute' => 'assesments.*',
            ],
        ],
    ],
    [
        'label' => 'User Akses',
        'route' => '#',
        'icon' => 'key',
        'activeRoute' => 'users.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'User',
                'route' => 'users.index',
                'icon' => 'users',
                'activeRoute' => 'users.*',
            ],
            [
                'label' => 'Role',
                'route' => '#',
                'icon' => 'file-terminal',
                'activeRoute' => 'roles.*',
            ],
        ],
    ],
    [
        'label' => 'Pelayanan Medis',
        'route' => '#',
        'icon' => 'medical',
        'activeRoute' => 'medical-services.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'Antrean',
                'route' => '#',
                'icon' => 'pull-request',
                'activeRoute' => 'queues.*',
            ],
            [
                'label' => 'Perawatan',
                'route' => '#',
                'icon' => 'clipboard-plus',
                'activeRoute' => 'treathments.*',
            ],
            [
                'label' => 'Rujukan',
                'route' => '#',
                'icon' => 'bed-double',
                'activeRoute' => 'references.*',
            ],
        ],
    ],
    [
        'label' => 'Rekam Medis',
        'route' => '#',
        'icon' => 'stethoscope',
        'activeRoute' => 'medical-records.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'Rekam Medis Pasien',
                'route' => '#',
                'icon' => 'accessibility',
                'activeRoute' => 'medical-records-patients.*',
            ],
            [
                'label' => 'Screaning Kesehatan',
                'route' => '#',
                'icon' => 'monitor-down',
                'activeRoute' => 'screening-health.*',
            ],
        ],
    ],
    [
        'label' => 'Management Inventory',
        'route' => '#',
        'icon' => 'text-quote',
        'activeRoute' => 'inventory.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'Katalog Stock',
                'route' => '#',
                'icon' => 'book-image',
                'activeRoute' => 'inventory-catalogs.*',
            ],
            [
                'label' => 'Stok Opname',
                'route' => '#',
                'icon' => 'sticker',
                'activeRoute' => 'inventory-opnames.*',
            ],
        ],
    ],
    [
        'label' => 'Management Nakes',
        'route' => '#',
        'icon' => 'line',
        'activeRoute' => 'nakes.*',
        'hasDropdown' => true,
        'submenu' => [
            [
                'label' => 'Nakes',
                'route' => '#',
                'icon' => 'antenna',
                'activeRoute' => 'nakes.*',
            ],
            [
                'label' => 'Jadwal Nakes',
                'route' => '#',
                'icon' => 'calendar-clock',
                'activeRoute' => 'nakes-schedules.*',
            ],
        ],
    ],
    [
        'label' => 'Setting API Key',
        'route' => 'dashboard',
        'icon' => 'setting',
        'activeRoute' => 'setting-api',
    ],
    [
        'label' => 'Log Aktifitas',
        'route' => 'dashboard',
        'icon' => 'chart-network',
        'activeRoute' => 'log-activity',
    ],
];
