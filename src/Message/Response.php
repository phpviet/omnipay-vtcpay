<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 *
 * @copyright (c) PHP Viet
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Response extends AbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return '1' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return '-9' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return $this->data['message'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?string
    {
        return $this->data['status'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): ?string
    {
        return $this->data['reference_number'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['trans_ref_no'] ?? null;
    }
}
