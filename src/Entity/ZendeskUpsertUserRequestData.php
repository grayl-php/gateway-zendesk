<?php

   namespace Grayl\Gateway\Zendesk\Entity;

   use Grayl\Gateway\Common\Entity\RequestDataAbstract;
   use Grayl\Mixin\Common\Entity\FlatDataBag;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class ZendeskUpsertUserRequestData
    * The entity for a user create/modify request to Zendesk
    *
    * @package Grayl\Gateway\Zendesk
    */
   class ZendeskUpsertUserRequestData extends RequestDataAbstract
   {

      /**
       * The Zendesk ID of this user
       *
       * @var ?string
       */
      private ?string $user_id;

      /**
       * The email address of the user
       *
       * @var string
       */
      private string $email_address;

      /**
       * The name of the user
       *
       * @var string
       */
      private string $name;

      /**
       * A set of tags that apply to this user
       *
       * @var FlatDataBag
       */
      private FlatDataBag $tags;

      /**
       * A set of custom field values to set for this user
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $user_fields;


      /**
       * Class constructor
       *
       * @param string  $action        The action performed in this response (send, etc.)
       * @param ?string $user_id       The Zendesk ID of this user
       * @param string  $email_address The email address of the user
       * @param string  $name          The name of the user
       * @param array   $tags          A set of tags that apply to this user
       * @param array   $user_fields   The associative array of custom field values to set for this user
       */
      public function __construct ( string $action,
                                    ?string $user_id,
                                    string $email_address,
                                    string $name,
                                    array $tags,
                                    array $user_fields )
      {

         // Call the parent constructor
         parent::__construct( $action );

         // Create the bags
         $this->tags        = new FlatDataBag();
         $this->user_fields = new KeyedDataBag();

         // Set the entity data
         $this->setUserID( $user_id );
         $this->setEmailAddress( $email_address );
         $this->setName( $name );
         $this->addTags( $tags );
         $this->setUserFields( $user_fields );
      }


      /**
       * Gets the user ID
       *
       * @return string
       */
      public function getUserID (): ?string
      {

         // Return the user ID
         return $this->user_id;
      }


      /**
       * Sets the user ID
       *
       * @param ?string $user_id The Zendesk user ID
       */
      public function setUserID ( ?string $user_id ): void
      {

         // Set the user ID
         $this->user_id = $user_id;
      }


      /**
       * Gets the email address of the user
       *
       * @return ?string
       */
      public function getEmailAddress (): string
      {

         // Return the email
         return $this->email_address;
      }


      /**
       * Sets the email address of the user
       *
       * @param string $email_address Full email address of the user
       */
      public function setEmailAddress ( string $email_address ): void
      {

         // Set the email
         $this->email_address = $email_address;
      }


      /**
       * Gets the user's name
       *
       * @return string
       */
      public function getName (): string
      {

         // Return the name
         return $this->name;
      }


      /**
       * Sets the user's name
       *
       * @param string $name The name of the user
       */
      public function setName ( string $name ): void
      {

         // Set the name
         $this->name = $name;
      }


      /**
       * Gets the array of tags
       *
       * @return array
       */
      public function getTags (): array
      {

         // Return the array of tags
         return $this->tags->getPieces();
      }


      /**
       * Adds a new tag to the user
       *
       * @param string $tag The tag to add to the user
       */
      public function addTag ( string $tag ): void
      {

         // Add the tag
         $this->tags->putPiece( $tag );
      }


      /**
       * Adds multiple tags to the user
       *
       * @param string[] $tags The tags to add to the user
       */
      public function addTags ( array $tags ): void
      {

         // Add the tags
         $this->tags->putPieces( $tags );
      }


      /**
       * Sets a single user field
       *
       * @param string $key   The key name for the user field
       * @param mixed  $value The value of the user field
       */
      public function setUserField ( string $key,
                                     ?string $value ): void
      {

         // Set the user field
         $this->user_fields->setVariable( $key,
                                          $value );
      }


      /**
       * Retrieves the value of a stored user field
       *
       * @param string $key The key name for the user field
       *
       * @return mixed
       */
      public function getUserField ( string $key )
      {

         // Return the value
         return $this->user_fields->getVariable( $key );
      }


      /**
       * Sets multiple user fields using a passed array
       *
       * @param array $user_fields The associative array of user fields to set ( key => value )
       */
      public function setUserFields ( array $user_fields ): void
      {

         // Set the user fields
         $this->user_fields->setVariables( $user_fields );
      }


      /**
       * Retrieves the entire array of user fields
       *
       * @return array
       */
      public function getUserFields (): array
      {

         // Return all user fields
         return $this->user_fields->getVariables();
      }

   }