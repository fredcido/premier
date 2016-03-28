<?php

namespace PremierNewsletter\Controllers;

use PremierNewsletter\Repositories\SettingsRepository;
use Herbert\Framework\Http;
use Herbert\Framework\Notifier;
use Herbert\Framework\RedirectResponse;

class SettingsController extends AbstractController
{
    /**
     * @var SettingsRepository
     */
    private $_settingsRepository;

    public function __construct()
    {
        $this->_settingsRepository = new SettingsRepository();
        $this->setPanelUrl(panel_url('PremierNewsletter::settingsPanel'));
    }

    public function form()
    {
        $data = [
            'panel_url' => $this->getPanelUrl(),
            'settings' => $this->_settingsRepository->findFirst(),
        ];

        return view('@PremierNewsletter/settings/form.twig', $data);
    }

    /**
     * Update email list.
     *
     * @param Http $http [description]
     *
     * @return [type] [description]
     */
    public function update(Http $http)
    {
        $response = $this->_settingsRepository->update($http->get('settings_id'), $http->all());
        Notifier::notify($response['message'], $response['class'], true);

        return new RedirectResponse($this->getPanelUrl());
    }
}
