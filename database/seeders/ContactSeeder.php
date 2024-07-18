<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            'fullname'=> 'Người dùng 1',
            'email'=> 'nguoidung1@gmail.com',
            'user_id'=>4,
            'phone'=>'012345678',
            'message'=> 'ưiaodalsjdlksajd',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('contacts')->insert([
                'fullname'=> $faker->name,
                'email'=> $faker->email,
                'user_id'=> rand(3,13),
                'phone'=>$faker->phoneNumber,
                'message'=> $faker->text,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
    }
}
}
