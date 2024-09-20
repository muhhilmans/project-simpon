<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name' => '1', 'class' => '1', 'package' => 'A'],
            ['name' => '1', 'class' => '2', 'package' => 'A'],
            ['name' => '1', 'class' => '3', 'package' => 'A'],
            ['name' => '2', 'class' => '4', 'package' => 'A'],
            ['name' => '2', 'class' => '5', 'package' => 'A'],
            ['name' => '2', 'class' => '6', 'package' => 'A'],
            ['name' => '3', 'class' => '7', 'package' => 'B'],
            ['name' => '3', 'class' => '8', 'package' => 'B'],
            ['name' => '4', 'class' => '9', 'package' => 'B'],
            ['name' => '5', 'class' => '10', 'package' => 'C'],
            ['name' => '5', 'class' => '11', 'package' => 'C'],
            ['name' => '6', 'class' => '12', 'package' => 'C'],
        ];

        foreach ($datas as $data) {
            Level::create($data);
        }
    }
}
