<?php

namespace Grayl\Gateway\Zendesk\Controller;

use Grayl\Gateway\Common\Controller\ResponseControllerAbstract;
use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
use Grayl\Gateway\Common\Service\ResponseServiceInterface;
use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserResponseData;
use Grayl\Gateway\Zendesk\Service\ZendeskUpsertUserResponseService;

/**
 * Class ZendeskUpsertUserResponseController
 * The controller for working with ZendeskUpsertUserResponseData entities
 *
 * @package Grayl\Gateway\Zendesk
 */
class ZendeskUpsertUserResponseController extends
    ResponseControllerAbstract
{

    /**
     * The ZendeskUpsertUserResponseData object that holds the gateway API response
     *
     * @var ZendeskUpsertUserResponseData
     */
    protected ResponseDataAbstract $response_data;

    /**
     * The ZendeskUpsertUserResponseService entity to use
     *
     * @var ZendeskUpsertUserResponseService
     */
    protected ResponseServiceInterface $response_service;

}