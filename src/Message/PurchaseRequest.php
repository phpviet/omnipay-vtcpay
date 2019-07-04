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
class PurchaseRequest extends AbstractRequest
{
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->setCurrency(
            $this->getCurrency() ?? 'VND'
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('currency', 'receiver_account', 'reference_number', 'website_id', 'amount');
        $validParameters = $this->getSignatureParameters();
        $data = array_filter($this->getParameters(), function ($parameter) use ($validParameters) {
            return in_array($parameter, $validParameters, true);
        }, ARRAY_FILTER_USE_KEY);
        $data['signature'] = $this->generateSignature();

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): PurchaseResponse
    {
        $redirectUrl = $this->getEndpoint().'/checkout.html?'.http_build_query($data);

        return $this->response = new PurchaseResponse($this, $data, $redirectUrl);
    }

    /**
     * Trả về tài khoản nhận tiền.
     *
     * @return null|string
     */
    public function getReceiverAccount(): ?string
    {
        return $this->getParameter('receiver_account');
    }

    /**
     * Thiết lập tài khoản nhận tiền.
     *
     * @param  null|string  $account
     *
     * @return $this
     */
    public function setReceiverAccount(?string $account)
    {
        return $this->setParameter('receiver_account', $account);
    }

    /**
     * Trả về mã đơn hàng.
     * Ánh xạ của [[getTransactionId()]].
     *
     * @return null|string
     * @see getTransactionId
     */
    public function getReferenceNumber(): ?string
    {
        return $this->getTransactionId();
    }

    /**
     * Thiết lập mã đơn hàng.
     * Ánh xạ của [[setTransactionId()]].
     *
     * @param  null|string  $number
     * @return $this
     * @see setTransactionId
     */
    public function setReferenceNumber(?string $number)
    {
        return $this->setTransactionId($number);
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): ?string
    {
        return $this->getParameter('reference_number');
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionId($value)
    {
        return $this->setParameter('reference_number', $value);
    }

    /**
     * Get value of the url_return parameter
     * Ánh xạ của [[getReturnUrl()]].
     *
     * @return null|string
     * @see getReturnUrl
     */
    public function getUrlReturn(): ?string
    {
        return $this->getReturnUrl();
    }

    /**
     * Set value of the url_return parameter
     * Ánh xạ của [[setReturnUrl()]].
     *
     * @param  string  $value
     * @return $this
     * @see setReturnUrl
     */
    public function setUrlReturn($value)
    {
        return $this->setReturnUrl($value);
    }

    /**
     * Get the request return URL.
     *
     * @return null|string
     */
    public function getReturnUrl(): ?string
    {
        return $this->getParameter('url_return');
    }

    /**
     * Sets the request return URL.
     *
     * @param  string  $value
     * @return $this
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('url_return', $value);
    }

    /**
     * Trả về ngôn ngữ của giao diện thanh toán.
     *
     * @return null|string
     */
    public function getLanguage(): ?string
    {
        return $this->getParameter('language');
    }

    /**
     * Thiết lập ngôn ngữ của giao diện thanh toán.
     *
     * @param  null|string  $language
     * @return $this
     */
    public function setLanguage(?string $language)
    {
        return $this->setParameter('language', $language);
    }

    /**
     * Trả về hình thức thanh toán.
     *
     * @return null|string
     */
    public function getPaymentType(): ?string
    {
        return $this->getParameter('payment_type');
    }

    /**
     * Thiết lập hình thức thanh toán.
     *
     * @param  null|string  $type
     * @return $this
     */
    public function setPaymentType(?string $type)
    {
        return $this->setParameter('payment_type', $type);
    }

    /**
     * Trả về tên chủ đơn hàng.
     *
     * @return null|string
     */
    public function getBillToForename(): ?string
    {
        return $this->getParameter('bill_to_forename');
    }

    /**
     * Thiết lập tên chủ đơn hàng.
     *
     * @param  null|string  $forename
     * @return $this
     */
    public function setBillToForename(?string $forename)
    {
        return $this->setParameter('bill_to_forename', $forename);
    }

    /**
     * Trả về tên chủ đơn hàng.
     *
     * @return null|string
     */
    public function getBillToSurname(): ?string
    {
        return $this->getParameter('bill_to_surname');
    }

    /**
     * Thiết lập tên chủ đơn hàng.
     *
     * @param  null|string  $surname
     * @return $this
     */
    public function setBillToSurname(?string $surname)
    {
        return $this->setParameter('bill_to_surname', $surname);
    }

    /**
     * Trả về địa chỉ giao hàng.
     *
     * @return null|string
     */
    public function getBillToAddress(): ?string
    {
        return $this->getParameter('bill_to_address');
    }

    /**
     * Thiết lập địa chỉ giao hàng.
     *
     * @param  null|string  $address
     * @return $this
     */
    public function setBillToAddress($address)
    {
        return $this->setParameter('bill_to_address', $address);
    }

    /**
     * Trả về tỉnh, thành phố giao hàng.
     *
     * @return null|string
     */
    public function getBillToAddressCity(): ?string
    {
        return $this->getParameter('bill_to_address_city');
    }

    /**
     * Thiết lập tỉnh, thành phố giao hàng.
     *
     * @param  null|string  $city
     * @return $this
     */
    public function setBillToAddressCity(?string $city)
    {
        return $this->setParameter('bill_to_address_city', $city);
    }

    /**
     * Trả về email người mua hàng.
     *
     * @return null|string
     */
    public function getBillToEmail(): ?string
    {
        return $this->getParameter('bill_to_email');
    }

    /**
     * Thiết lập email người mua hàng.
     *
     * @param  null|string  $email
     * @return $this
     */
    public function setBillToEmail($email)
    {
        return $this->setParameter('bill_to_email', $email);
    }

    /**
     * Trả về số điện thoại người mua hàng.
     *
     * @return null|string
     */
    public function getBillToPhone(): ?string
    {
        return $this->getParameter('bill_to_phone');
    }

    /**
     * Thiết lập số điện thoại người mua hàng.
     *
     * @param  null|string  $number
     * @return $this
     */
    public function setBillToPhone(?string $number)
    {
        return $this->setParameter('bill_to_phone', $number);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        $parameters = $this->getParameters();
        unset($parameters['testMode'], $parameters['security_code']);

        return array_keys($parameters);
    }
}
