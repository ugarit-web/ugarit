<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Naming
    |--------------------------------------------------------------------------
    | How the user is referred to across the UI and the feedback messages.
    */

    'name' => 'مستخدم',
    'singular' => 'مستخدم',
    'plural' => 'مستخدمين',
    'plural_definite' => 'المستخدمين',

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    | The label and placeholder of each field in forms, tables and validation messages.
    */

    'attributes' => [
        'entity_id' => [
            'label' => 'الكيان',
            'placeholder' => null,
        ],

        'username' => [
            'label' => 'اسم المستخدم',
            'placeholder' => null,
        ],

        'created_at' => [
            'label' => 'تاريخ الإنشاء',
            'placeholder' => null,
        ],

        'updated_at' => [
            'label' => 'تاريخ التحديث',
            'placeholder' => null,
        ],

        'force' => [
            'label' => 'حذف نهائي',
            'placeholder' => null,
        ],
    ],
];
