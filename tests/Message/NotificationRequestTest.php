<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\VTCPay\Message\NotificationRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class NotificationRequestTest extends TestCase
{
    /**
     * @var NotificationRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $request->request->replace([
            'data' => '50000|Thành công|website|123|1|789|321',
            'signature' => '909481220416ea789d424b33503500fe94ed8193c089a805e73768f2d6a0c95a',
        ]);
        $this->request = new NotificationRequest($client, $request);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(2, count($data));
        $this->assertEquals('50000|Thành công|website|123|1|789|321', $data['data']);
        $this->assertEquals('909481220416ea789d424b33503500fe94ed8193c089a805e73768f2d6a0c95a', $data['signature']);
    }
}
