<?php

namespace PremierNewsletter\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\RedirectResponse;

class SubscribeController extends AbstractController
{

    /**
     * Subscribe user email list.
     *
     * @param Http $http [description]
     *
     * @return [type] [description]
     */
    public function save(Http $http)
    {
        var_dump($http->all());exit;
    }
}
