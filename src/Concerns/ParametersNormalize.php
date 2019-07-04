<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ParametersNormalize
{
    /**
     * Phương thức hổ trợ xóa bỏ các ký tự `_` khi thiết lập các parameters.
     *
     * @param  array  $parameters
     * @return array
     */
    protected function normalizeParameters(array $parameters): array
    {
        $normalizedParameters = [];

        foreach ($parameters as $parameter => $value) {
            $parameter = str_replace('_', '', $parameter);
            $normalizedParameters[$parameter] = $value;
        }

        return $normalizedParameters;
    }
}
