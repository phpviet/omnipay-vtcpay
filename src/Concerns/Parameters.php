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
trait Parameters
{
    /**
     * Trả về mã website.
     *
     * @return null|string
     */
    public function getWebsiteId(): ?string
    {
        return $this->getParameter('website_id');
    }

    /**
     * Thiết lập mã website.
     *
     * @param  null|string  $id
     *
     * @return $this
     */
    public function setWebsiteId(?string $id)
    {
        return $this->setParameter('website_id', $id);
    }

    /**
     * Trả về mã bảo mật.
     *
     * @return null|string
     */
    public function getSecurityCode(): ?string
    {
        return $this->getParameter('security_code');
    }

    /**
     * Thiết lập mã bảo mật dùng để tạo chữ ký dữ liệu.
     *
     * @param  string  $code
     *
     * @return $this
     */
    public function setSecurityCode(?string $code)
    {
        return $this->setParameter('security_code', $code);
    }
}
