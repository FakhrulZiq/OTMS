<?php

namespace App\Http\Controllers;

use Toyyibpay;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Payments;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
    
class ToyyibPayController extends Controller
{
    public function createBill(Students $student, $invoice_id) {
        $this->middleware('parent.auth');

        $parent = Parents::find($student->Parent_id);
        $class = Classes::find($student->Class_id);
        $teacher = Teachers::find($class->id);
        $user = User::find($parent->User_ID);
        $payment = Payments::where('student_id', $student->id)
                        ->where('invoice_id', $invoice_id)
                        ->first();

        $code = config('toyyibpay.categoryCode');

        $bill_object = [
            'userSecretKey' => config('toyyibpay.client_secret'),
            'categoryCode' => config('toyyibpay.categoryCode'),
            'billName' => 'Online Tahfiz Management',
            'billDescription' => 'Fee payment for'.$payment->month.' '.$payment->year,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => 5000,
            'billReturnUrl' => route('students.toyyib-status'),
            'billCallbackUrl' => route('students.toyyib-callback'),
            'billExternalReferenceNo' => $payment->invoice_id,
            'billTo' => $parent->FullName,
            'billEmail' => $user->email,
            'billPhone' => $parent->PhoneNo,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 0,
            'billContentEmail' => 'Thank you for completing yor fee',
            'billChargeToCustomer' => 2,
        ];
        $data = Toyyibpay::createBill($code, (object)$bill_object);

        $bill_code = $data[0]->BillCode;

        $link = Toyyibpay::billPaymentLink($bill_code);

        return Redirect::to($link);
    }    

    public function paymentStatus(){
        $data = request()->all();
    
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');
        
        $status = $data['status_id'];
    
        // Map the status code to the corresponding status value
        if ($status == 1) {
            $paymentStatus = 'paid';
        } elseif ($status == 2) {
            $paymentStatus = 'unpaid';
        } elseif ($status == 3) {
            $paymentStatus = 'unpaid';
        } else {
            $paymentStatus = 'unknown'; // Set a default status if needed
        }
    
        // Update the payment status in the database
        $payment = Payments::where('invoice_id', $data['order_id'])->first();
        $payment->status = $paymentStatus;
        $payment->billcode = $data['billcode'];
        $payment->payment_date = $formattedDate;
        $payment->save();
    
        // Convert the array to an object
        $paymentObject = (object) $payment;

        return view('students.paymentSuccess', ['payment' => $paymentObject]);
    }

    public function callBack(){
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
    }
}
