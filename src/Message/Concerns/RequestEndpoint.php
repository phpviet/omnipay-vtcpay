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
     * Trả về url kết nối VTCPay.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? 'http://alpha1.vtcpay.vn/portalgateway' : 'https://vtcpay.vn/bank-gateway';
    }
}
