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
class NotificationRequest extends AbstractIncomingRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('data');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): IncomingResponse
    {
        $signature = $data['signature'];
        $dataNormalized = explode('|', $data['data']);
        [$amount, $message, $payment_type, $reference_number, $status, $trans_ref_no, $website_id] = $dataNormalized;
        $data = compact(
            'amount', 'message', 'payment_type', 'reference_number', 'status', 'trans_ref_no', 'website_id'
        );
        $data['signature'] = $signature;

        return parent::sendData($data);
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        return $this->httpRequest->request->all();
    }
}
