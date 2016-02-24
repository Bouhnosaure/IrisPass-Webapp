<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pricing category
    |--------------------------------------------------------------------------
    |
    | This array set all the type of organizations
    |
    */

    'categories' => [

        'company' => [
            'users'     => 'unlimited',
            'groups'    => 'unlimited',
            'mails'     => 'unlimited',
            'website'   => '1',
            'crm'       => '1'
        ],

        'association' => [
            'users'     => 'unlimited',
            'groups'    => 'unlimited',
            'mails'     => 'unlimited',
            'website'   => '1',
            'crm'       => '1'
        ],

        'student' => [
            'users'     => '1',
            'groups'    => 'unlimited',
            'mails'     => '1',
            'website'   => '1',
            'crm'       => '1'
        ],

        'personal' => [
            'users'     => '1',
            'groups'    => 'unlimited',
            'mails'     => '1',
            'website'   => '1',
            'crm'       => '1'
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Pricing tables
    |--------------------------------------------------------------------------
    |
    | Here you may define all the pricing and goods allowed
    |
    */

    'pricing' => [

        'company' => [
            'base'      => '15',
            'users'     => '1',
            'mails'     => '0',
            'website'   => '0',
            'crm'       => '0',
        ],

        'association' => [
            'base'      => '7',
            'users'     => '0.5',
            'mails'     => '0',
            'website'   => '0',
            'crm'       => '0',
        ],

        'student' => [
            'base'      => '7',
            'users'     => 'omitted',
            'mails'     => '0',
            'website'   => '0',
            'crm'       => '0',
        ],

        'personal' => [
            'base'      => '10',
            'users'     => 'omitted',
            'mails'     => '0',
            'website'   => '0',
            'crm'       => '0',
        ]

    ],

];
