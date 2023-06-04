<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SentenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sentences')->insert([
            [
            "question" => "Она не понимает.",
            "answer" => "She doesn't understand.",
            "words" => "don't doesn't didn't she he understand understands understood ."
            ],
            [
            "question" => "Ты увидишь?",
            "answer" => "Will you see?",
            "words" => "will you they do does see sees saw ?"
            ],
            [
            "question" => "Они не летают.",
            "answer" => "They don't fly.",
            "words" => "we they don't doesn't didn't fly flies flew ."
            ],
            [
            "question" => "Мы поняли.",
            "answer" => "We understood.",
            "words" => "we they do does did understand understands understood ."
            ],
            [
            "question" => "Он не спросит.",
            "answer" => "He won't ask.",
            "words" => "he she do won't don't doesn't didn't ask asks asked."
            ]
        ]);
    }
}
