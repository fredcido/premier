<?php
namespace PremierNewsletter;

$router->get([
    'as'   => 'info',
    'uri'  => '/premier/list',
    'uses' => __NAMESPACE__ . '\Controllers\ListController@list'
]);
