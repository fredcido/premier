<?php

namespace PremierNewsletter\Factories;

use Mailgun\Mailgun;

final class MailgunFactory
{
    /**
     * Factory mailgun.
     *
     * @param string $privateKey App key
     *
     * @return Mailgun\Mailgun Object mailgun
     */
    public static function create($privateKey)
    {
        return new Mailgun($privateKey);
    }
}
