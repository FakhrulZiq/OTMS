<?php

namespace App\Console\Commands;

use App\Models\Payments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Students;
use Illuminate\Console\Command;
use Carbon\Carbon;

class GenerateInvoices extends Command {
    protected $signature = 'invoices:generate';
    protected $description = 'Generate new invoices for all students';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {
        $students = Students::where('status', 'active')->get(); // Retrieve active students

        foreach ($students as $student) {
            $lastPaymentDate = Carbon::parse($student->LastPaymentDate)->startOfMonth();
            $currentMonth = Carbon::now()->startOfMonth();

            // Set the initial invoice date to the month following the LastPaymentDate
            $invoiceDate = $lastPaymentDate->copy()->addMonth();

            // Generate invoice IDs for each month until the current month
            while ($invoiceDate <= $currentMonth) {
                // Check if the invoice already exists for the student and month
                $existingInvoice = DB::table('payments')
                    ->where('student_id', $student->id)
                    ->where('month', $invoiceDate->format('F'))
                    ->where('year', $invoiceDate->year)
                    ->first();

                if (!$existingInvoice) {
                    $invoiceId = 'INV' .$student->id . $invoiceDate->format('Ym'); // Generate the invoice ID

                    DB::table('payments')->insert([
                        'student_id' => $student->id,
                        'amount' => 50, // Set the initial amount as 0
                        'month' => $invoiceDate->format('F'),
                        'year' => $invoiceDate->year,
                        'payment_date' => null,
                        'status' => 'unpaid',
                        'invoice_id' => $invoiceId,
                        'invoice_date' => $invoiceDate->format('Y-m-d'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $invoiceDate->addMonth(); // Move to the next month
            }
        }

        $this->info('Invoices generated successfully for active students!');
    }
}
