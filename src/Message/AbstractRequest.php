<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Message;

use Omnipay\VTCPay\Concerns\Parameters;
use Omnipay\VTCPay\Concerns\ParametersNormalize;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Parameters;
    use ParametersNormalize;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        return parent::initialize(
            $this->normalizeParameters($parameters)
        );
    }
}
