<?php

   namespace Grayl\Gateway\Zendesk\Config;

   use Grayl\Gateway\Common\Config\GatewayAPIEndpointAbstract;

   /**
    * Class ZendeskAPIEndpoint
    * The class of a single Zendesk API endpoint
    *
    * @package Grayl\Gateway\Zendesk
    */
   class ZendeskAPIEndpoint extends GatewayAPIEndpointAbstract
   {

      /**
       * The Zendesk subdomain
       *
       * @var string
       */
      protected string $subdomain;

      /**
       * The Zendesk username
       *
       * @var string
       */
      protected string $username;

      /**
       * The Zendesk token for communicating with the API
       *
       * @var string
       */
      protected string $token;


      /**
       * Class constructor
       *
       * @param string $api_endpoint_id The ID of this API endpoint (default, provision, etc.)
       * @param string $subdomain       The Zendesk subdomain to set
       * @param string $username        The Zendesk username to set
       * @param string $token           The Zendesk token for communicating with the API
       */
      public function __construct ( string $api_endpoint_id,
                                    string $subdomain,
                                    string $username,
                                    string $token )
      {

         // Call the parent constructor
         parent::__construct( $api_endpoint_id );

         // Set the class data
         $this->setSubdomain( $subdomain );
         $this->setUsername( $username );
         $this->setToken( $token );
      }


      /**
       * Get the subdomain
       *
       * @return string
       */
      public function getSubdomain (): string
      {

         // Return it
         return $this->subdomain;
      }


      /**
       * Set the subdomain
       *
       * @param string $subdomain The Zendesk subdomain to set
       */
      public function setSubdomain ( string $subdomain ): void
      {

         // Set the subdomain
         $this->subdomain = $subdomain;
      }


      /**
       * Get the username
       *
       * @return string
       */
      public function getUsername (): string
      {

         // Return it
         return $this->username;
      }


      /**
       * Set the username
       *
       * @param string $username The Zendesk username to set
       */
      public function setUsername ( string $username ): void
      {

         // Set the username
         $this->username = $username;
      }


      /**
       * Gets the Zendesk token
       *
       * @return string
       */
      public function getToken (): string
      {

         // Return it
         return $this->token;
      }


      /**
       * Sets the Zendesk token
       *
       * @param string $token The Zendesk token for communicating with the API
       */
      public function setToken ( string $token ): void
      {

         // Set the token
         $this->token = $token;
      }

   }