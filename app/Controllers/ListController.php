<?php

namespace PremierNewsletter\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\Notifier;
use Herbert\Framework\RedirectResponse;
use PremierNewsletter\Repositories\ListRepository;
use PremierNewsletter\Repositories\DomainRepository;
use PremierNewsletter\Grids\ListGrid;

final class ListController extends AbstractController
{
    /**
     * @var ListRepository
     */
    private $_listRepository;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->_listRepository = new ListRepository();
        $this->setPanelUrl(panel_url('PremierNewsletter::listPanel'));
    }

    /**
     * List emails list.
     *
     * @param [type] $id [description]
     *
     * @return [type] [description]
     */
    public function index()
    {


        $option = 'per_page';
    	$args   = [
    		'label'   => 'Customers',
    		'default' => 5,
    		'option'  => 'customers_per_page'
    	];

    	add_screen_option( $option, $args );

        $exampleListTable = new ListGrid();
        

        $data = [
            'lists'     => $this->_listRepository->getAll(),
            'label_add' => esc_html_x('Add New', 'premier'),
            'panel_url' => $this->getPanelUrl(),
            'grid' => $exampleListTable->list_table_page()
        ];

        return view('@PremierNewsletter/list-email/index.twig', $data);
    }

    /**
     * Email form new and update.
     *
     * @param [type] $id [description]
     *
     * @return [type] [description]
     */
    public function form(Http $http)
    {
        $domainRepository = new DomainRepository();
        $address = $http->get('address');

        $data = [
            'domains'   => $domainRepository->getAll(),
            'panel_url' => $this->getPanelUrl(),
        ];

        // Edit
        if (!empty($address)) {
            $data['list'] = $this->_listRepository->findByAddress($address);
        }

        return view('@PremierNewsletter/list-email/form.twig', $data);
    }

    /**
     * Confirm delete list.
     *
     * @param Http $http [description]
     *
     * @return [type] [description]
     */
    public function confirmDelete(Http $http)
    {
        $data = [
            'addresses' => $http->get('addresses'),
            'panel_url' => $this->getPanelUrl(),
        ];

        return view('@PremierNewsletter/list-email/confirm-delete.twig', $data);
    }

    /**
     * Create email list.
     *
     * @param Http $http [description]
     *
     * @return [type] [description]
     */
    public function create(Http $http)
    {
        $response = $this->_listRepository->create($http->all());
        Notifier::success($response->message, true);

        return new RedirectResponse($this->getPanelUrl());
    }

    /**
     * [delete description].
     *
     * @param Http $http [description]
     *
     * @return [type] [description]
     */
    public function delete(Http $http)
    {
        $addresses = $http->get('addresses');

        foreach ($addresses as $address) {
            $response = $this->_listRepository->delete($address);
            Notifier::success($response->message, true);
        }

        return new RedirectResponse($this->getPanelUrl());
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
        $response = $this->_listRepository->update($http->get('address'), $http->all());
        Notifier::success($response->message, true);

        return new RedirectResponse($this->getPanelUrl());
    }
}
