<?php
return [
    'required' => true,
    'icon' => 'fa-cog',
    'default_ctrl' => 'FormContact',
    'default_listing' => 'FormContact',
    'name' => __('Formulaire de contact'),

    'appdesk' => [
        'FormContact' => [
            'name' => __('Formulaire de contact'),
            'type' => 'update',
            'icon' => 'fa-envelope-o',
            'model' => 'FormContact',
            'fields' => [
                'title' => __('Formulaire de contact')
            ],
        ]
    ],
    'enhancers' => [
        'form_contact' => [
            'appname' => 'FormContact',
            'name' => 'Formulaire de contact' ,
            'controller' => 'FormContact',
            'action' => 'main'
        ]
    ],
];