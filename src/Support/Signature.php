<?php
/**
 * @link https://github.com/phpviet/omnipay-vtcpay
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\VTCPay\Support;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Signature
{
    /**
     * Khóa bí mật dùng để tạo và kiểm tra chữ ký dữ liệu.
     *
     * @var string
     */
    protected $secureCode;

    /**
     * Khởi tạo đối tượng Signature.
     *
     * @param  string  $secureCode
     */
    public function __construct(string $secureCode)
    {
        $this->secureCode = $secureCode;
    }

    /**
     * Trả về chữ ký dữ liệu của dữ liệu truyền vào.
     *
     * @param  array  $data
     * @return string
     */
    public function generate(array $data): string
    {
        ksort($data);
        $data[] = $this->secureCode;
        $dataSign = implode('|', $data);

        return strtoupper(hash('sha256', $dataSign));
    }

    /**
     * Kiểm tra tính hợp lệ của chữ ký dữ liệu so với dữ liệu truyền vào.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(array $data, string $expect): bool
    {
        $actual = $this->generate($data);

        return 0 === strcasecmp($expect, $actual);
    }
}
