<?php

return [
    'notification_categories' => [
        'NOTICE',
        'JOB',
        'TENDER',
        'NEWS',
        'POLICY',
    ],

    'approval_status' => [
        'pending'  => 'PENDING',
        'approved' => 'APPROVED',
        'rejected' => 'REJECTED',
    ],

    'permissions' => [
        'create'   => 'create-notifications',
        'update'   => 'update-notifications',
        'delete'   => 'delete-notifications',
        'view'     => 'view-notifications',
        'feedback' => 'give-feedback',
    ],

    'roles' => [
        'admin'      =>'admin',
        'operator'   => 'data-operator',
        'subscriber' => 'subscribed-member',
        'guest'      => 'guest'
    ],

// TODO: do something with routes, they are all over the place
    'routes' => [
        'index',
        'home',
        'login',
        'data_entry',
        'admin',
    ],
];

