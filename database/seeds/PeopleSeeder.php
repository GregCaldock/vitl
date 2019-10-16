<?php

use App\Models\Person;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $filepath = storage_path('app/names.csv');
        $file = fopen($filepath, 'rb');

        while (($data = fgetcsv($file, 500, "\t")) !== false) {
            Person::create(['first_name' => $data[0], 'last_name' => $data[1]]);
        }
    }
}
