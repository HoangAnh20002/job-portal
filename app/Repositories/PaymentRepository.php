<?php
namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(Payment::class);
    }
}
?>