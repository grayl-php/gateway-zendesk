<?php

   namespace Grayl\Gateway\Zendesk;

   use Grayl\Gateway\Common\GatewayPorterAbstract;
   use Grayl\Gateway\Zendesk\Config\ZendeskAPIEndpoint;
   use Grayl\Gateway\Zendesk\Config\ZendeskConfig;
   use Grayl\Gateway\Zendesk\Controller\ZendeskUpsertUserRequestController;
   use Grayl\Gateway\Zendesk\Entity\ZendeskGatewayData;
   use Grayl\Gateway\Zendesk\Entity\ZendeskUpsertUserRequestData;
   use Grayl\Gateway\Zendesk\Service\ZendeskGatewayService;
   use Grayl\Gateway\Zendesk\Service\ZendeskUpsertUserRequestService;
   use Grayl\Gateway\Zendesk\Service\ZendeskUpsertUserResponseService;
   use Grayl\Mixin\Common\Traits\StaticTrait;
   use Zendesk\API\HttpClient as ZendeskAPI;

   /**
    * Front-end for the Zendesk package
    * @method ZendeskGatewayData getSavedGatewayDataEntity ( string $api_endpoint_id )
    *
    * @package Grayl\Gateway\Zendesk
    */
   class ZendeskPorter extends GatewayPorterAbstract
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * The name of the config file for the Zendesk package
       *
       * @var string
       */
      protected string $config_file = 'gateway-zendesk.php';

      /**
       * The ZendeskConfig instance for this gateway
       *
       * @var ZendeskConfig
       */
      protected $config;


      /**
       * Creates a new Zendesk object for use in a ZendeskGatewayData entity
       *
       * @param ZendeskAPIEndpoint $api_endpoint A ZendeskAPIEndpoint with credentials needed to create a gateway API object
       *
       * @return ZendeskAPI
       * @throws \Exception
       */
      public function newGatewayAPI ( $api_endpoint ): object
      {

         // Create the API
         $api = new ZendeskAPI( $api_endpoint->getSubdomain() );

         // Set additional config fields
         $api->setAuth( 'basic',
                        [ 'username' => $api_endpoint->getUsername(),
                          'token'    => $api_endpoint->getToken(), ] );

         // Return the new API entity
         return $api;
      }


      /**
       * Creates a new ZendeskGatewayData entity
       *
       * @param string $api_endpoint_id The API endpoint ID to use (typically "default" if there is only one API gateway)
       *
       * @return ZendeskGatewayData
       * @throws \Exception
       */
      public function newGatewayDataEntity ( string $api_endpoint_id ): object
      {

         // Grab the gateway service
         $service = new ZendeskGatewayService();

         // Get a new API
         $api = $this->newGatewayAPI( $service->getAPIEndpoint( $this->config,
                                                                $this->environment,
                                                                $api_endpoint_id ) );

         // Configure the API as needed using the service
         $service->configureAPI( $api,
                                 $this->environment );

         // Return the gateway
         return new ZendeskGatewayData( $api,
                                        $this->config->getGatewayName(),
                                        $this->environment );
      }


      /**
       * Creates a new ZendeskUpsertUserRequestController entity
       *
       * @param ?string $user_id       The Zendesk ID of this user
       * @param string  $email_address The email address of the user
       * @param string  $name          The name of the user
       * @param array   $tags          A set of tags that apply to this user
       * @param array   $user_fields   The associative array of custom field values to set for this user
       *
       * @return ZendeskUpsertUserRequestController
       * @throws \Exception
       */
      public function newZendeskUpsertUserRequestController ( ?string $user_id,
                                                              string $email_address,
                                                              string $name,
                                                              array $tags,
                                                              array $user_fields ): ZendeskUpsertUserRequestController
      {

         // Create a new ZendeskUpsertUserRequestData entity
         $request_data = new ZendeskUpsertUserRequestData( 'create_or_update',
                                                           $user_id,
                                                           $email_address,
                                                           $name,
                                                           $tags,
                                                           $user_fields );

         // Return a new ZendeskUpsertUserRequestController entity
         return new ZendeskUpsertUserRequestController( $this->getSavedGatewayDataEntity( 'default' ),
                                                        $request_data,
                                                        new ZendeskUpsertUserRequestService(),
                                                        new ZendeskUpsertUserResponseService() );
      }

   }