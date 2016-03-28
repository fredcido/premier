<?php 

namespace PremierNewsletter;

/** @var \Herbert\Framework\Router $router */

$router->post([
    'as'   => 'subscribeRoute',
    'uri'  => '/subscribe',
    'uses' =>  __NAMESPACE__ . '\Controllers\SubscribeController@save'
]);