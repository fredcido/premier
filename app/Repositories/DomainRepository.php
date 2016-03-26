<?php

namespace PremierNewsletter\Repositories;

use Mailgun\Mailgun;
use PremierNewsletter\Helper;

/**
 * Domain Repositories
 */
final class DomainRepository
{
    /**
     * Api mailgun
     *
     * @var Mailgun\Mailgun
     */
    private $_mailgun;

    /**
     * Construct
     */
    public function __construct(){
        $this->_mailgun = new Mailgun(Helper::get('mailgun.private-key'));
    }

    /**
     * Get lists
     *
     * @return stdClass Lists
     */
    public function getAll(){
        $lists = $this->_mailgun->get('domains');
        return $lists->http_response_body->items;
    }
}
