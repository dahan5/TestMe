<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder to input every subject into the db
        $subjects = array(
            ['alias'=>'back','subject_name'=>'Back-End'],
            ['alias'=>'bigdata','subject_name'=>'Big-Data'],
            ['alias'=>'cloud','subject_name'=>'Cloud'],
            ['alias'=>'cryptography','subject_name'=>'Cryptography'],
            ['alias'=>'datascience','subject_name'=>'Data Science'],
            ['alias'=>'db','subject_name'=>'Database'],
            ['alias'=>'devops','subject_name'=>'DevOps'],
            ['alias'=>'front','subject_name'=>'Front-End'],
            ['alias'=>'fullstack','subject_name'=>'Full-Stack'],
            ['alias'=>'hr','subject_name'=>'HR'],
            ['alias'=>'marketing','subject_name'=>'Marketing'],
            ['alias'=>'mgmt','subject_name'=>'Management'],
            ['alias'=>'mobile','subject_name'=>'Mobile'],
            ['alias'=>'qa','subject_name'=>'QA'],
            ['alias'=>'saas','subject_name'=>'SAAS']
        );

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'id' => Uuid::uuid4(),
                'alias' => $subject['alias'],
                'subject_name' => $subject['subject_name'],
            ]);
        }
    }
}
