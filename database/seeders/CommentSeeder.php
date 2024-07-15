<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'fullname'=> 'Người dùng 1',
            'email'=> 'nguoidung1@gmail.com',
            'user_id'=>4,
            'product_id'=>9,
            'phone'=>'012345678',
            'message'=> 'ưiaodalsjdlksajd',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('comments')->insert([
                'fullname'=> $faker->name,
                'email'=> $faker->email,
                'user_id'=> rand(4,14),
                'product_id'=>rand(9,23),
                'phone'=>$faker->phoneNumber,
                'message'=> $faker->text,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
    }
}
}
