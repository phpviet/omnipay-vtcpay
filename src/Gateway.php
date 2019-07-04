<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\VTCPay\Message\PurchaseRequest;
use Omnipay\VTCPay\Message\NotificationRequest;
use Omnipay\VTCPay\Message\CompletePurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Gateway extends AbstractGateway
{
    use Concerns\Parameters;
    use Concerns\ParametersNormalize;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'VTCPay';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        return parent::initialize(
            $this->normalizeParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Khởi tạo IPN request tiếp nhận từ VTCPay gửi sang.
     *
     * @return \Omnipay\Common\Message\AbstractRequest|NotificationRequest
     */
    public function notification(array $options = []): NotificationRequest
    {
        return $this->createRequest(NotificationRequest::class, $options);
    }
}
