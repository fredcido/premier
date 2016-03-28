<?php

namespace PremierNewsletter\Factories;

use Mailgun\Mailgun;
use Mailgun\Connection\Exceptions\InvalidCredentials;
use Herbert\Framework\Notifier;
use Herbert\Framework\RedirectResponse;

use PremierNewsletter\Repositories\SettingsRepository;

final class MailgunFactory
{
    /**
     * Factory mailgun.
     *
     * @param string $privateKey App key
     *
     * @return Mailgun\Mailgun Object mailgun
     */
    public static function create($key = null)
    {
        try {
            $key = empty($key) ? 'mailgun_private_key' : $key;

            $settingsRepository = new SettingsRepository();
            $mailgun = new Mailgun($settingsRepository->get($key));

            $result = $mailgun->get("domains", array('limit' => 5, 'skip' => 10));

            return $mailgun;

        } catch (InvalidCredentials $e ) {

            $link = panel_url('PremierNewsletter::settingsPanel'); 

            $message = sprintf('You need to define your mail credentials. <a href="%s">Click here</a> to define them', $link);
            Notifier::error( $message );

            throw $e;
        }
    }
}
