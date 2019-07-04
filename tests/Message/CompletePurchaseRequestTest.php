<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\VTCPay\Message\CompletePurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $request->query->replace([
            'amount' => 50000,
            'message' => 'Thành công',
            'reference_number' => 123,
            'status' => 1,
            'trans_ref_no' => 789,
            'website_id' => 321,
            'signature' => '247b4714ac85fb2114cb996fa7abfe0414576d9f9602cbcc5221af586d953166',
        ]);
        $this->request = new CompletePurchaseRequest($client, $request);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(7, count($data));
        $this->assertEquals(50000, $data['amount']);
        $this->assertEquals('Thành công', $data['message']);
        $this->assertEquals(123, $data['reference_number']);
        $this->assertEquals(1, $data['status']);
        $this->assertEquals(789, $data['trans_ref_no']);
        $this->assertEquals(321, $data['website_id']);
        $this->assertEquals('247b4714ac85fb2114cb996fa7abfe0414576d9f9602cbcc5221af586d953166', $data['signature']);
    }
}
