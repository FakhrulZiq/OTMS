<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>OTMS | Darul Huffaz Anwar</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body {
        margin-top: 20px;
        background-color: #eee;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
    }
</style>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">Invoice #{{$payment->invoice_id}} <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                            <h2 class="mb-1 text-muted">DarulHuffaz Anwar</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">No 11-01 Jalan Ros Merah, 2/3 Taman Johor Jaya,</p>
                            <p class="mb-1">support@darulhuffaz.com </a></p>
                            <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">{{$parent->FullName}}</h5>
                                <p class="mb-1">{{$parent->Address1}}, {{$parent->Address2}}</p>
                                <p class="mb-1">{{$user->email}}</p>
                                <p>{{$parent->PhoneNo}}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Invoice No: <span class="float-end"> #{{$payment->invoice_id}}</span></h5>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date: <span class="float-end"> {{$payment->payment_date}}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end" style="width: 120px;">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">01</th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14 mb-1">{{$payment->month}} {{$payment->year}}</h5>
                                            <p class="text-muted mb-0">{{$student->FullName}}</p>
                                        </div>
                                    </td>
                                    <td>RM {{$payment->amount}}</td>
                                    <td>1</td>
                                    <td class="text-end">RM {{$payment->amount}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                    <td class="text-end">RM {{$payment->amount}}</td>
                                </tr>
                                <!-- <tr>
                                    <th scope="row" colspan="4" class="border-0 text-end">Discount :</th>
                                    <td class="border-0 text-end">- $ 25.50</td>
                                </tr> -->
                                <tr>
                                    <th scope="row" colspan="4" class="border-0 text-end">Online Payment Charge :</th>
                                    <td class="border-0 text-end">RM 1.00</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4" class="border-0 text-end">Tax</th>
                                    <td class="border-0 text-end">RM 0.00</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                    <td class="border-0 text-end"><h4 class="m-0 fw-semibold">RM {{number_format($payment->amount + 1.00, 2)}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                {{-- <button class="btn btn-primary w-md">Save</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
