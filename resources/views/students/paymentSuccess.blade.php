@extends('layout')

@section('content')

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/dollar.png" type="image/png" sizes="16x16">
    <title>Payment Success</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/paymentSuccess.css') }}">
</head>
<body>
    <div class="container">
        <div class="printer-top"></div>
    
        <div class="paper-container">
            <div class="printer-bottom"></div>
    
            <div class="paper">
                <div class="main-contents">
                    @if($payment->status == 'paid')
                        <div class="success-icon">&#10004;</div>
                        <div class="success-title">
                            Payment Complete
                        </div>
                        <div class="success-description">
                            Thank you for completing the payment! You will shortly receive an email of your payment.
                        </div>
                        <div class="order-details">
                            <div class="order-number-label">Transaction ID</div>
                            <div class="order-number">{{$payment->invoice_id}}</div>
                            <div class="complement">Thank You!</div>
                        </div>
                        <div class="button-container">
                            <a href="/students/fee-payment/{{$payment->student_id}}" class="button">Back</a> 
                            <a href="{{ route('students.generate-receipt', ['studentId' => $payment->student_id, 'invoiceId' => $payment->invoice_id]) }}"
                                target="_blank"
                                onclick="window.open(this.href, '_blank', 'width=800,height=830'); return false;"
                                class="button button-print">
                                Print
                             </a>
                        </div>
                    @elseif($payment->status == 'unpaid')
                        <div class="failure-icon">&#10006;</div>
                        <div class="failure-title">
                            Payment Failed
                        </div>
                        <div class="failure-description">
                            Sorry, your payment was not completed successfully. Please try again later.
                        </div>
                        <div class="order-details">
                            <div class="order-number-label">Transaction ID</div>
                            <div class="order-number">{{$payment->invoice_id}}</div>
                            <div class="fail-complement">Payment Failed</div>
                        </div>
                        <div class="button-container">
                            <a href="/students/fee-payment/{{$payment->student_id}}" class="button button-print">Back</a>
                            <a href="{{ route('students.payment-checkout', ['student' => $payment->student_id, 'invoice_id' => $payment->invoice_id]) }}    " class="button-fail">Try</a>
                        </div>
                    @endif
                </div>
                <div class="jagged-edge"></div>
            </div>
        </div>
    </div>    
</body>
@endsection