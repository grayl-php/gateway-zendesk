<?php

   namespace Grayl\Gateway\Zendesk\Entity;

   use Grayl\Gateway\Common\Entity\GatewayDataAbstract;
   use Zendesk\API\HttpClient as ZendeskAPI;

   /**
    * Class ZendeskGatewayData
    * The entity for the Zendesk API
    * @method void __construct( ZendeskAPI $api, string $gateway_name, string $environment )
    * @method void setAPI( ZendeskAPI $api )
    * @method ZendeskAPI getAPI()
    *
    * @package Grayl\Gateway\Zendesk
    */
   class ZendeskGatewayData extends GatewayDataAbstract
   {

      /**
       * Fully configured ZendeskAPI entity
       *
       * @var ZendeskAPI
       */
      protected $api;

   }