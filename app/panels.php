<?php

namespace PremierNewsletter;

/* @var \Herbert\Framework\Panel $panel */

$panel->add([
    'type'   => 'panel',
    'as'     => 'mainPanel',
    'title'  => 'Newsletter',
    'rename' => 'Dashboard',
    'slug'   => 'premiernewsletter-dashboard',
    'icon'   => 'dashicons-email',
    'uses'   => __NAMESPACE__.'\Controllers\DashboardController@index',
]);

$panel->add([
    'type'   => 'sub-panel',
    'parent' => 'mainPanel',
    'as'     => 'listPanel',
    'title'  => 'List Management',
    'slug'   => 'premiernewsletter-list',
    'uses'   => __NAMESPACE__.'\Controllers\ListController@index',
    'get'    => [
        'form'           => __NAMESPACE__.'\Controllers\ListController@form',
        'confirm-delete' => __NAMESPACE__.'\Controllers\ListController@confirmDelete',
    ],
    'post' => [
        'create' => __NAMESPACE__.'\Controllers\ListController@create',
        'update' => __NAMESPACE__.'\Controllers\ListController@update',
        'delete' => __NAMESPACE__.'\Controllers\ListController@delete',
    ],
]);

$panel->add([
    'type'   => 'sub-panel',
    'parent' => 'mainPanel',
    'as'     => 'settingsPanel',
    'title'  => 'Settings',
    'slug'   => 'premiernewsletter-settings',
    'uses'   => __NAMESPACE__.'\Controllers\SettingsController@form',
    'post'   => [
        'update' => __NAMESPACE__.'\Controllers\SettingsController@update',
    ],
]);
