<?php

namespace PremierNewsletter\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\Notifier;
use Herbert\Framework\RedirectResponse;
use PremierNewsletter\Repositories\ListRepository;
use PremierNewsletter\Repositories\DomainRepository;

class SettingsController extends AbstractController
{
    /**
     * @var ListRepository
     */
    private $_listRepository;

    public function __construct()
    {
        $this->_listRepository = new ListRepository();
        $this->setPanelUrl(panel_url('PremierNewsletter::settingsPanel'));
    }

    public function form()
    {
        $data = [
            'label_add' => _('Add New'),
            'panel_url' => $this->getPanelUrl(),
        ];

        return view('@PremierNewsletter/settings/form.twig', $data);
    }
}
