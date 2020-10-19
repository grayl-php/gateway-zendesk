<?php

   namespace Grayl\Gateway\Zendesk;

   use Grayl\Gateway\Common\GatewayPorterAbstract;
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
    * @method ZendeskGatewayData getSavedGatewayDataEntity ( string $endpoint_id )
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
      protected string $config_file = 'gateway.zendesk.php';


      /**
       * Creates a new Zendesk object for use in a ZendeskGatewayData entity
       *
       * @param array $credentials An array containing all of the credentials needed to create the gateway API
       *
       * @return ZendeskAPI
       * @throws \Exception
       */
      public function newGatewayAPI ( array $credentials ): object
      {

         // Create the API
         $api = new ZendeskAPI( $credentials[ 'subdomain' ] );

         // Set additional config fields
         $api->setAuth( 'basic',
                        [ 'username' => $credentials[ 'username' ],
                          'token'    => $credentials[ 'token' ], ] );

         // Return the new API entity
         return $api;
      }


      /**
       * Creates a new ZendeskGatewayData entity
       *
       * @param string $endpoint_id The API endpoint ID to use (typically "default" is there is only one API gateway)
       *
       * @return ZendeskGatewayData
       * @throws \Exception
       */
      public function newGatewayDataEntity ( string $endpoint_id ): object
      {

         // Grab the gateway service
         $service = new ZendeskGatewayService();

         // Get an API
         $api = $this->newGatewayAPI( $service->getAPICredentials( $this->config,
                                                                   $this->environment,
                                                                   $endpoint_id ) );

         // Configure the API as needed using the service
         $service->configureAPI( $api,
                                 $this->environment );

         // Return the gateway
         return new ZendeskGatewayData( $api,
                                        $this->config->getConfig( 'name' ),
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