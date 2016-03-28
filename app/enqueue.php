<?php

namespace PremierNewsletter;

/** @var \Herbert\Framework\Enqueue $enqueue */

$enqueue->front([
    'as'  => 'optInSubscribe',
    'dep' => ['jquery'],
    'src' => Helper::assetUrl('/scripts/subscribe.js'),
]);
