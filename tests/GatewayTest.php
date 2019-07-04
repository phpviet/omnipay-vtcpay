<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Tests;

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\VTCPay\Message\IncomingResponse;
use Omnipay\VTCPay\Message\PurchaseResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class GatewayTest extends GatewayTestCase
{
    /**
     * @var \Omnipay\VTCPay\Gateway
     */
    protected $gateway;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->gateway = Omnipay::create('VTCPay', $this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setWebsiteId(7022);
        $this->gateway->setSecurityCode('TichhopcongthanhtoanVTC2.0');
        $this->gateway->setTestMode(true);
    }

    public function testPurchaseSuccess()
    {
        $response = $this->gateway->purchase([
            'receiver_account' => '0963465816',
            'reference_number' => ($id = microtime(false)),
            'amount' => 50000,
        ])->send();

        $this->assertInstanceOf(RedirectResponseInterface::class, $response);
        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertTrue($response->isRedirect());
        $this->assertFalse($response->isSuccessful());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertEquals($id, $response->getTransactionId());
    }

    public function testPurchaseFailure()
    {
        $this->expectException(InvalidRequestException::class);
        $this->gateway->purchase([
            'receiver_account' => '0963465816',
            'reference_number' => ($id = microtime(false)),
        ])->send();
    }

    public function testCompletePurchaseSuccess()
    {
        $this->getHttpRequest()->query->replace([
            'amount' => 50000,
            'message' => 'Thành công',
            'reference_number' => 123,
            'status' => 1,
            'trans_ref_no' => 789,
            'website_id' => 321,
            'signature' => '247b4714ac85fb2114cb996fa7abfe0414576d9f9602cbcc5221af586d953166',
        ]);
        $response = $this->gateway->completePurchase()->send();

        $this->assertInstanceOf(IncomingResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('789', $response->getTransactionReference());
        $this->assertEquals('123', $response->getTransactionId());
        $this->assertEquals('321', $response->website_id);
    }

    public function testCompletePurchaseFailure()
    {
        $this->expectException(InvalidResponseException::class);
        $this->getHttpRequest()->query->replace([
            'amount' => 50000,
            'message' => 'Thành công',
            'reference_number' => 123,
            'status' => 1,
            'trans_ref_no' => 789,
            'website_id' => 321,
            'signature' => 'abc',
        ]);
        $this->gateway->completePurchase()->send();
    }

    public function testNotificationSuccess()
    {
        $this->getHttpRequest()->request->replace([
            'data' => '50000|Thành công|website|123|1|789|321',
            'signature' => '909481220416ea789d424b33503500fe94ed8193c089a805e73768f2d6a0c95a',
        ]);
        $response = $this->gateway->notification()->send();

        $this->assertInstanceOf(IncomingResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('789', $response->getTransactionReference());
        $this->assertEquals('123', $response->getTransactionId());
        $this->assertEquals('website', $response->payment_type);
    }

    public function testNotificationFailure()
    {
        $this->expectException(InvalidRequestException::class);
        $this->getHttpRequest()->request->replace([
            'data' => '50000|Thành công|website|123|1|789|321',
        ]);
        $this->gateway->notification()->send();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDefaultParametersHaveMatchingMethods()
    {
        parent::testDefaultParametersHaveMatchingMethods();
    }
}
