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
        'company',
        'association',
        'student',
        'personal',
    ],


    /*
    |--------------------------------------------------------------------------
    | Pricing limits
    |--------------------------------------------------------------------------
    |
    | This array set all the limits of organizations
    |
    */
    '_default' => [
        'limits' => [
            'users' => [
                'base' => '0',
                'max' => '0',
                'more' => '0'
            ],
            'groups' => [
                'base' => '0',
                'max' => '0'
            ],
            'mails' => [
                'base' => '0',
                'max' => '0'
            ],
            'website' => [
                'base' => '0',
                'max' => '0'
            ],
            'crm' => [
                'base' => '0',
                'max' => '0'
            ]
        ]
    ],

    'pricing' => [

        'company' => [
            'name' => 'Plan Company',
            'description' => 'This is some description for a Company Plan',
            'type' => 'monthly',
            'price' => '15',
            'limits' => [
                'users' => [
                    'base' => '2',
                    'max' => 'unlimited',
                    'more' => '1'
                ],
                'groups' => [
                    'base' => 'unlimited',
                    'max' => 'unlimited'
                ],
                'mails' => [
                    'base' => '2',
                    'max' => 'unlimited'
                ],
                'website' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'crm' => [
                    'base' => '1',
                    'max' => '1'
                ]
            ]
        ],

        'association' => [
            'name' => 'Plan association',
            'description' => 'This is some description for a Association Plan',
            'type' => 'monthly',
            'price' => '10',
            'limits' => [
                'users' => [
                    'base' => '2',
                    'max' => 'unlimited',
                    'more' => '0.5'
                ],
                'groups' => [
                    'base' => 'unlimited',
                    'max' => 'unlimited'
                ],
                'mails' => [
                    'base' => '2',
                    'max' => 'unlimited'
                ],
                'website' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'crm' => [
                    'base' => '1',
                    'max' => '1'
                ]
            ]
        ],

        'student' => [
            'name' => 'Plan Student',
            'description' => 'This is some description for a Student Plan',
            'type' => 'monthly',
            'price' => '5',
            'limits' => [
                'users' => [
                    'base' => '1',
                    'max' => '1',
                    'more' => 'n/a'
                ],
                'groups' => [
                    'base' => 'unlimited',
                    'max' => 'unlimited'
                ],
                'mails' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'website' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'crm' => [
                    'base' => '1',
                    'max' => '1'
                ]
            ]
        ],

        'personal' => [
            'name' => 'Plan Personal',
            'description' => 'This is some description for a Personal Plan',
            'type' => 'monthly',
            'price' => '5',
            'limits' => [
                'users' => [
                    'base' => '1',
                    'max' => '1',
                    'more' => 'n/a'
                ],
                'groups' => [
                    'base' => 'unlimited',
                    'max' => 'unlimited'
                ],
                'mails' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'website' => [
                    'base' => '1',
                    'max' => '1'
                ],
                'crm' => [
                    'base' => '1',
                    'max' => '1'
                ]
            ]
        ]

    ],

];
