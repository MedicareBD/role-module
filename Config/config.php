<?php

return [
    'name' => 'Role',

    'menus' => [
        [
            'text' => 'Settings',
            'icon' => 'fas fa-cogs',
            'can' => 'settings-read',
            'order' => 100,
            'submenu' => [
                [
                    'text'      => 'Roles',
                    'route'     => 'admin.roles.index',
                    'icon'      => 'fas fa-user-shield',
                    'can'       => 'roles-read'
                ],
                [
                    'text'      => 'Assign Role',
                    'route'     => 'admin.assign-role.index',
                    'icon'      => 'fas fa-user-shield',
                    'can'       => 'roles-assign-read'
                ],
            ]
        ]
    ],

    // For Seeders
    'create_users' => true,

    'roles_structure' => [
        'Super Admin' => [
            'dashboard' => 'r',
            'roles' => 'c,r,u,d',
            'roles-assign' => 'c,r',
            'languages' => 'c,r,u,d',

            'customers' => 'c,r,u,d',
            'customers-paid' => 'r',
            'customers-credit' => 'r',
            'customers-ledger' => 'r',

            'manufacturer' => 'c,r,u,d',
            'manufacturer-ledger' => 'r',

            'medicines' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'units' => 'c,r,u,d',
            'types' => 'c,r,u,d',
            'leafs' => 'c,r,u,d',

            'banks' => 'c,r,u,d',

            'taxes' => 'c,r,u,d',
            'taxes-settings' => 'r',

            'employees' => 'c,r,u,d',
            'designations' => 'c,r,u,d',

            'settings' => 'r',
            'backup' => 'c,r,d',
            'backup-setting' => 'r,u',
            'reset' => 'r,u',
            'restore' => 'r,u',
        ],
        'Advisor' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'settings' => 'r'
        ],
        'Sales Man' => [
            'profile' => 'r,u',
            'settings' => 'r'
        ],
        'Customer' => [
            'profile' => 'r,u',
            'settings' => 'r'
        ],
        'Manufacturer' => [
            'profile' => 'r,u',
            'settings' => 'r'
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
