<?php

namespace Database\Seeders;

use App\Models\Teachers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teachers::create([
            'User_ID' => '18',
            'FullName' => 'AISHA BINTI ABDUL RAHMAN',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2018-05-17',
        ]);

        Teachers::create([
            'User_ID' => '19',   
            'FullName' => 'MOHAMMAD BIN IBRAHIM',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2020-11-28',
         ]);

         Teachers::create([
            'User_ID' => '20',
            'FullName' => 'YUSUF BIN ALI',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2016-07-10',
         ]);

         Teachers::create([
            'User_ID' => '21',
            'FullName' => 'SAFIYA BINTI AHMED',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2022-03-05',
         ]);

         Teachers::create([
            'User_ID' => '22',
            'FullName' => 'MARIAM BINTI ABDULLAH',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2017-09-21',
         ]);

         Teachers::create([
            'User_ID' => '28',
            'FullName' => 'SYAMSIAH BINTI SAMSUDIN',
            'ICno' => '901002-08-5436',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '47150',
            'City' => 'Puchong',
            'State' => 'Selangor',
            'PhoneNo' => '011-24798476',
            'Nationality' => 'Warganegara',
            'Position' => 'Teacher',
            'DateJoin' => '2017-09-21',
         ]);
    }
}
