<?php

namespace Database\Seeders;

use App\Models\Headmasters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeadmasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Headmasters::create([
            'User_ID' => '1',
            'FullName' => 'IMAN BINTI RAHIM',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 86',
            'Address2' => 'Jalan Dahlia 2',
            'Poscode' => '13000',
            'City' => 'Kulim Utara',
            'State' => 'Kedah',
            'PhoneNo' => '011-30495867',
            'Nationality' => 'Warganegara',
            'Position' => 'Headmaster',
            'DateJoin' => '2018-01-17',
        ]);

        Headmasters::create([
            'User_ID' => '2',   
            'FullName' => 'SYUKOR BIN AMAR',
            'ICno' => '730101-08-8457',
            'Address1' => 'No. 52',
            'Address2' => 'Jalan Lori Terbalik',
            'Poscode' => '49900',
            'City' => 'Padang Serai',
            'State' => 'Johor',
            'PhoneNo' => '011-10293847',
            'Nationality' => 'Warganegara',
            'Position' => 'Headmaster',
            'DateJoin' => '2020-01-28',
         ]);
    }
}
