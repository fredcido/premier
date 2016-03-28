<?php

namespace PremierNewsletter\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\RedirectResponse;

use PremierNewsletter\Repositories;

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
        $subscribeRepository = new Repositories\SubscribeRepository();
        $status = $subscribeRepository->subscribe($http->all());
    }
}
