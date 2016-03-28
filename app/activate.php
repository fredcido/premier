<?php

/** @var  \Herbert\Framework\Application $container */
/** @var  \Herbert\Framework\Http $http */
/** @var  \Herbert\Framework\Router $router */
/** @var  \Herbert\Framework\Enqueue $enqueue */
/** @var  \Herbert\Framework\Panel $panel */
/** @var  \Herbert\Framework\Shortcode $shortcode */
/** @var  \Herbert\Framework\Widget $widget */

use Illuminate\Database\Capsule\Manager as Capsule;
use PremierNewsletter\Helper;

// Delete all tables
Capsule::schema()->dropIfExists('pre_settings');

// Create table pre_settings
Capsule::schema()->create('pre_settings', function($table)
{
    $table->increments('id');
    $table->string('mailgun_private_key');
});

// Insert register
Capsule::table('pre_settings')->insertGetId(array('mailgun_private_key' => 'private-key'));
