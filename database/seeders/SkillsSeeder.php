<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'js',
            'php',
            'html',
            'css'
        ];

        foreach ($skills as $skill) {
            Skill::create([
                'skill' => $skill,
            ]);
        }
    }
}