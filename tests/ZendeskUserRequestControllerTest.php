<?php

namespace Grayl\Test\Gateway\Zendesk;

use Grayl\Gateway\Zendesk\Controller\ZendeskUpsertUserRequestController;
use Grayl\Gateway\Zendesk\Controller\ZendeskUpsertUserResponseController;
use Grayl\Gateway\Zendesk\Entity\ZendeskGatewayData;
use Grayl\Gateway\Zendesk\ZendeskPorter;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the Zendesk package
 *
 * @package Grayl\Gateway\Zendesk
 */
class ZendeskUpsertUserRequestControllerTest extends
    TestCase
{

    /**
     * Test setup for sandbox environment
     */
    public static function setUpBeforeClass(): void
    {

        // Change the Zendesk API to sandbox mode
        ZendeskPorter::getInstance()
            ->setEnvironment('sandbox');
    }


    /**
     * Tests the creation of a ZendeskGatewayData object
     *
     * @return ZendeskGatewayData
     * @throws \Exception
     */
    public function testCreateZendeskGatewayData(): ZendeskGatewayData
    {

        // Create the object
        $gateway = ZendeskPorter::getInstance()
            ->getSavedGatewayDataEntity(
                'default'
            );

        // Check the type of object returned
        $this->assertInstanceOf(
            ZendeskGatewayData::class,
            $gateway
        );

        // Return the object
        return $gateway;
    }


    /**
     * Tests the creation of a ZendeskUpsertUserRequestController object
     *
     * @return ZendeskUpsertUserRequestController
     * @throws \Exception
     */
    public function testCreateZendeskUpsertUserRequestController(
    ): ZendeskUpsertUserRequestController
    {

        // Set a unique tag
        $tag = "testing_" . $this->generateHash(6);

        // Create the object
        $request = ZendeskPorter::getInstance()
            ->newZendeskUpsertUserRequestController(
                null,
                $tag . '@test.com',
                'Testing ' . $this->generateHash(6),
                [
                    'customer',
                    'test',
                ],
                ['customer' => true]
            );

        // Check the type of object returned
        $this->assertInstanceOf(
            ZendeskUpsertUserRequestController::class,
            $request
        );

        // Return the object
        return $request;
    }


    /**
     * Tests the sending of a ZendeskUpsertUserRequestData through a ZendeskUpsertUserRequestController
     *
     * @param ZendeskUpsertUserRequestController $request A configured ZendeskUpsertUserRequestController entity to use as a gateway
     *
     * @depends testCreateZendeskUpsertUserRequestController
     * @return ZendeskUpsertUserResponseController
     * @throws \Exception
     */
    public function testSendZendeskUpsertUserRequestController(
        ZendeskUpsertUserRequestController $request
    ) {

        // Send the request using the gateway
        $response = $request->sendRequest();

        // Check the type of object returned
        $this->assertInstanceOf(
            ZendeskUpsertUserResponseController::class,
            $response
        );

        // Return the response
        return $response;
    }


    /**
     * Checks a ZendeskUpsertUserResponseController for data and errors
     *
     * @param ZendeskUpsertUserResponseController $response A ZendeskUpsertUserResponseController returned from the gateway
     *
     * @depends  testSendZendeskUpsertUserRequestController
     */
    public function testZendeskResponseController(
        ZendeskUpsertUserResponseController $response
    ): void {

        // Test the data
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getReferenceID());

        // Test the raw data
        $this->assertIsObject($response->getData());
    }


    /**
     * Generates a unique testing hash
     *
     * @param int $length The length of the hash
     *
     * @return string
     */
    private function generateHash(int $length): string
    {

        // Generate a random string
        $hash = openssl_random_pseudo_bytes($length);

        // Convert the binary data into hexadecimal representation and return it
        $hash = strtoupper(bin2hex($hash));

        // Trim to length and return
        return substr(
            $hash,
            0,
            $length
        );
    }

}