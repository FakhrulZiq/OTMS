<?php

namespace Database\Seeders;

use App\Models\Staffs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staffs::create([
            'User_ID' => '23',
            'FullName' => 'MOHD ZAKI BIN ABDULLAH',
            'ICno' => '950801-14-5689',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
        ]);

        Staffs::create([
            'User_ID' => '24',   
            'FullName' => 'NURUL FATIN BINTI AHMAD',
            'ICno' => '880416-08-3465',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
         ]);

         Staffs::create([
            'User_ID' => '25',
            'FullName' => 'AHMAD FIKRI BIN MOHAMMAD',
            'ICno' => '930210-07-2583',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
         ]);

         Staffs::create([
            'User_ID' => '26',
            'FullName' => 'SITI NURULAIN BINTI RAMLI',
            'ICno' => '910609-12-9067',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
         ]);

         Staffs::create([
            'User_ID' => '27',
            'FullName' => 'MOHAMAD ZULHELMI BIN ISMAIL',
            'ICno' => '960502-03-1287',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
         ]);
    }
}
