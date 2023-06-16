@extends('layout')

@section('content')

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/dollar.png" type="image/png" sizes="16x16">
    <title>Payment Success</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    .container {
        max-width: 380px;
        margin: 50px auto;
        overflow: hidden;
    }

    .printer-top {
        z-index: 1;
        border: 6px solid #666666;
        height: 6px;
        border-bottom: 0;
        border-radius: 6px 6px 0 0;
        background: #333333;
    }

    .printer-bottom {
        z-index: 0;
        border: 6px solid #666666;
        height: 6px;
        border-top: 0;
        border-radius: 0 0 6px 6px;
        background: #333333;
    }

    .paper-container {
        position: relative;
        overflow: hidden;
        height: 537px;
    }

    .paper {
        background: #ffffff;
        font-family: 'Poppins', sans-serif;
        height: 487px;
        position: absolute;
        z-index: 2;
        margin: 0 12px;
        margin-top: -12px;
        animation: print 5000ms cubic-bezier(0.68, -0.55, 0.265, 0.9) infinite;
        -moz-animation: print 5000ms cubic-bezier(0.68, -0.55, 0.265, 0.9) infinite;
    }

    .main-contents {
        margin: 0 12px;
        padding: 10px;
    }

    // Paper Jagged Edge
    .jagged-edge {
        position: relative;
        height: 20px;
        width: 100%;
        margin-top: -1px;
    }

    .jagged-edge:after {
        content: "";
        display: block;
        position: absolute;
        //bottom: 20px;
        left: 0;
        right: 0;
        height: 20px;
        background: linear-gradient(45deg,
            transparent 33.333%,
            #ffffff 33.333%,
            #ffffff 66.667%,
            transparent 66.667%),
            linear-gradient(-45deg,
            transparent 33.333%,
            #ffffff 33.333%,
            #ffffff 66.667%,
            transparent 66.667%);
        background-size: 16px 40px;
        background-position: 0 -20px;
    }

    .success-icon {
        text-align: center;
        font-size: 48px;
        height: 72px;
        background: #359d00;
        border-radius: 50%;
        width: 72px;
        height: 72px;
        margin: 16px auto;
        color: #fff;
    }

    .success-title {
        font-size: 22px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #666;
        font-weight: bold;
        margin-bottom: 16px;
    }

    .success-description {
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        line-height: 21px;
        color: #999;
        text-align: center;
        margin-bottom: 24px;
    }

    .failure-icon {
        text-align: center;
        font-size: 48px;
        height: 72px;
        background: #e74c3c;
        border-radius: 50%;
        width: 72px;
        height: 72px;
        margin: 16px auto;
        color: #fff;
    }

    .failure-title {
        font-size: 22px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #666;
        font-weight: bold;
        margin-bottom: 16px;
    }

    .failure-description {
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        line-height: 21px;
        color: #999;
        text-align: center;
        margin-bottom: 24px;
    }

    .order-details {
        text-align: center;
        color: #333;
        font-weight: bold;
    }

    .order-number-label {
        font-size: 18px;
        margin-bottom: 8px;
    }

    .order-number {
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        line-height: 48px;
        font-size: 48px;
        padding: 8px 0;
        margin-bottom: 24px;
    }
    
    .complement {
        font-size: 18px;
        margin-bottom: 8px;
        color: #32a852;
    }

    .fail-complement {
        font-size: 18px;
        margin-bottom: 8px;
        color: #e74c3c;
    }
    
    .button-container {
        text-align: center;
        margin-top: 24px;
    }

    .button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #359d00;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        margin-right: 12px;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #267200;
        color: #fff;
        text-decoration: none;
    }

    .button:focus,
    .button:active {
        outline: none;
    }

    .button-fail {
        display: inline-block;
        padding: 12px 24px;
        background-color: #e74c3c;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 6px;
        margin-right: 12px;
        transition: background-color 0.3s;
    }

    .button-fail:hover {
        background-color: hsl(4, 70%, 40%);
        color: #fff;
        text-decoration: none;
    }

    .button-fail:focus,
    .button-fail:active {
        outline: none;
    }

    .button-print {
        background-color: #333;
    }

    }
    
    @keyframes print {
    0% {
        transform: translateY(-90%);
    }

    100% {
        transform: translateY(0%);
    }
}

@-webkit-keyframes print {
    0% {
        -webkit-transform: translateY(-90%);
    }

    100% {
        -webkit-transform: translateY(0%);
    }
}

@-moz-keyframes print {
    0% {
        -moz-transform: translateY(-90%);
    }

    100% {
        -moz-transform: translateY(0%);
    }
}

@-ms-keyframes print {
    0% {
        -ms-transform: translateY(-90%);
    }

    100% {
        -ms-transform: translateY(0%);
    }
}

/* Add new keyframes for a single iteration */
@keyframes print-once {
    0% {
        transform: translateY(-90%);
    }

    100% {
        transform: translateY(0%);
    }
}

@-webkit-keyframes print-once {
    0% {
        -webkit-transform: translateY(-90%);
    }

    100% {
        -webkit-transform: translateY(0%);
    }
}

@-moz-keyframes print-once {
    0% {
        -moz-transform: translateY(-90%);
    }

    100% {
        -moz-transform: translateY(0%);
    }
}

@-ms-keyframes print-once {
    0% {
        -ms-transform: translateY(-90%);
    }

    100% {
        -ms-transform: translateY(0%);
    }
}

/* Apply the single iteration animation to the paper */
.paper {
    /* Existing styles */
    animation: print-once 5000ms cubic-bezier(0.68, -0.55, 0.265, 0.9) 1;
    -moz-animation: print-once 5000ms cubic-bezier(0.68, -0.55, 0.265, 0.9) 1;
}

</style>

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