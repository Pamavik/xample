<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class XampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::first();
        DB::table('xamples')->insert([
            [
                'teacher_id' => $teacher->id,
                'title' => 'Present simple утвердительные предложения',
                "description" => 'Present simple утвердительные предложения',
                "items" => '[{"question":"Я читаю книгу.","answer":"I read a book.","words":"I read a book books am reading ."},{"question":"Кошки любят молоко.","answer":"Cats like milk.","words":"cats like milk want water ."},{"question":"Я живу в Лондоне.","answer":"I live in London.","words":"I live in London lived at me ."},{"question":"Мы работаем в Нью-Йорке","answer":"We work in New York.","words":"we work in New York you London worked ."}]',
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'teacher_id' => $teacher->id,
                'title' => 'Present simple отрицательные предложения',
                "description" => 'Present simple отрицательные предложения',
                "items" => '[{"question":"Я не смотрю.","answer":"I do not watch.","words":"I do not watch does did ."},{"question":"Они не учатся.","answer":"They do not study.","words":"they do not study does we."},{"question":"","answer":"He does not paint.","words":"He does not paint do she ."}]',
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'teacher_id' => $teacher->id,
                'title' => 'Present simple вопросительные предложения',
                "description" => 'Present simple вопросительные предложения',
                "items" => '[{"question":"Они ходят в школу?","answer":"Do they go to school?","words":"do they go to school does we at?"},{"question":"У твоего брата есть машина?","answer":"Does your brother have a car?","words":"does your brother have a car you do has?"},{"question":"Ты живешь в Ростове?","answer":"Do you live in Rostov?","words":"do you live in Rostov does lived at ?"}]',
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}