<?php
namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
use App\Repositories\PostJobsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VNpayController extends Controller
{
    protected $postJobsRepository;
    protected $paymentRepository;
    
    function __construct(PaymentRepository $paymentRepository, PostJobsRepository $postJobsRepository)
    {
        $this->paymentRepository= $paymentRepository;
        $this->postJobsRepository = $postJobsRepository;
    }
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $customData = [
            'employer_id' => session('auth')->employer->id,
            'service_id' => $request->input('service_id'),
            'postjob_id' => $request->input('postjob_id'),
            // Bạn có thể thêm các trường khác nếu cần
        ];

        // Mã hóa dữ liệu tùy chỉnh
        $encodedData = base64_encode(json_encode($customData));
        
        $vnp_TmnCode = "8MYXNMCB"; //Mã website tại VNPAY
        $vnp_HashSecret = trim(\config('app.vnp_HashSecret')); //Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('Vnpay_return');
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount * 100; // Số tiền thanh toán (theo đơn vị VND, nhân với 100)
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
            'vnp_OrderInfo' => $encodedData, 
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
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        // Lấy thông tin từ request
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        Carbon::setLocale('vi');
        Carbon::setToStringFormat('Y-m-d H:i:s');
        if ($vnp_ResponseCode == "00") {
            $currentDateTime = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
            $formattedDateTime = $currentDateTime->format('d/m/Y');
            $encodedData = $request->input('vnp_OrderInfo');
            $decodedData = json_decode(base64_decode($encodedData), true);
            // Xử lý dữ liệu tùy chỉnh
            $data = [
               'employer_id' => $decodedData['employer_id'] ,
               'service_id' =>$decodedData['service_id'] ,
                'postjob_id' => $decodedData['postjob_id'],
                'amount'=>$request->input('vnp_Amount')/100,
                'payment_date'=>$formattedDateTime,
                'payment_status'=>'Success'
            ];

            $this->paymentRepository->create($data);
            // $serviceId = session('infoService')['service_id'];
            // $postJobId = session('infoService')['postjob_id'];
            // $dataToUpdate = [
            //     'service_id' => $serviceId,
            // ];
            // $this->postJobsRepository->update($postJobId, $dataToUpdate);
            session()->forget('infoService');
            return redirect('/postjob')->with('success', 'Đã thanh toán phí dịch vụ');
        }
        session()->forget('infoService');
        return redirect()->back('/postjob')->with('error', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
