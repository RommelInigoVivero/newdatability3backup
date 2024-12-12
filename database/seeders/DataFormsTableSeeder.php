<?php

namespace Database\Seeders;

use App\Models\DataForms;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DataForms::factory()->count(100)->create(); // Adjust the count as needed
    }
}
