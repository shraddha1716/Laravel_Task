<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// ------------------- when used only seeder -------------------------
// use App\Models\Company;

// ------------------- when used  seeder and Faker-------------------------

use App\Models\Test;
use Faker\Factory as Faker;


class CompaniesSeeder extends Seeder
{
  
// ------------------- when used only seeder -------------------------

    // public function run()
    // {
    //     $company = new Company;
    //     $company->name = "vinita1";
    //     $company->email = "vinita1@gmail.com";
    //     $company->address = "nashik1";
    //     $company->save();
    // }

// ------------------- when used  seeder and faker -------------------------


    public function run()
    {
        $faker = Faker::create();
        for($i=1;$i<=100;$i++){
            $test = new Test;
            $test->name = $faker->name;
            $test->email = $faker->email;
            $test->address = $faker->address;
            $test->save();
        }
        
    }
}
