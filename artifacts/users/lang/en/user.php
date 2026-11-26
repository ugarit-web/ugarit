<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Naming
    |--------------------------------------------------------------------------
    | How the user is referred to across the UI and the feedback messages.
    */

    'name' => 'User',
    'singular' => 'User',
    'plural' => 'Users',
    'plural_definite' => 'The Users',

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    | The label and placeholder of each field in forms, tables and validation messages.
    */

    'attributes' => [
        'entity_id' => [
            'label' => 'Entity',
            'placeholder' => null,
        ],

        'username' => [
            'label' => 'Username',
            'placeholder' => null,
        ],

        'created_at' => [
            'label' => 'Created At',
            'placeholder' => null,
        ],

        'updated_at' => [
            'label' => 'Updated At',
            'placeholder' => null,
        ],

        'force' => [
            'label' => 'Force',
            'placeholder' => null,
        ],
    ],
];
