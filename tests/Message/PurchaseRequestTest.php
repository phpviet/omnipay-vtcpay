<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\VTCPay\Message\PurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PurchaseRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setSecurityCode(1);
        $this->request->setWebsiteId(2);
        $this->request->setReceiverAccount(3);
        $this->request->setCurrency(4);
        $this->request->setReturnUrl(5);
        $this->request->setBillToAddress(6);
        $this->request->setBillToAddressCity(7);
        $this->request->setBillToEmail(8);
        $this->request->setBillToForename(9);
        $this->request->setBillToSurname(10);
        $this->request->setBillToPhone(11);
        $this->request->setAmount(12);
        $this->request->setReferenceNumber(13);
        $this->request->setTestMode(true);
        $data = $this->request->getData();
        $this->assertEquals(13, count($data));
        $this->assertEquals(2, $data['website_id']);
        $this->assertEquals(3, $data['receiver_account']);
        $this->assertEquals(4, $data['currency']);
        $this->assertEquals(5, $data['url_return']);
        $this->assertEquals(6, $data['bill_to_address']);
        $this->assertEquals(7, $data['bill_to_address_city']);
        $this->assertEquals(8, $data['bill_to_email']);
        $this->assertEquals(9, $data['bill_to_forename']);
        $this->assertEquals(10, $data['bill_to_surname']);
        $this->assertEquals(11, $data['bill_to_phone']);
        $this->assertEquals(12, $data['amount']);
        $this->assertEquals(13, $data['reference_number']);
        $this->assertFalse(isset($data['security_code']));
    }
}
