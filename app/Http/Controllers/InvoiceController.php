<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Students;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function generateInvoices()
    {
        // Retrieve all students
        $students = Students::all();
        
        foreach ($students as $student) {
            // Check if the student already has an unpaid invoice
            $unpaidInvoice = Invoice::where('student_id', $student->id)
                ->where('status', 'unpaid')
                ->latest()
                ->first();

            if (!$unpaidInvoice) {
                // Generate a new invoice for the student
                $dueDate = Carbon::now()->addDays(30); // Example: due date is 30 days from the current date

                $invoice = new Invoice();
                $invoice->student_id = $student->id;
                $invoice->amount = 100; // Example: set the invoice amount
                $invoice->due_date = $dueDate;
                $invoice->status = 'unpaid';
                $invoice->save();
            }
        }

        return 'Invoices generated successfully!';
    }
}
