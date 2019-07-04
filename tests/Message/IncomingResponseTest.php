<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\VTCPay\Message\IncomingResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class IncomingResponseTest extends TestCase
{
    /**
     * @var array
     */
    protected $options = [
        'amount' => 50000,
        'message' => 'Thành công',
        'reference_number' => 123,
        'status' => 1,
        'trans_ref_no' => 789,
        'website_id' => 321,
        'signature' => '247b4714ac85fb2114cb996fa7abfe0414576d9f9602cbcc5221af586d953166',
    ];

    public function testConstruct()
    {
        $response = new IncomingResponse($this->getMockRequest(), $this->options);
        $this->assertEquals($this->options, $response->getData());
    }

    public function testIncoming()
    {
        $response = new IncomingResponse($this->getMockRequest(), [
            'amount' => 50000,
            'message' => 'Thành công',
            'reference_number' => 123,
            'status' => 1,
            'trans_ref_no' => 789,
            'website_id' => 321,
            'signature' => '247b4714ac85fb2114cb996fa7abfe0414576d9f9602cbcc5221af586d953166',
        ]);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('123', $response->getTransactionId());
        $this->assertEquals('789', $response->getTransactionReference());
        $this->assertEquals('Thành công', $response->getMessage());
        $this->assertEquals('321', $response->website_id);
        $this->assertEquals('123', $response->reference_number);
        $this->assertEquals('123', $response->reference_number);
    }

    public function getMockRequest()
    {
        $request = parent::getMockRequest();
        $request->shouldReceive('getSecurityCode')->once()->andReturn('TichhopcongthanhtoanVTC2.0');

        return $request;
    }
}
