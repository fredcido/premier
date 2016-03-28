<?php

namespace PremierNewsletter\Repositories;

use PremierNewsletter\Helper;
use PremierNewsletter\Factories\MailgunFactory;

/**
 * Domain Repositories.
 */
final class DomainRepository extends AbstractRepository
{
    /**
     * Api mailgun.
     *
     * @var Mailgun\Mailgun
     */
    private $_mailgun;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->_mailgun = MailgunFactory::create();
    }

    /**
     * Get lists.
     *
     * @return stdClass Lists
     */
    public function getAll()
    {
        $lists = $this->_mailgun->get('domains');

        return $lists->http_response_body->items;
    }
}
