<?php

namespace Grayl\Gateway\Zendesk\Entity;

use Grayl\Gateway\Common\Entity\ResponseDataAbstract;

/**
 * Class ZendeskUpsertUserResponseData
 * The class for working with a user response from the Zendesk gateway
 * @method void setAPIResponse(object $api_response)
 * @method object getAPIResponse()
 *
 * @package Grayl\Gateway\Zendesk
 */
class ZendeskUpsertUserResponseData extends
    ResponseDataAbstract
{

    /**
     * The raw API response entity from the gateway
     *
     * @var object
     */
    protected $api_response;

}