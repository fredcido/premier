<?php

namespace PremierNewsletter\Controllers;

use Herbert\Framework\Http;
use Herbert\Framework\Notifier;
use Herbert\Framework\RedirectResponse;
use PremierNewsletter\Repositories\ListRepository;
use PremierNewsletter\Repositories\DomainRepository;


class ListController
{
    /**
     * @var ListRepository
     */
    private $_listRepository;

    /**
     * @var string
     */
    private $_urlList;

    public function __construct()
    {
        $this->_listRepository = new ListRepository();
        $this->_urlList = panel_url('PremierNewsletter::listEmail');
    }

    /**
     * List emails list.
     *
     * @param [type] $id [description]
     *
     * @return [type] [description]
     */
    public function list()
    {
        $data = [
            'lists' => $this->_listRepository->getAll(),
            'label_add' => _('Add New'),
            'list_url' => $this->_urlList,
        ];

        return view('@PremierNewsletter/list-email/list.twig', $data);
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
            'domains' => $domainRepository->getAll(),
            'list_url' => $this->_urlList,
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
            'list_url' => $this->_urlList,
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

        return new RedirectResponse($this->_urlList);
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

        return new RedirectResponse($this->_urlList);
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

        return new RedirectResponse($this->_urlList);
    }
}
