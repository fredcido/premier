<?php

namespace PremierNewsletter\Factories;

use Mailgun\Mailgun;
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
    public static function create()
    {
        $settingsRepository = new SettingsRepository();
        $settings = $settingsRepository->findFirst();
        return new Mailgun($settings['mailgun_private_key']);
    }
}
