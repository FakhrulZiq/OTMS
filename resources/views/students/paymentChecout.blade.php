@extends('layout')

@section('content')
<head>
    {{-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'> --}}
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {
            background-color: #eee;
        }

        .containers {
            height: 100vh;
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }

        .card {
            border: none;
        }

        .form-control {
            border-bottom: 2px solid #eee !important;
            border: none;
            font-weight: 600;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #8bbafe;
            outline: 0;
            box-shadow: none;
            border-radius: 0px;
            border-bottom: 2px solid blue !important;
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .inputbox span {
            position: absolute;
            top: 7px;
            left: 11px;
            transition: 0.5s;
        }

        .inputbox i {
            position: absolute;
            top: 13px;
            right: 8px;
            transition: 0.5s;
            color: #3F51B5;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .inputbox input:focus~span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px;
        }

        .inputbox input:valid~span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px;
        }

        .card-blue {
            background-color: #492bc4;
            border-radius: 10px;
            color: #ffff;
        }

        .text-white{
            padding: 10px;
        }

        .hightlight {
            background-color: #5737d9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 14px;
        }

        .yellow {
            color: #fdcc49;
        }

        .decoration {
            text-decoration: none;
            font-size: 14px;
        }

        .btn-success {
            color: #fff;
            background-color: #492bc4;
            border-color: #492bc4;
            float: right;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #492bc4;
            border-color: #492bc4;
        }

        .decoration:hover {
            text-decoration: none;
            color: #fdcc49;
        }
    </style>
</head>
    <div class="containers mt-5 px-5" style="position: absolute; top: 15px;">
        <div class="mb-4" style="padding-bottom: 20px;">
            <h2>Confirm payment</h2>
            <span>Please check this detail before make payment</span>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                    <h4 class="text-uppercase">Payment details</h4>
                    <div class="inputbox mt-3">
                        <label for="fname"><h5>Student Name</h5></label>
                        <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="{{$student->FullName}}" value="{{$student->FullName}}" readonly>
                        {{-- <span>Name on card</span> --}}
                    </div>
                    <div class="inputbox mt-3">
                        <label for="fname"><h5>Parent's Name</h5></label>
                        <input type="text" class="form-control" name="FullName" id="FullName" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" placeholder="{{$parent->FullName}}" value="{{$parent->FullName}}" readonly>
                        {{-- <span>Name on card</span> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2">
                                <label for="className"><h5>Class Name</h5></label>
                                <input type="text" class="form-control" name="className" id="className" placeholder="{{$class->className}}" value="{{$class->className}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2">
                                <label for="teacherName"><h5>Teacher's Name</h5></label>
                                <input type="text" class="form-control" name="teacherName" id="teacherName" placeholder="{{$teacher->FullName}}" value="{{$teacher->FullName}}"  readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2">
                                <label for="invoice_id"><h5>Invoice ID</h5></label>
                                <input type="text" class="form-control" name="invoice_id" id="invoice_id" placeholder="{{$payment->invoice_id}}" value="{{$payment->invoice_id}}"  readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2">
                                <label for="payment_month"><h5>Payment Month</h5></label>
                                <input type="text" class="form-control" name="payment_month" id="payment_month" placeholder="{{$payment->month}}" value="{{$payment->month}}" readonly>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-4 mb-4">
                        <h6 class="text-uppercase">Billing Address</h6>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control"  readonly=" readonly">
                                    <span>Street Address</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control"  readonly=" readonly">
                                    <span>City</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control"  readonly=" readonly">
                                    <span>State/Province</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="name" class="form-control"  readonly=" readonly">
                                    <span>Zip code</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="mt-4 mb-4 d-flex justify-content-between">
                    <a href="/students/fee-payment/{{$student->id}}"><span>Previous step</span></a>                      
                    <a href="{{ route('students.toyyibpay', ['student' => $student, 'invoice_id' => $payment->invoice_id]) }}" class="btn btn-success px-3">Pay RM {{ $payment->amount }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-blue p-3 text-white mb-3">
                    <span>You have to pay</span>
                    <div class="d-flex flex-row align-items-end mb-3">
                        <h1 class="mb-0 yellow">RM {{$payment->amount}}</h1>
                        <span><span class="yellow decoration">+</span> RM 1.00</span>
                    </div>
                    <span>Please note that a charge of <span class="yellow decoration">RM 1.00</span> will be applied for every online payment.</span>
                    {{-- <a href="#" class="yellow decoration">Know all the features</a> --}}
                    <div class="hightlight">
                        <span>100% Guaranteed support and update for the next 5 years.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
