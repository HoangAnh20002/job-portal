<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $paymentRepo;
    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepo=$paymentRepo;
    }
    
    public function index(Request $request)
    {
       
        $transactionInfo = session('transaction_info');
        $info_Payment= session('info_Payment'); 
        if ($transactionInfo && $info_Payment) {
            print_r($transactionInfo) ;
            echo("<br>");
            print_r($info_Payment);
             //'employer_id', 'amount', 'payment_date', 'service_id', 'postjob_id', 'payment_status'
            $data = $transactionInfo + $info_Payment;
            $result = $this->paymentRepo;
        } else {
            echo 'khong co'; 
        }
        return redirect('/create-payment/?amount'.$request->amount);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
