<?php

return [
    'adminEmail' => 'admin@example.com',
    'roles' => [
        'admin' => [
            'actions' => ['index', 'logout', 'all_edit', 'all_view'],
            'rules' => [
                'groups' => 'app\rbac\UserGroupRule'
            ]
        ],
        'user' => [
            'actions' => ['index', 'logout', 'edit', 'view'],
            'rules' => [
                'groups' => 'app\rbac\UserGroupRule',
                'owner' => 'app\rbac\OwnerRule',
            ]
        ],
    ],
    'rules' => [
        \app\behaviors\PointsBehavior::class,
        \app\behaviors\TestBehavior::class
    ],
];
