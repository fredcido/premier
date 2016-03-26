<?php


return [
     /**
      * Premier Name
      */
    'pluginName' => 'Premier Newsletter',

    /**
     * Prefix Table
     */
    'prefix' => 'prem_',

    /**
     * The Herbert version constraint.
     */
    'constraint' => '~0.9.9',

    /**
     * Auto-load all required files.
     */
    'requires' => [
        __DIR__ . '/app/customPostTypes.php'
    ],

    'mailgun' => [
        'private-key' => 'key-9949b17a15a7754c7cf9c45939edc5fb',
        'public-key' => 'pubkey-e72993e845ffbe33a3611d5240cb0441',
        'domain' => 'gilsonterra.com'
    ],

    /**
     * The tables to manage.
     */
    'tables' => [
    ],


    /**
     * Activate
     */
    'activators' => [
        __DIR__ . '/app/activate.php'
    ],

    /**
     * Deactivate
     */
    'deactivators' => [
        __DIR__ . '/app/deactivate.php'
    ],

    /**
     * The shortcodes to auto-load.
     */
    'shortcodes' => [
        __DIR__ . '/app/shortcodes.php'
    ],

    /**
     * The widgets to auto-load.
     */
    'widgets' => [
        __DIR__ . '/app/widgets.php'
    ],

    /**
     * The styles and scripts to auto-load.
     */
    'enqueue' => [
        __DIR__ . '/app/enqueue.php'
    ],

    /**
     * The routes to auto-load.
     */
    'routes' => [
        'PremierNewsletter' => __DIR__ . '/app/routes.php',
    ],

    /**
     * The panels to auto-load.
     */
    'panels' => [
        'PremierNewsletter' => __DIR__ . '/app/panels.php'
    ],

    /**
     * The APIs to auto-load.
     */
    'apis' => [
        'PremierNewsletter' => __DIR__ . '/app/api.php'
    ],

    /**
     * The view paths to register.
     *
     * E.G: 'PremierNewsletter' => __DIR__ . '/views'
     * can be referenced via @PremierNewsletter/
     * when rendering a view in twig.
     */
    'views' => [
        'PremierNewsletter' => __DIR__ . '/resources/views'
    ],

    /**
     * The view globals.
     */
    'viewGlobals' => [

    ],

    /**
     * The asset path.
     */
    'assets' => '/resources/assets/'

];
