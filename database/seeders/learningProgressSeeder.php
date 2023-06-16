<?php

namespace Database\Seeders;

use App\Models\learningProgress;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class learningProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        learningProgress::create([
            'students_id' => '1',
            'percentage' => '1',
            'juzuk' => '1',
            'page' => '3',
        ]);

        learningProgress::create([
            'students_id' => '2',
            'percentage' => '7',
            'juzuk' => '3',
            'page' => '42',
        ]);

        learningProgress::create([
            'students_id' => '3',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '4',
            'percentage' => '56',
            'juzuk' => '17',
            'page' => '338',
        ]);

        learningProgress::create([
            'students_id' => '5',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '6',
            'percentage' => '39',
            'juzuk' => '12',
            'page' => '232',
        ]);

        learningProgress::create([
            'students_id' => '7',
            'percentage' => '53',
            'juzuk' => '16',
            'page' => '316',
        ]);

        learningProgress::create([
            'students_id' => '8',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '9',
            'percentage' => '13',
            'juzuk' => '4',
            'page' => '75',
        ]);

        learningProgress::create([
            'students_id' => '10',
            'percentage' => '6',
            'juzuk' => '2',
            'page' => '37',
        ]);

        learningProgress::create([
            'students_id' => '11',
            'percentage' => '86',
            'juzuk' => '26',
            'page' => '515',
        ]);

        learningProgress::create([
            'students_id' => '12',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '13',
            'percentage' => '93',
            'juzuk' => '28',
            'page' => '557',
        ]);

        learningProgress::create([
            'students_id' => '14',
            'percentage' => '35',
            'juzuk' => '11',
            'page' => '211',
        ]);

        learningProgress::create([
            'students_id' => '15',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        //16
        learningProgress::create([
            'students_id' => '16',
            'percentage' => '42',
            'juzuk' => '13',
            'page' => '249',
        ]);

        learningProgress::create([
            'students_id' => '17',
            'percentage' => '39',
            'juzuk' => '12',
            'page' => '235',
        ]);

        learningProgress::create([
            'students_id' => '18',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '19',
            'percentage' => '56',
            'juzuk' => '17',
            'page' => '334',
        ]);

        learningProgress::create([
            'students_id' => '20',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '21',
            'percentage' => '86',
            'juzuk' => '26',
            'page' => '518',
        ]);

        learningProgress::create([
            'students_id' => '22',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '23',
            'percentage' => '96',
            'juzuk' => '28',
            'page' => '558',
        ]);

        learningProgress::create([
            'students_id' => '24',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '25',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '26',
            'percentage' => '93',
            'juzuk' => '28',
            'page' => '558',
        ]);

        learningProgress::create([
            'students_id' => '27',
            'percentage' => '88',
            'juzuk' => '27',
            'page' => '529',
        ]);

        learningProgress::create([
            'students_id' => '28',
            'percentage' => '88',
            'juzuk' => '27',
            'page' => '529',
        ]);

        learningProgress::create([
            'students_id' => '29',
            'percentage' => '0',
            'juzuk' => '0',
            'page' => '0',
        ]);

        learningProgress::create([
            'students_id' => '30',
            'percentage' => '23',
            'juzuk' => '7',
            'page' => '135',
        ]);
    }
}
