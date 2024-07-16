<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;



class GroupSeeder extends Seeder
{

    function randomName() {
        $firstname = array(
            'Admin',
            'Manager',
            'Sale',
        );
    
        $name = $firstname[rand ( 0 , count($firstname) -1)];
    
        return $name;
    }
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('groups')->insert([
            'name'=>'Super Admin',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('groups')->insert([
                'name'=>$this->randomName(),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
        }

    }
}
