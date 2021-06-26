<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(30)->create()->each(function ($user){
             $user->questions()->saveMany(
                 Question::factory(rand(1,5))->make()
             )->each(function ($ques){
                 $ques->answers()->saveMany(Answer::factory(rand(1,5))->make());
             });

         });

    }
}
