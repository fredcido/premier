<?php

namespace PremierNewsletter\Repositories;

use PremierNewsletter\Helper;
use PremierNewsletter\Factories\MailgunFactory;

/**
 * List Repositories.
 */
final class ListRepository extends AbstractRepository
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
        $this->_mailgun = MailgunFactory::create(Helper::get('mailgun.private-key'));
    }

    /**
     * Preparate data for update or create.
     *
     * @param array $data Data prepare
     *
     * @return array Formated data
     */
    protected function _prepareData(array $data)
    {
        $dataPrepared = $data;
        $dataPrepared['address'] = $dataPrepared['address'].'@'.$dataPrepared['domain'];
        unset($dataPrepared['domain']);

        return $dataPrepared;
    }

    /**
     * Get lists.
     *
     * @return stdClass Lists
     */
    public function getAll()
    {
        $lists = $this->_mailgun->get('lists');

        return $lists->http_response_body->items;
    }

    /**
     * Get info list mailing.
     *
     * @param string $address Address for find
     *
     * @return sdtClass List Address
     */
    public function findByAddress($address)
    {
        $list = $this->_mailgun->get('lists/'.$address);

        return $list->http_response_body->list;
    }

    /**
     * Create list.
     *
     * @param array $list Array list data
     *
     * @return stdClass Http response body
     */
    public function create(array $list)
    {
        $listPrepared = $this->_prepareData($list);

        $result = $this->_mailgun->post('lists', $listPrepared);
        $response = $result->http_response_body;

        return $response;
    }

    /**
     * Update list.
     *
     * @param string $address Address for update
     * @param array  $list    [description]
     *
     * @return sdtClass [description]
     */
    public function update($address, array $list)
    {
        $listPrepared = $this->_prepareData($list);

        $result = $this->_mailgun->put('lists/'.$address, $listPrepared);
        $response = $result->http_response_body;

        return $response;
    }

    /**
     * Delete list by address.
     *
     * @param string $address Address will delete
     *
     * @return stdClass Reponse
     */
    public function delete($address)
    {
        $result = $this->_mailgun->delete('lists/'.$address);
        $response = $result->http_response_body;

        return $response;
    }
}
