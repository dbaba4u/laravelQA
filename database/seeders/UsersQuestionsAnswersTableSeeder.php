<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        \App\Models\User::factory(30)->create()->each(function ($user){
            $user->questions()->saveMany(
                Question::factory(rand(1,5))->make()
            )->each(function ($ques){
                $ques->answers()->saveMany(Answer::factory(rand(1,5))->make());
            });

        });
    }
}
