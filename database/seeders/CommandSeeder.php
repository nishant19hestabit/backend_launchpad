<?php

namespace Database\Seeders;

use App\Models\StoreCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreCommand::create([
            'name' => 'daily-quote',
            'start' => '00:00:00',
        ]);
    }
}
