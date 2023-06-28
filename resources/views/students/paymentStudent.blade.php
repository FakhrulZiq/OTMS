@extends('layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    /* Container styles */
    .table-container {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .table-container th {
      background-color: #f2f2f2;
    }

    /* Card-like table style */
    .card-table {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .pay-btn, .print-btn {
      padding: 6px 12px;
      background-color: #4CAF50;
      border: none;
      color: white;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      cursor: pointer;
      border-radius: 8px;
      transition: background-color 0.3s ease;
    }

    .pay-btn:hover, .print-btn:hover {
      background-color: #45a049;
    }
    
    .profile-card {
      width: 80%;
      margin-left: auto;
      margin-right: auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .profile-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }

    .profile-card .student-details {
      flex: 1;
    }

    .profile-card table {
      width: 100%;
    }

    .profile-card th, .profile-card td {
      padding: 5px 0;
    }

    .profile-card th {
      text-align: left;
    }

    .profile-card .label {
      font-weight: bold;
    }

    /* Responsive Styles */
    @media screen and (max-width: 600px) {
      .profile-card {
        flex-direction: column;
        align-items: flex-start;
      }

      .profile-card img {
        margin-right: 0;
        margin-bottom: 20px;
      }

      .profile-card .student-details {
        margin-left: 0;
      }

      .table-container {
        width: 80%;
      }
    }
  </style>
  <h4 style="margin-left: 10%;"><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
  <h1 style="margin-left: 10%; padding-bottom: 20px;">Fee Payment</h1>
  
  <!-- Student Profile Card -->
  <div class="profile-card">
    <img src="{{ $student->ProfileImage ? asset('profileImages/' . $student->ProfileImage) : asset('images/no-image.jpg') }}">
    <div class="student-details">
      <table>
        <tr>
          <th style="width: 25%"><h4>Student Name:</h4></th>
          <td>{{ $student->FullName }}</td>
        </tr>
        <tr>
          <th><h4>Student MyKid :</h4></th>
          <td>{{ $student->MyKid }}</td>
        </tr>
        <tr>
          <th><h4>Parent's Name:</h4></th>
          <td>{{ $parent->FullName }}</td>
        </tr>
        <tr>
          <th><h4>Class's Name:</h4></th>
          <td>{{ $class->className }}</td>
        </tr>
        <tr>
          <th><h4>Teacher's Name:</h4></th>
          <td>{{ $teacher->FullName }}</td>
        </tr>
      </table>
    </div>
  </div>
  
   <!-- Unpaid Fees -->
  <div class="table-container card-table">
    <h2>Unpaid Fees</h2>
    @if (count($unpaidFees) > 0)
      <table style="margin-top: 20px">
        <thead>
          <tr>
            <th style="width: 12%">Invoice ID</th>
            <th>Student Name</th>
            <th style="width: 18%">Deatils</th>
            <th style="width: 10%">Year</th>
            <th style="width: 10%">Amount</th>
            <th style="width: 10%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($unpaidFees as $payment)
            <tr>
              <td>{{ $payment->invoice_id }}</td>
              <td>{{ $student->FullName }}</td>
              <td>{{ $payment->month }}</td>
              <td>{{ $payment->year }}</td>
              <td>RM {{ $payment->amount }}</td>
              <td><a href="{{ route('students.payment-checkout', ['student' => $student, 'invoice_id' => $payment->invoice_id]) }}" class="btn btn-success pay-btn px-3">Pay</a></td>
            </tr>
          @endforeach

        </tbody>
      </table>
    @else
      <p>Great! you don't have oustanding balance</p>
    @endif
  </div>

  <!-- Paid Fees -->
  <div class="table-container card-table">
    <h2>Paid Fees</h2>
    @if (count($paidFees) > 0)
      <table style="margin-top: 20px">
        <thead>
          <tr>
            <th style="width: 12%">Invoice ID</th>
            <th>Student Name</th>
            <th style="width: 18%">Details</th>
            <th style="width: 10%">Year</th>
            <th style="width: 10%">Amount</th>
            <th style="width: 10%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($paidFees as $payment)
            <tr>
              <td>{{ $payment->invoice_id }}</td>
              <td>{{ $student->FullName }}</td>
              <td>{{ $payment->month }}</td>
              <td>{{ $payment->year }}</td>
              <td>RM {{ $payment->amount }}</td>
              <td>
                <a href="{{ route('students.generate-receipt', ['studentId' => $student->id, 'invoiceId' => $payment->invoice_id]) }}"
                  target="_blank"
                  onclick="window.open(this.href, '_blank', 'width=800,height=830'); return false;"
                  class="btn btn-success pay-btn px-3">
                  Print
               </a>
              </td>            
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p>No payment has been made yet.</p>
    @endif
  </div>
  <br>
  <br>
@endsection
