<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            'code'=> 'He2024',
            'discount'=> '10',
            'quantily'=>rand(0,100),
            'user_id'=>rand(4,10),
            'start_day'=> date('Y-m-d H:i:s'),
            'end_day'=> date('Y-m-d H:i:s'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('coupons')->insert([
                'code'=> 'Sale'.rand(0,100),
                'discount'=> rand(1,100),
                'quantily'=>rand(0,100),
                'user_id'=>rand(4,10),
                'start_day'=> date('Y-m-d H:i:s'),
                'end_day'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
    }
}
}