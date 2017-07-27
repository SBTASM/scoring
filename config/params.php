<?php

return [
    'adminEmail' => 'admin@example.com',
    'roles' => [
        'admin' => [
            'actions' => ['index', 'logout'],
            'rules' => [
                'groups' => 'app\rbac\UserGroupRule'
            ]
        ],
        'user' => [
            'actions' => ['index', 'logout'],
            'rules' => [
                'groups' => 'app\rbac\UserGroupRule'
            ]
        ],
    ]
];
