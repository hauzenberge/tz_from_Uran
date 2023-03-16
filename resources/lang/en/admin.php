<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'organisation' => [
        'title' => 'Organisations',

        'actions' => [
            'index' => 'Organisations',
            'create' => 'New Organisation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'subscribed' => 'Subscribed',
            'trial_end' => 'Trial end',
            'owner_id' => 'Owner',
            
        ],
    ],

    'organisation' => [
        'title' => 'Organisations',

        'actions' => [
            'index' => 'Organisations',
            'create' => 'New Organisation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'subscribed' => 'Subscribed',
            'trial_end' => 'Trial end',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];