<?php

namespace PremierNewsletter\Repositories;

use PremierNewsletter\Helper;
use PremierNewsletter\Factories\MailgunFactory;
use PremierNewsletter\Widgets;

final class SubscribeRepository extends AbstractRepository
{

    public function subscribe(array $data)
    {
        $this->_mailgun = MailgunFactory::create();

        $widget = new Widgets\Subscribe();
        $widgetSettings = $widget->getSettings();

        var_dump($widgetSettings);exit;

        /*
        $result = $this->_mailgunPublic->get('address/validate', array('address' => $data['email']));

        if ($result->http_response_body->is_valid != true) {
            return $this->configNotifier('Invalid e-mail address!', self::NOTIFIER_CLASS_ERROR);
        }*/

        $secretPassphrase = Helper::prefix(uniqid(time()));

        $optInHandler = $this->_mailgun->OptInHandler();
        $generatedHash = $optInHandler->generateHash($widgetSettings['list'], $secretPassphrase, $data['email']);

        $mg->sendMessage(
                $domain, 
                array(
                    'from'    => $widgetSettings['sender'], 
                    'to'      => $data['email'],
                    'subject' => $widgetSettings['subject'], 
                    'html'    => herbert('twig')->render('@PremierNewsletter/subscribe/email.twig', $context)
                )
        );

        return $this->configNotifier('An e-mail was sent to your account, please check.', self::NOTIFIER_CLASS_SUCCESS);
    }

}