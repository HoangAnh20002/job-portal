<?php
namespace App\Repositories;

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
}
?>
