<?php

return [
    'notification_fields' => [
        'short_title',
        'title',
        'category',
        'd_cat_caption',
        'thumbnail_link',
        'notice_link',
        'description',
        'region_name',
        'issuing_authority',
        'designation',
        'unit_name',
        'unit_type',
        'publish_date',
        'deadline',
        'source_url',
        'caption1',
        'caption2',
        'caption3',
        'tags',
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

    'formats' => [
        'date' => 'j M, Y',
        'datetime' => 'j M, Y h:i A',
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

