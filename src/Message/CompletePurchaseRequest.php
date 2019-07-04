<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Message;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseRequest extends AbstractIncomingRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'reference_number', 'status', 'website_id');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        return $this->httpRequest->query->all();
    }
}
