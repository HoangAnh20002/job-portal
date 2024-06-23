<?php
namespace App\Repositories;

use App\Enums\Base;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(Payment::class);
    }

    public function getExpirationDate()
    {
        // Lấy thời gian ba tháng trước
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // Cập nhật trạng thái payment_status của các bản ghi phù hợp
        $this->model->where('created_at', '<', $threeMonthsAgo)
            ->where('payment_status', 'Completed')
            ->update(['payment_status' => 'false']);
    }
    public function showPaymentUser($employer_id){
        $payments =  $this->model->where('employer_id',$employer_id)->with('employer.post_jobs')->paginate(Base::PAGE);
        return $payments;
    }

    public function limitServicePayment()
    {
        $paymentCount = $this->model->where('payment_status', 'Success')->where('service_id',1)->count();
        if($paymentCount>5){
            return false;
        }
        return true;
    }


}
?>
