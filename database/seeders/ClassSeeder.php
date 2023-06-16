<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::create([
            'className' => 'LEVEL 1 - IQRA (Session 1 - Morning)',
            'Teacher_ID' => '1',
            'classDesc' => 'Kelas pengajian Iqra 1 sehingga Iqra 6',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 1 - IQRA (Session 2 - Morning)',
            'Teacher_ID' => '1',
            'classDesc' => 'Kelas pengajian Iqra 1 sehingga Iqra 6',
            'FeeAmount' => '50.00',
        ]);
        
        Classes::create([
            'className' => 'LEVEL 1 - IQRA (Session 1 - Night)',
            'Teacher_ID' => '6',
            'classDesc' => 'Kelas pengajian Iqra 1 sehingga Iqra 6',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 1 - IQRA (Session 2 - Night)',
            'classDesc' => 'Kelas pengajian Iqra 1 sehingga Iqra 6',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 2 - TALAQI BACAAN (Session 1 - Morning)',
            'Teacher_ID' => '6',
            'classDesc' => 'Kelas pengajian Talaqi bacaan Al-Quran',
            'FeeAmount' => '50.00',
        ]);
        
        Classes::create([
            'className' => 'LEVEL 2 - TALAQI BACAAN (Session 2 - Morning)',
            'Teacher_ID' => '2',
            'classDesc' => 'Kelas pengajian Talaqi bacaan Al-Quran',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 2 - TALAQI BACAAN (Session 1 - Night)',
            'Teacher_ID' => '4',
            'classDesc' => 'Kelas pengajian Talaqi bacaan Al-Quran',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 2 - TALAQI BACAAN (Session 2 - Night)',
            'Teacher_ID' => '4',
            'classDesc' => 'Kelas pengajian Talaqi bacaan Al-Quran',
            'FeeAmount' => '50.00',
        ]);
        
        Classes::create([
            'className' => 'LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Morning)',
            'Teacher_ID' => '3',
            'classDesc' => 'Kelas pengajian Talaqi dan Tamik bacaan Al-quran',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Morning)',
            'Teacher_ID' => '3',
            'classDesc' => 'Kelas pengajian Talaqi dan Tamik bacaan Al-quran',
            'FeeAmount' => '50.00',
        ]);

        Classes::create([
            'className' => 'LEVEL 3 - TALAQI & HAFAZAN (Session 1 - Night)',
            'Teacher_ID' => '5',
            'classDesc' => 'Kelas pengajian Talaqi dan Tamik bacaan Al-quran',
            'FeeAmount' => '50.00',
        ]);
        
        Classes::create([
            'className' => 'LEVEL 3 - TALAQI & HAFAZAN (Session 2 - Night)',
            'Teacher_ID' => '5',
            'classDesc' => 'Kelas pengajian Talaqi dan Tamik bacaan Al-quran',
            'FeeAmount' => '50.00',
        ]);
    }
}
