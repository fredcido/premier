<?php

namespace PremierNewsletter\Controllers;

use PremierNewsletter\Repositories\ListRepository;

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
