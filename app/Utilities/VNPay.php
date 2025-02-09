<?php

namespace App\Utilities;

class VNPay
{
    /**
     * Cấu hình
     *
     * config.php
     *
     */
    static $vnp_TmnCode = "1V0R1NN7"; //Mã website tại VNPAY
    static $vnp_HashSecret = "5FFF8OXISYHMGGYH0ZK8TOYAXA2C9MCN"; //Chuỗi bí mật
    static $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    static $vnp_Returnurl = "/checkout/vnPayCheck"; //Chú ý cấu hình env('APP_URL') khi sử dụng biến này.

    /**
     * vnpay_create_payment.php
     *
     * https://sandbox.vnpayment.vn/apis/docs/huong-dan-tich-hop
     *
     * @param array $data
     * [ <br>
     * vnp_TxnRef => ' ', //Mã tham chiếu của giao dịch tại hệ thống của merchant. Mã này là duy nhất đùng để phân biệt các đơn hàng gửi sang VNPAY. Không được trùng lặp trong ngày. Ví dụ: 23554 <br> <br>
     * vnp_OrderInfo => ' ', //Thông tin mô tả nội dung thanh toán (Tiếng Việt, không dấu). Ví dụ: **Nap tien cho thue bao 0123456789. So tien 100,000 VND** <br> <br>
     * vnp_Amount => ' ', Số tiền thanh toán. Số tiền không mang các ký tự phân tách thập phân, phần nghìn, ký tự tiền tệ. Để gửi số tiền thanh toán là 10,000 VND (mười nghìn VNĐ) thì merchant cần nhân thêm 100 lần (khử phần thập phân), sau đó gửi sang VNPAY là: 1000000 <br>
     * ]
     *
     * @return string
     */
    public static function vnpay_create_payment(array $data)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

        // Cấu hình các tham số đơn hàng
        $vnp_TxnRef = $data['vnp_TxnRef']; // Mã đơn hàng
        $vnp_OrderInfo = $data['vnp_OrderInfo']; // Mô tả đơn hàng
        $vnp_OrderType = 100000; // Loại hàng hóa: Thực Phẩm - Tiêu Dùng
        $vnp_Amount = $data['vnp_Amount']*100 ; // Số tiền (vnd) * 100
        $vnp_Locale = 'vn'; // Ngôn ngữ tiếng việt
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của người thanh toán

        // Tạo mảng tham số để gửi lên VNPAY
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => self::$vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND", // Đơn vị tiền tệ (phiên bản đang dùng chỉ hỗ trợ VND)
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('APP_URL') . self::$vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        // Kiểm tra và thêm 'vnp_BankCode' nếu có
        if (isset($data['vnp_BankCode']) && $data['vnp_BankCode'] != "") {
            $inputData['vnp_BankCode'] = $data['vnp_BankCode'];
        }

        // Sắp xếp các tham số theo thứ tự alphabet
        ksort($inputData);
        
        // Tạo chuỗi query và hashdata
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Thêm 'vnp_SecureHashType' và 'vnp_SecureHash'
        $vnp_Url = self::$vnp_Url . "?" . $query;
        if (isset(self::$vnp_HashSecret)) {
            // Tạo chữ ký bảo mật với SHA-512
            $vnpSecureHash = hash_hmac('sha512', $hashdata, self::$vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHashType=SHA512&vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);

        return $returnData['data']; // Trả về URL thanh toán
    }
}

?>
