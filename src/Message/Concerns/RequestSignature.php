<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Message\Concerns;

use Omnipay\VTCPay\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestSignature
{
    /**
     * Trả về chữ ký điện tử gửi đến OnePay dựa theo [[getSignatureParameters()]].
     *
     * @return string
     */
    protected function generateSignature(): string
    {
        $signature = new Signature(
            $this->getSecurityCode()
        );

        return $signature->generate(
            $this->getParameters()
        );
    }
}