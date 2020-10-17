<?php

namespace Grayl\Gateway\Zendesk\Service;

use Grayl\Gateway\Common\Service\RequestServiceInterface;
use Grayl\Gateway\Zendesk\Entity\ZendeskGatewayData;
use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserRequestData;
use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserResponseData;

/**
 * Class ZendeskUpsertUserRequestService
 * The service for working with Zendesk API user requests
 *
 * @package Grayl\Gateway\Zendesk
 */
class ZendeskUpsertUserRequestService implements
    RequestServiceInterface
{

    /**
     * Sends a ZendeskUpsertUserRequestData object to the Zendesk gateway and returns a response
     *
     * @param ZendeskGatewayData           $gateway_data A configured ZendeskGatewayData entity to send the request through
     * @param ZendeskUpsertUserRequestData $request_data The ZendeskUpsertUserRequestData entity to send
     *
     * @return ZendeskUpsertUserResponseData
     * @throws \Exception
     */
    public function sendRequestDataEntity(
        $gateway_data,
        $request_data
    ): object {

        // Get the parameters
        $parameters = $this->translateZendeskUpsertUserRequest($request_data);

        // Build the request
        $api_request = $gateway_data->getAPI();

        // Send the request
        $response = $api_request->users()
            ->createOrUpdate($parameters);

        // Return a new response entity with the action specified
        return $this->newResponseDataEntity(
            $response,
            $gateway_data->getGatewayName(),
            'create_or_update',
            []
        );
    }


    /**
     * Creates a new ZendeskUpsertUserResponseData object to handle data returned from the gateway
     *
     * @param object   $api_response The response object received directly from a gateway
     * @param string   $gateway_name The name of the gateway
     * @param string   $action       The action performed in this response (send, sendTemplate, etc.)
     * @param string[] $metadata     Extra data associated with this response
     *
     * @return ZendeskUpsertUserResponseData
     */
    public function newResponseDataEntity(
        $api_response,
        string $gateway_name,
        string $action,
        array $metadata
    ): object {

        // Return a new ZendeskUpsertUserResponseData entity
        return new ZendeskUpsertUserResponseData(
            $api_response,
            $gateway_name,
            $action
        );
    }


    /**
     * Translates a ZendeskUpsertUserRequestData into the proper field format required by the API
     *
     * @param ZendeskUpsertUserRequestData $request_data A ZendeskUpsertUserRequestData entity to translate from
     *
     * @return array
     */
    private function translateZendeskUpsertUserRequest(
        ZendeskUpsertUserRequestData $request_data
    ): array {

        // Create the return array
        $parameters = [];

        // Standard fields
        $parameters['id']    = $request_data->getUserID();
        $parameters['email'] = $request_data->getEmailAddress();
        $parameters['name']  = $request_data->getName();
        $parameters['role']  = 'end-user';

        // Tags
        $parameters['tags'] = $request_data->getTags();

        // User fields
        $parameters['user_fields'] = $request_data->getUserFields();

        // Return the array of parameters
        return $parameters;
    }

}