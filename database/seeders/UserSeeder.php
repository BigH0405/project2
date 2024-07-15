<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'fullname'=> 'Người dùng 1',
            'email'=> 'nguoidung1@gmail.com',
            'password'=>Hash::make('123456'),
            'phone'=>'0123456789',
            'address'=>'Hà Nội',
            'status'=>1,
            'group_id'=>34,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('users')->insert([
                'fullname'=> $faker->name,
                'email'=> $faker->email,
                'password'=>Hash::make('123456'),
                'phone'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'status'=>rand(0,1),
                'group_id'=>rand(34,55),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
        }

    }
}
