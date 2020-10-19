<?php

   namespace Grayl\Gateway\Zendesk\Controller;

   use Grayl\Gateway\Common\Controller\RequestControllerAbstract;
   use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserRequestData;
   use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserResponseData;

   /**
    * Class ZendeskUpsertUserRequestController
    * The controller for working with ZendeskUpsertUserRequestData entities
    * @method ZendeskUpsertUserRequestData getRequestData()
    * @method ZendeskUpsertUserResponseController sendRequest()
    *
    * @package Grayl\Gateway\Zendesk
    */
   class ZendeskUpsertUserRequestController extends RequestControllerAbstract
   {

      /**
       * Creates a new ZendeskUpsertUserResponseController to handle data returned from the gateway
       *
       * @param ZendeskUpsertUserResponseData $response_data The ZendeskUpsertUserResponseData entity received from the gateway
       *
       * @return ZendeskUpsertUserResponseController
       */
      public function newResponseController ( $response_data ): object
      {

         // Return a new ZendeskUpsertUserResponseController entity
         return new ZendeskUpsertUserResponseController( $response_data,
                                                         $this->response_service );
      }

   }