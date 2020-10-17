<?php

namespace Grayl\Gateway\Zendesk\Service;

use Grayl\Gateway\Common\Service\ResponseServiceInterface;
use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserResponseData;

/**
 * Class ZendeskUpsertUserResponseService
 * The service for working with Zendesk API user responses
 *
 * @package Grayl\Gateway\Zendesk
 */
class ZendeskUpsertUserResponseService implements
    ResponseServiceInterface
{

    /**
     * Returns a true / false value based on a gateway API response
     *
     * @param ZendeskUpsertUserResponseData $response_data The response object to check
     *
     * @return bool
     */
    public function isSuccessful($response_data): bool
    {

        // For a successful response
        if ( ! empty(
            $response_data->getAPIResponse()
            && $this->getReferenceID(
                $response_data
            )
        )
        ) {
            // Success
            return true;
        }

        // Failure
        return false;
    }


    /**
     * Returns the reference ID from a gateway API response
     *
     * @param ZendeskUpsertUserResponseData $response_data The response object to pull the reference ID from
     *
     * @return string
     */
    public function getReferenceID($response_data): ?string
    {

        // Get the user ID field from the body
        return $response_data->getAPIResponse()->user->id;
    }


    /**
     * Returns the status message from a gateway API response
     *
     * @param ZendeskUpsertUserResponseData $response_data The response object to get the message from
     *
     * @return string
     */
    public function getMessage($response_data): ?string
    {

        // Not used
        return null;
    }


    /**
     * Returns the raw data from a gateway API response
     *
     * @param ZendeskUpsertUserResponseData $response_data The response object to get the data from
     *
     * @return object
     */
    public function getData($response_data): object
    {

        // Return the raw object response
        return $response_data->getAPIResponse();
    }

}