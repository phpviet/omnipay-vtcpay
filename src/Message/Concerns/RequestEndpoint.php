<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Message\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{
    /**
     * Đường dẫn kết nối đến VTCPay để test.
     *
     * @var string
     */
    protected $testEndPoint;

    /**
     * Đường dẫn kết nối đến VTCPay ở môi trường production.
     *
     * @var string
     */
    protected $productionEndpoint;

    /**
     * Trả về url kết nối MoMo.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndPoint : $this->productionEndpoint;
    }
}
