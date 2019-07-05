<p align="center">
    <a href="https://vtcpay.vn" target="_blank">
        <img src="https://raw.githubusercontent.com/phpviet/omnipay-vtcpay/master/resources/logo.png" height="100px">
    </a>
    <h1 align="center">Omnipay: VTCPay</h1>
    <br>
    <p align="center">
    <a href="https://packagist.org/packages/phpviet/omnipay-vtcpay"><img src="https://img.shields.io/packagist/v/phpviet/omnipay-vtcpay.svg?style=flat-square" alt="Latest version"></a>
    <a href="https://travis-ci.org/phpviet/omnipay-vtcpay"><img src="https://img.shields.io/travis/phpviet/omnipay-vtcpay/master.svg?style=flat-square" alt="Build status"></a>
    <a href="https://scrutinizer-ci.com/g/phpviet/omnipay-vtcpay"><img src="https://img.shields.io/scrutinizer/g/phpviet/omnipay-vtcpay.svg?style=flat-square" alt="Quantity score"></a>
    <a href="https://styleci.io/repos/189053834"><img src="https://styleci.io/repos/189053834/shield?branch=master" alt="StyleCI"></a>
    <a href="https://packagist.org/packages/phpviet/omnipay-vtcpay"><img src="https://img.shields.io/packagist/dt/phpviet/omnipay-vtcpay.svg?style=flat-square" alt="Total download"></a>
    <a href="https://packagist.org/packages/phpviet/omnipay-vtcpay"><img src="https://img.shields.io/packagist/l/phpviet/omnipay-vtcpay.svg?style=flat-square" alt="License"></a>
    </p>
</p>

## Thông tin

Thư viện hổ trợ tích cổng thanh toán VTCPay phát triển trên nền tảng [Omnipay League](https://github.com/thephpleague/omnipay).

Để nắm sơ lược về khái niệm và cách sử dụng các **Omnipay** gateways bạn hãy truy cập vào [đây](https://omnipay.thephpleague.com/) 
để kham khảo.

## Cài đặt

Cài đặt Omnipay VTCPay thông qua [Composer](https://getcomposer.org):

```bash
composer require phpviet/omnipay-vtcpay
```
## Cách sử dụng

### Tích hợp sẵn trên các framework phổ biến hiện tại

- [`Laravel`](https://github.com/phpviet/laravel-omnipay)
- [`Symfony`](https://github.com/phpviet/symfony-omnipay)
- [`Yii`](https://github.com/phpviet/yii-omnipay)

hoặc nếu bạn muốn sử dụng không dựa trên framework thì tiếp tục xem tiếp.

### Khởi tạo gateway:

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('VTCPay');
$gateway->initialize([
    'website_id' => 'Do VTCPay cấp',
    'security_code' => 'Do VTCPay cấp',
]);
```

Gateway khởi tạo ở trên dùng để tạo các yêu cầu xử lý đến VTCPay hoặc dùng để nhận yêu cầu do VTCPay gửi đến.

### Tạo yêu cầu thanh toán:

```php
$response = $gateway->purchase([
    'receiver_account' => '0963465816',
    'reference_number' => microtime(false),
    'amount' => 50000,
    'url_return' => 'https://phpviet.org'
])->send();

if ($response->isRedirect()) {
    $redirectUrl = $response->getRedirectUrl();
    
    // TODO: chuyển khách sang trang VTCPay để thanh toán
}
```

Kham khảo thêm các tham trị khi tạo yêu cầu và VTCPay trả về tại [đây](https://vtcpay.vn/tai-lieu-tich-hop-website).

### Kiểm tra thông tin `url_return` khi khách được VTCPay redirect về:

```php
$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả và hiển thị.
    print $response->amount;
    print $response->reference_number;
    
    var_dump($response->getData()); // toàn bộ data do VTCPay gửi sang.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi VTCPay trả về tại [đây](https://vtcpay.vn/tai-lieu-tich-hop-website).


### Kiểm tra thông tin `IPN` do VTCPay gửi sang:

```php
$response = $gateway->notification()->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả.
    print $response->amount;
    print $response->reference_number;
    
    var_dump($response->getData()); // toàn bộ data do VTCPay gửi sang.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi VTCPay gửi sang tại [đây](https://vtcpay.vn/tai-lieu-tich-hop-website).

## Dành cho nhà phát triển

Nếu như bạn cảm thấy thư viện chúng tôi còn thiếu sót hoặc sai sót và bạn muốn đóng góp để phát triển chung, 
chúng tôi rất hoan nghênh! Hãy tạo các `issue` để đóng góp ý tưởng cho phiên bản kế tiếp hoặc tạo `PR` 
để đóng góp phần thiếu sót hoặc sai sót. Riêng đối với các lỗi liên quan đến bảo mật thì phiền bạn gửi email đến
vuongxuongminh@gmail.com thay vì tạo issue. Cảm ơn!
