<?php

namespace PremierNewsletter;

/* @var \Herbert\Framework\Panel $panel */

$panel->add([
    'type' => 'panel',
    'as' => 'mainPanel',
    'title' => 'Premier',
    'rename' => 'Dashboard',
    'slug' => 'premiernewsletter-dashboard',
    'icon' => Helper::assetUrl('/img/icon.jpeg'),
    'uses' => __NAMESPACE__.'\Controllers\DashboardController@index',
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'mainPanel',
    'as' => 'list',
    'title' => 'List Management',
    'slug' => 'premiernewsletter-list',
    'icon' => 'dashicons-media-audio',
    'uses' => __NAMESPACE__.'\Controllers\ListController@list',
]);
