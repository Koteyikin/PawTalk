<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'Щенок'],
            ['name' => 'Котёнок'],
            ['name' => 'Вакцинация'],
            ['name' => 'Корм'],
            ['name' => 'Лечение'],
            ['name' => 'Игрушки'],
            ['name' => 'Груминг'],
            ['name' => 'Поведение'],
            ['name' => 'Дрессировка'],
            ['name' => 'Уход за шерстью'],
            ['name' => 'Домашние питомцы'],
            ['name' => 'Ветеринар'],
        ]);
    }
}
