<?php

namespace Database\Seeders;

use App\Models\Payments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payments::create([
            'student_id' => '7', 
            'amount' => '50', 
            'month' => 'April',
            'year' => '2023',
            'payment_date' => '2023-04-01',
            'status' => 'paid',
        ]);
    }
}
