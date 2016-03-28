<?php namespace PremierNewsletter;

/** @var \Herbert\Framework\API $api */

/**
 * Gives you access to the Helper class from Twig
 * {{ PremierNewsletter.helper('assetUrl', 'icon.png') }}
 */
$api->add('helper', function () {
    $args = func_get_args();
    $method = array_shift($args);

    return forward_static_call_array(__NAMESPACE__ . '\\Helper::' . $method, $args);
});

/**
 * Gives you access to the translation method from Twig
 * {{ PremierNewsletter.t('text', 'domain') }}
 */
$api->add('t', function ()
{
    $args = func_get_args();
    return call_user_func_array('__', $args);
});
