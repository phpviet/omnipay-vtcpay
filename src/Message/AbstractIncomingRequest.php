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
abstract class AbstractIncomingRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        foreach ($this->getIncomingParameters() as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('signature');

        return $this->getIncomingParameters();
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): IncomingResponse
    {
        return $this->response = new IncomingResponse($this, $data);
    }

    /**
     * Trả về danh sách parameters từ VTCPay gửi sang.
     *
     * @return array
     */
    abstract protected function getIncomingParameters(): array;
}
