<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VNpayController extends Controller
{
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);

        $vnp_TmnCode = "8MYXNMCB"; //Mã website tại VNPAY
        $vnp_HashSecret = trim("1PR0O9C66K81MS8IQU5RPH9YT5004A0T"); //Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 50000 * 100; // Số tiền thanh toán (theo đơn vị VND, nhân với 100)
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire,
        );

        if ($request->has('bank_code')) {
            $inputData['vnp_BankCode'] = $request->input('bank_code');
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function return (Request $request)
    {
        // Lấy URL trước đó từ session hoặc mặc định là '/'
        $url = session('url_prev', '/');

        // Lấy thông tin từ request
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_Amount = $request->input('vnp_Amount');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_OrderInfo = $request->input('vnp_OrderInfo');

        // Kiểm tra mã phản hồi từ VNPAY
        if ($vnp_ResponseCode == "00") {
            // Xóa thông tin cost_id khỏi session nếu thanh toán thành công
            session()->forget('cost_id');
            dd([
                'vnp_TxnRef' => $vnp_TxnRef,
                'vnp_Amount' => $vnp_Amount,
                'vnp_ResponseCode' => $vnp_ResponseCode,
                'vnp_OrderInfo' => $vnp_OrderInfo,
                'url_prev' => $url,
                'all' => $request->all(),
            ]);
            // Lưu các thông tin giao dịch vào session hoặc cơ sở dữ liệu nếu cần thiết
            session(['transaction_info' => [
                'txn_ref' => $vnp_TxnRef,
                'amount' => $vnp_Amount,
                'order_info' => $vnp_OrderInfo,
            ]]);

            // Điều hướng về URL trước đó và thông báo thành công
            return redirect($url)->with('success', 'Đã thanh toán phí dịch vụ');
        }

        // Xóa thông tin url_prev khỏi session nếu thanh toán không thành công
        session()->forget('url_prev');
        // Điều hướng trở lại trang trước và thông báo lỗi
        return redirect()->back()->with('error', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

}
